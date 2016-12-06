<?php

namespace CatApi;
//use CatApi\DownloadedFile;

class CatApi {

    const THREE_SECONDS_OF_LIFE = 3;

    public function getRandomImage() {

        if ($this->conditionsToShowFile()) {
            return file_get_contents(__DIR__ . '/../../cache/random');
        }

        $responseXml = @file_get_contents(
                        'http://thecatapi.com/api/images/get?format=xml&type=jpg'
        );
        if (!$responseXml) {
            // the cat API is down or something
            return 'http://cdn.my-cool-website.com/default.jpg';
        }

        $responseElement = new \SimpleXMLElement($responseXml);

        file_put_contents(
                __DIR__ . '/../../cache/random'
                , (string) $responseElement->data->images[0]->image->url
        );

        return (string) $responseElement->data->images[0]->image->url;
    }

    protected function fileHowOldIsIt() {
        return time() - filemtime(__DIR__ . '/../../cache/random');
    }

    protected function fileRandomExist() {
        return file_exists(__DIR__ . '/../../cache/random');
    }

    protected function conditionsToShowFile() {
        $showPhoto = FALSE;
        if ($this->fileRandomExist() && $this->fileHowOldIsIt() <= self::THREE_SECONDS_OF_LIFE) {
            $showPhoto = file_get_contents(__DIR__ . '/../../cache/random');
        }
        return $showPhoto;
    }

}
