<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $table = "post"; 

    protected $fillable = [
        'title', 
        'post_content',
        'img_link'
    ];
}
