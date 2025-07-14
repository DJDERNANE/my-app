<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submenuItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'icon',
        'picture',
        'description',
        'link',
        'parent'
    ];

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }

    public function page()
    {
        return $this->hasOne(page::class, 'submenu_id');
    }
}
