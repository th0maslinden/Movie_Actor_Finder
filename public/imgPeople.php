<?php

declare(strict_types=1);

use Entity\Image;



$id = $_GET['cover'];
if (!isset($_GET['cover']) or $_GET['cover'] < 0 or $_GET['cover'] > 50000 or !ctype_digit($_GET['cover']) or $_GET['cover'] == "")
{
    header("location: https://iut-info.univ-reims.fr/users/cutrona/restricted/but/s2/sae2-01/ressources/public/img/actor.png");
}
else {
    $image = Image::findById((int)$id);

    header("Content-Type: image/jpg");

    echo($image->getJpeg());

}

