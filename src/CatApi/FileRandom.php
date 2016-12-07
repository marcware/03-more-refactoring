<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CatApi;

/**
 * Description of ShowFile
 *
 * @author marco
 */
class FileRandom {

    const THREE_SECONDS_OF_LIFE = 3;

    const CACHE_PATH = __DIR__ . '/../../cache/random';

    protected function fileHowOldIsIt() {
        echo "\n Tiempo del fichero ";
        echo $time = time() - filemtime(self::CACHE_PATH);
        echo "\n";
        return $time;
    }

    protected function fileRandomExist() {
        return file_exists(self::CACHE_PATH);
    }

    public function conditionsToShowFileRandom() {
        $showPhoto = FALSE;
        if ($this->fileRandomExist() && $this->fileHowOldIsIt() <= self::THREE_SECONDS_OF_LIFE) {
            $showPhoto = file_get_contents(self::CACHE_PATH);
        }
        return $showPhoto;
    }

    public function showRandomFile() {
        return file_get_contents(self::CACHE_PATH);
    }

    public function insertIntoFileRandom(\SimpleXMLElement $responseElement) {
        file_put_contents(
                self::CACHE_PATH
                , (string) $responseElement->data->images[0]->image->url
        );
    }

}
