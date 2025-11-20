<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'id',
        'arsip_id',
        'user_id',
        'borrowed',
        'returned',
        'status',
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id', 'nomor_risalah');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
