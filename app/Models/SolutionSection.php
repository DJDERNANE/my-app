<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'outtitle',
        'picture',
        'description',
        'solution_detail_id'
    ];

    public function solutionDetail()
    {
        return $this->belongsTo(SolutionDetail::class);
    }
} 