<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestData extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'test_data';

    protected $fillable = [
        'short_text',
        'long_text',
        'file_upload',
        'image_upload',
        'color',
        'status'
    ];
}
