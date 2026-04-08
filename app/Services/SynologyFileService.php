<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class SynologyFileService
{
    /**
     * Upload file using a Synology-style storage path.
     *
     * This implementation stores files on the public disk under a synology
     * directory, while keeping FILE_LOC in a Synology-like location format.
     */
    public function upload(UploadedFile $file, string $directory): array
    {
        $directory = trim($directory, '/');
        $fileName = now()->format('YmdHis') . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        $relativePath = 'synology/' . $directory;
        $storedPath = Storage::disk('public')->putFileAs($relativePath, $file, $fileName);

        if ($storedPath === false) {
            throw new RuntimeException('Gagal upload fail ke storan Synology.');
        }

        return [
            'file_name' => $file->getClientOriginalName(),
            'file_loc' => 'synology://' . str_replace('\\', '/', $storedPath),
        ];
    }
}
