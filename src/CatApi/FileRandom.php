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

    protected function fileHowOldIsIt() {
        echo "\n Tiempo del fichero ";
        echo $time = time() - filemtime(__DIR__ . '/../../cache/random');
        echo "\n";
        return $time;
    }

    protected function fileRandomExist() {
        return file_exists(__DIR__ . '/../../cache/random');
    }

    public function conditionsToShowFileRandom() {
        $showPhoto = FALSE;
        if ($this->fileRandomExist() && $this->fileHowOldIsIt() <= self::THREE_SECONDS_OF_LIFE) {
            $showPhoto = file_get_contents(__DIR__ . '/../../cache/random');
        }
        return $showPhoto;
    }

    public function showRandomFile() {
        return file_get_contents(__DIR__ . '/../../cache/random');
    }

    public function insertIntoFileRandom(\SimpleXMLElement $responseElement) {
        file_put_contents(
                __DIR__ . '/../../cache/random'
                , (string) $responseElement->data->images[0]->image->url
        );
    }

}
