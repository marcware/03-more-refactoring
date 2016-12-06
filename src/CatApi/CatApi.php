<?php

namespace CatApi;

use CatApi\DownloadedFile;
use CatApi\ShowFile;

class CatApi {

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

}
