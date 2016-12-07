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

        $fileRandom->insertIntoFileRandom($responseElement);

        return $this->obtainUrl($responseElement);
    }

    /**
     * @param $responseElement
     * @return string
     */
    private function obtainUrl($responseElement)
    {
        return (string)$responseElement->data->images[0]->image->url;
    }

}
