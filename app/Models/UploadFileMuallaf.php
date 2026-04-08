<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFileMuallaf extends Model
{
    protected $table = 'UPLOAD_FILE_MUALLAF';
    protected $primaryKey = 'ID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'ID' => 'integer',
        'FILE_SIZE' => 'integer',
        'SYNCD' => 'datetime',
        'SYNMD' => 'datetime',
    ];

    protected $fillable = [
        'REFNO',
        'TYPE',
        'REFNO2',
        'TYPE2',
        'REFNO3',
        'ORDERNO',
        'FILE_NAME',
        'FILE_LOC',
        'FILE_DATA',
        'SYNCB',
        'SYNCD',
        'SYNCA',
        'SYNMB',
        'SYNMD',
        'SYNMA',
        'REFNO4',
        'REFNO5',
        'FILE_SIZE',
        'CONTENT_TYPE',
    ];
}
