<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family_name',
        'email',
        'phone',
        'message',
        'availability',
        'contry',
        'city',
        'age_group',
        'status',
        'level',
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
