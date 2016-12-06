<?php

namespace CatApi;

use CatApi\DownloadedFile;
use CatApi\FileRandom;

class CatApi {

    public function getRandomImage() {

        $fileRandom = new FileRandom();

        if ($fileRandom->conditionsToShowFileRandom()) {
            return $fileRandom->showRandomFile();
        }

        $responseXml = new DownloadedFile();

        $responseElement = new \SimpleXMLElement($responseXml->getResponseXml());

        file_put_contents(
                __DIR__ . '/../../cache/random'
                , (string) $responseElement->data->images[0]->image->url
        );

        return (string) $responseElement->data->images[0]->image->url;
    }

    public function insertIntoFileRandom(\SimpleXMLElement $responseElement) {
        file_put_contents(
                __DIR__ . '/../../cache/random'
                , (string) $responseElement->data->images[0]->image->url
        );
    }

}
