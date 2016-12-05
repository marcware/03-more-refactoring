<?php

namespace CatApi;

class CatApi {

    const THREE_SECONDS_OF_LIFE = 3;

    public function getRandomImage() {
//        if (!file_exists(__DIR__ . '/../../cache/random') 
//                || time() - filemtime(__DIR__ . '/../../cache/random') > WAIT_TREE_SECONDS) {
        if (!file_exists(__DIR__ . '/../../cache/random') || $this->getFileHowOldIsIt() > self::THREE_SECONDS_OF_LIFE) {

            $responseXml = @file_get_contents(
                            'http://thecatapi.com/api/images/get?format=xml&type=jpg'
            );
            if (!$responseXml) {
                // the cat API is down or something
                return 'http://cdn.my-cool-website.com/default.jpg';
            }

            $responseElement = new \SimpleXMLElement($responseXml);

            file_put_contents(
                    __DIR__ . '/../../cache/random', (string) $responseElement->data->images[0]->image->url
            );

            return (string) $responseElement->data->images[0]->image->url;
        } else {
            return file_get_contents(__DIR__ . '/../../cache/random');
        }
    }

    public function getFileHowOldIsIt() {
        return time() - filemtime(__DIR__ . '/../../cache/random');
    }
    
    

}
