<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemePreset extends Model
{
    protected $fillable = ['name', 'slug', 'colors', 'is_active'];
    
    protected $casts = [
        'colors' => 'array',
        'is_active' => 'boolean',
    ];
    
    public static function getActive()
    {
        return static::where('is_active', true)->first();
    }
    
    public function activate()
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
        
        // Update app settings with this preset's colors
        foreach ($this->colors as $key => $value) {
            AppSetting::set($key, $value);
        }
    }
}