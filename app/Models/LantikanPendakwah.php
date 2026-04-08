<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LantikanPendakwah extends Model
{
    protected $table = 'LantikanPendakwah';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'IdPendakwah',
        'Tahun',
        'TarikhMula',
        'TarikhAkhir',
        'Catatan',
        'Status',
        'SynCB',
        'SynCD',
        'SynCA',
        'SynMB',
        'SynMD',
        'SynMA',
    ];

    public function pendakwah(): BelongsTo
    {
        return $this->belongsTo(Pendakwah::class, 'IdPendakwah', 'Id');
    }
}
