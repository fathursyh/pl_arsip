<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasUuids;
    protected $table = 'arsips';

    protected $fillable = [
        'title',
        'description',
        'path',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
