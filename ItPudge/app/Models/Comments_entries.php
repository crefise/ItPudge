<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments_entries extends Model
{
    use HasFactory;


    protected $fillable = [
        'comment_id',
        'post_id',
    ];
}
