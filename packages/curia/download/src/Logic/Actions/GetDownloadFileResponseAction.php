<?php

namespace Curia\Download\Logic\Actions;

use Curia\Download\Exceptions\BadDownloadIndexException;
use Curia\Download\Models\CuriaDownload;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GetDownloadFileResponseAction
{
    /**
     * Начинает автоматическое скачивание указанного файла.
     *
     * @param CuriaDownload $curiaDownload
     * @param string $collection
     * @param integer $index
     * @return \Illuminate\Http\Response
     */
    public function run(CuriaDownload $curiaDownload, string $mediaCollection, int $fileIndex): Response
    {
        $downloads = $curiaDownload->getMedia($mediaCollection);

        /** @var Media */
        $file = $downloads[$fileIndex-1] ?? throw new BadDownloadIndexException;

        $content = Storage::get($file->getPath());

        $headers = [
            'Content-Type'        => $file->getTypeFromMime(),
            'Content-Disposition' => 'attachment; filename="' . $file->file_name . '"',
            'Content-Length'      => strlen($content),
        ];

        return response($content, 200, $headers);
    }
}