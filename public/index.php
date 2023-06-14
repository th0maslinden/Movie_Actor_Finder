<?php

declare(strict_types=1);

use Entity\Collection\ImageCollection;
use Entity\Collection\MovieCollection;
use Entity\Image;
use Html\AppWebPage;

$html = new AppWebPage("Films");
$html->appendContent("<header><h1>Films</h1></header><div class='content'><ul class=\"list\">");

$Movies = MovieCollection::findAll();
$Images = ImageCollection::findAll();

foreach ($Movies as $index => $movie) {
    $html->appendContent("<a href=\"DescriptionMovie.php?MovieId={$movie->getId()}\"><li><div class='txt'>{$html->escapeString("{$movie->getTitle()}")}</div><img src='data:image/jpeg;base64," . base64_encode(Image::findById($movie->getPosterId())->getJpeg()) . "' alt='Image'></li>");
}
$html->appendContent("</a></ul></div><footer>Dernière modification : 13/06/2023 - 15:18</footer>");
echo $html->toHTML();

