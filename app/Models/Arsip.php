<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasUlids;

    protected $table = 'arsips';

    protected $fillable = [
        'nomor_risalah',
        'pemohon',
        'jenis_lelang',
        'uraian_barang',
        'status',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            Cache::flush();
        });

        static::updated(function ($model) {
            Cache::flush();
        });

        static::deleted(function ($model) {
            Cache::flush();
        });
    }
}
