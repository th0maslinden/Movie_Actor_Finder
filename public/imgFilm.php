<?php

declare(strict_types=1);

use Entity\Image;

header("Content-Type: image/jpg");

$id = $_GET['cover'];
if (!isset($_GET['cover']) || $_GET['cover'] < 0 || $_GET['cover'] > 50000 || !ctype_digit($_GET['cover'])) {

    header("location: https://iut-info.univ-reims.fr/users/cutrona/restricted/but/s2/sae2-01/ressources/public/img/movie.png");
} else {
    $image = Image::findById((int)$id);
    echo $image->getJpeg();
}

