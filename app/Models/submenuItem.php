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
        'description'
    ];

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
}
