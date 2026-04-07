<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muallaf extends Model
{
    use HasFactory;

    protected $table = 'maklumat_muallafs';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    protected $fillable = [
        'IdPenggunaMain',
        'NamaIslam',
        'NoKP',
        'Daerah',
        'BilDaftar',
        'Jantina',
        'Bangsa',
        'KategoriMuallaf',
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
        'Pendakwah',
        'Catatan',
        'Status',
    ];
}
