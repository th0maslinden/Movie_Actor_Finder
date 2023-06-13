<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\WebPage;

$wp=new WebPage("test");

$Movies = MovieCollection::findAll();

foreach ($Movies as $index => $movie){
    $wp->appendContent("<li>{$movie->getTitle()}</li>");
}

echo $wp->toHTML();