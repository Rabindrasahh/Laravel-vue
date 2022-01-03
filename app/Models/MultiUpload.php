<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multiUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'images',
      
    ];
    public $table ='multi_uploads';
}
