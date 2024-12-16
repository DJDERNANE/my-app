<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Cours extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'bg',
        'icon',
        'price',
        'main_page_title',
        'main_page_description'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('bg')->singleFile();   // For background
        $this->addMediaCollection('icon')->singleFile(); // For icon
    }

    public function getMediaModel(): string
    {
        return \Spatie\MediaLibrary\MediaCollections\Models\Media::class;
    }

    public function coursSections()
    {
        return $this->hasMany(CoursSection::class);
    }
}
