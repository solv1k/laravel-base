<?php

if (!function_exists('curia_download')) {
    /**
     * Возвращает ссылку для загрузки файла "CuriaDownload".
     *
     * @param integer $curiaDownloadId
     * @param string $mediaCollectionName
     * @param integer $fileIndex
     * @return string
     */
    function curia_download_link(int $curiaDownloadId, string $mediaCollectionName = 'files', int $fileIndex): string
    {
        return route('curia.download.start', [
            'curiaDownload' => $curiaDownloadId,
            'collection' => $mediaCollectionName,
            'index' => $fileIndex
        ]);
    }
}