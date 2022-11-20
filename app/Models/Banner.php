<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
        'tenbanner', 'slug_banner', 'banner_image', 'banner_tomtat'
    ];
    protected $primaryKey = 'id';
    protected $table = 'banner';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
    }
}
