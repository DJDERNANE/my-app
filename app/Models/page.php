<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'submenu_id',
    ];

    public function submenuItem()
    {
        return $this->belongsTo(submenuItem::class, 'submenu_id');
    }
}
