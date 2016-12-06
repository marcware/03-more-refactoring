<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CatApi;

/**
 * Description of DownloadedFile
 *
 * @author marco
 */
class DownloadedFile {

    //put your code here
    private $responseXml;

    const urlCatApi = 'http://thecatapi.com/api/images/get?format=xml&type=jpg';

    public function __construct() {
        $fileDownload = @file_get_contents(self::urlCatApi);
        if (!$fileDownload) {
            // the cat API is down or something
            $fileDownload = 'http://cdn.my-cool-website.com/default.jpg';
        }
        $this->responseXml = $fileDownload;
    }

}
