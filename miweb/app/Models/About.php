<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'section',   // 'history', 'mission', 'vision'
        'text',
        'image',
    ];

    // Opcional: Si quieres buscar por sección fácilmente
    public static function getSection($section)
    {
        return static::where('section', $section)->first();
    }
}
