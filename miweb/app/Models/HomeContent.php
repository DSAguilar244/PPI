<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = ['section', 'content', 'image_path'];
}