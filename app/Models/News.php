<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class News extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable =[
        "title",
        "description",
        "category",
        "date",
        "position"
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('picture')->singleFile();   
    }

    public function getMediaModel(): string
    {
        return \Spatie\MediaLibrary\MediaCollections\Models\Media::class;
    }


}
