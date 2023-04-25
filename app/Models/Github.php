<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Github extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'github_id',
        'name',
        'full_name',
        'html_url',
        'language',
        'pushed_at',
        'updated_at',
        'stargazers_count',
    ];
}
