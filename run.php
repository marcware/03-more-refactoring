<?php

require __DIR__  . '/vendor/autoload.php';

use CatApi\CatApi;

$catApi = new CatApi();
echo $catApi->getRandomImage();

//echo 'URL for cat gif with id "vd": ' . $catApi->getCatGifUrl('vd') . "\n";
//echo 'A random URL of a cat gif: ' . $catApi->getRandomCatGifUrl() . "\n";
