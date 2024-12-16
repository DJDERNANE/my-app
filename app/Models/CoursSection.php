<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cours_id',
    ];

    public function cours() {
        return $this->belongsTo(Cours::class);
    }
}
