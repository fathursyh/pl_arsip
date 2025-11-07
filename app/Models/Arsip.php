<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasUuids;
    protected $table = 'arsips';

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

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
