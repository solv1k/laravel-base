<?php

namespace Curia\Download\UI\Web\Controllers;

use Curia\Base\UI\Api\V1\Controllers\BaseApiController;
use Curia\Download\Logic\Actions\GetDownloadFileResponseAction;
use Curia\Download\Models\CuriaDownload;
use Illuminate\Http\Response;

class FilesController extends BaseApiController
{
    /**
     * Скачивание файла.
     *
     * @param CuriaDownload $curiaDownload
     * @param string $collection
     * @param int $index
     * @return void
     */
    public function download(
        CuriaDownload $curiaDownload, 
        string $collection, 
        int $index, 
        GetDownloadFileResponseAction $getDownloadFileResponseAction
    ): Response {
        return $getDownloadFileResponseAction->run(
            curiaDownload: $curiaDownload,
            mediaCollection: $collection,
            fileIndex: $index
        );
    }
}