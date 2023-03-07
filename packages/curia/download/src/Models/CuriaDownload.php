<?php

namespace Curia\Download\Models;

use Curia\Base\Models\BaseModel;
use Curia\Download\Enums\CuriaDownloadCollectionEnum;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CuriaDownload extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name'];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     * Регистрация медиа-коллекций для "laravel-medialibrary".
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(CuriaDownloadCollectionEnum::FILES->value);
        $this->addMediaCollection(CuriaDownloadCollectionEnum::IMAGES->value);
    }

    /**
     * Коллекция файлов.
     *
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->media()->where('collection_name', CuriaDownloadCollectionEnum::FILES->value);
    }

    /**
     * Коллекция изображений.
     *
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', CuriaDownloadCollectionEnum::IMAGES->value);
    }
}