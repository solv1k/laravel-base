<?php

namespace Curia\Download\Nova\Resources;

use App\Nova\Resource;
use Curia\Download\Enums\CuriaDownloadCollectionEnum;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class CuriaDownload extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Curia\Download\Models\CuriaDownload>
     */
    public static $model = \Curia\Download\Models\CuriaDownload::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label(): string
    {
        return __('Downloads');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required'),

            Text::make('Download Files', 
                fn() => $this->makeDownloadsLinks(CuriaDownloadCollectionEnum::FILES->value))
                ->asHtml(),

            Text::make('Download Images', 
                fn() => $this->makeDownloadsLinks(CuriaDownloadCollectionEnum::IMAGES->value))
                ->asHtml(),

            Files::make('Files')->onlyOnForms(),

            Images::make('Images')->onlyOnForms(),
        ];
    }

    protected function makeDownloadsLinks(string $collection = 'files'): string
    {
        $links = [];
        $index = 0;

        foreach ($this->{$collection} as $file) {
            $links[] = '<a class="link-default hover:underline" href="' .
                    curia_download_link(
                        curiaDownloadId: $this->id,
                        mediaCollectionName: $collection,
                        fileIndex: ++$index
                    )
                . '">' . 
                    $file->file_name
                .'</a>';
        }

        return implode('<br>', $links);
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
