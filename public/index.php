<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;
use Html\WebPage;

$wp = new AppWebPage("test");

$Movies = MovieCollection::findAll();

foreach ($Movies as $index => $movie) {
    $wp->appendContent("<li>{$movie->getTitle()}</li>");
}

echo $wp->toHTML();

