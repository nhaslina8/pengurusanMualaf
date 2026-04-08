<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use RuntimeException;

class SynologyFileService
{
    /**
     * Upload file to Synology FTP and return metadata for DB storage.
     */
    public function upload(UploadedFile $file, string $directory): array
    {
        $fileName = now()->format('YmdHis') . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());
        $ftpPath = '/tnt/' . basename($fileName);

        $host = (string) config('services.synology.ftp_host');
        $port = (int) config('services.synology.ftp_port', 21);
        $username = (string) config('services.synology.ftp_user');
        $password = (string) config('services.synology.ftp_pass');

        if (empty($host) || empty($username) || empty($password)) {
            throw new RuntimeException('Konfigurasi FTP Synology tidak lengkap.');
        }

        $realPath = $file->getRealPath();
        if (!$realPath || !is_readable($realPath)) {
            throw new RuntimeException('Fail sementara untuk upload tidak dapat dibaca.');
        }

        $this->uploadViaCurlFtp($realPath, $host, $port, $username, $password, $ftpPath);

        return [
            'file_name' => $file->getClientOriginalName(),
            'file_loc' => $ftpPath,
        ];
    }

    private function uploadViaCurlFtp(
        string $localPath,
        string $host,
        int $port,
        string $username,
        string $password,
        string $remotePath
    ): void {
        if (!function_exists('curl_init')) {
            throw new RuntimeException('cURL extension tidak tersedia untuk FTP upload.');
        }

        $stream = fopen($localPath, 'rb');
        if ($stream === false) {
            throw new RuntimeException('Gagal membuka fail tempatan untuk proses upload.');
        }

        $remoteUrl = sprintf('ftp://%s:%d%s', $host, $port, $remotePath);
        $ch = curl_init();

        if ($ch === false) {
            fclose($stream);
            throw new RuntimeException('Gagal memulakan cURL untuk upload FTP.');
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $remoteUrl,
            CURLOPT_USERPWD => $username . ':' . $password,
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILE => $stream,
            CURLOPT_INFILESIZE => filesize($localPath),
            CURLOPT_FTP_CREATE_MISSING_DIRS => CURLFTP_CREATE_DIR_RETRY,
            CURLOPT_FTP_RESPONSE_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 90,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        $responseCode = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);
        fclose($stream);

        if ($result === false) {
            throw new RuntimeException('FTP upload gagal: ' . $error);
        }

        if ($responseCode >= 400) {
            throw new RuntimeException('FTP upload gagal dengan kod respons: ' . $responseCode);
        }
    }
}
