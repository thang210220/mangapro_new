<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
        'gallery_image', 'chapter_id'
    ];
    protected $primaryKey = 'gallery_id';
    protected $table = 'gallery';
}
