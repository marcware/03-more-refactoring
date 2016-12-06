<?php

namespace CatApi;

use CatApi\DownloadedFile;
use CatApi\ShowFile;

class CatApi {

    //const THREE_SECONDS_OF_LIFE = 3;

    public function getRandomImage() {

        $showFile = new ShowFile();
        if ($showFile->conditionsToShowFile()) {
            return file_get_contents(__DIR__ . '/../../cache/random');
        }

        $responseXml = new DownloadedFile();

        $responseElement = new \SimpleXMLElement($responseXml->getResponseXml());

        file_put_contents(
                __DIR__ . '/../../cache/random', (string) $responseElement->data->images[0]->image->url
        );

        return (string) $responseElement->data->images[0]->image->url;
    }

//    protected function fileHowOldIsIt() {
//        return time() - filemtime(__DIR__ . '/../../cache/random');
//    }
//
//    protected function fileRandomExist() {
//        return file_exists(__DIR__ . '/../../cache/random');
//    }
//
//    protected function conditionsToShowFile() {
//        $showPhoto = FALSE;
//        if ($this->fileRandomExist() && $this->fileHowOldIsIt() <= self::THREE_SECONDS_OF_LIFE) {
//            $showPhoto = file_get_contents(__DIR__ . '/../../cache/random');
//        }
//        return $showPhoto;
//    }

}
