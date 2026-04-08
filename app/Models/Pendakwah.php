<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendakwah extends Model
{
    use HasFactory;

    protected $table = 'MaklumatPendakwah';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'IdAkaunPengguna',
        'NamaIslam',
        'NoKP',
        'Daerah',
        'Jantina',
        'Bangsa',
        'Kategori',
        'NoTel1',
        'NamaAsal',
        'TarikhIslam',
        'Alamat1',
        'Alamat2',
        'Alamat3',
        'Poskod',
        'Bandar',
        'Negeri',
        'KodBank',
        'NoAkaunBank',
        'Catatan',
        'Status',
        'SynCB',
        'SynCD',
        'SynCA',
        'SynMB',
        'SynMD',
        'SynMA',
    ];

    public function lantikans(): HasMany
    {
        return $this->hasMany(LantikanPendakwah::class, 'IdPendakwah', 'Id');
    }
}
