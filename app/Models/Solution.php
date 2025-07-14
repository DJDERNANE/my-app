<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'picture',
        'description',
        'submenu_item_id'
    ];


    public function submenuItem()
    {
        return $this->belongsTo(SubmenuItem::class, 'submenu_item_id');
    }

    public function detail()
    {
        return $this->hasOne(SolutionDetail::class);
    }
}
