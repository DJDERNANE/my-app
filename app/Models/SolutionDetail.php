<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'solution_id'
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }

    public function sections()
    {
        return $this->hasMany(SolutionSection::class);
    }
}
