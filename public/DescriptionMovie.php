<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\ImageCollection;
use Entity\Collection\MovieCollection;
use Entity\Image;
use Entity\Movie;
use Html\WebPage;

$html = new WebPage();
$html->appendCssUrl("/css/DescriptionMovie.css");
$movieId = -1;

if (empty($_GET['MovieId']) or !is_numeric($_GET['MovieId'])) {
    header('Location: /index.php');
    exit();
}

if (isset($_GET['MovieId']) && !empty($_GET['MovieId'])) {
    $movieId = $html->escapeString($_GET['MovieId']);
} else {
    http_response_code($response_code = 404);
}

if ($movieId < 0 || $movieId > 1000000) {
    header("Location: /index.php");
    exit();
}

MyPDO::setConfigurationFromIniFile();
$Movie = Movie::findById(intval($movieId));
$html->appendContent("<header><h1>{$html->escapeString($Movie->getTitle())}</h1></header><div class=\"content\"><div class=\"firstContent\">");

$Movies = MovieCollection::findAll();
foreach ($Movies as $index => $movie) {
    if ($movie->getId() == $movieId) {
        $html->appendContent("<img src='data:image/jpeg;base64," . base64_encode(Image::findById($movie->getPosterId())->getJpeg()) . "' alt='Image'>");
        $html->appendContent(<<<HTML
            <div class="right">
                <div class="firstLine">
                    <h4>
                        <div class="title">
                            {$movie->getTitle()}
                        </div>
                    </h4>
                    <div class="date">
                        {$movie->getReleaseDate()}
                    </div>
                </div>
                <div class="secondLine">
                    titre Original
                </div>
                <div class="thirdLine">
                    {$movie->getTagline()}
                </div>
                <div class="fourthlyLine">
                    {$movie->getOverview()}
                </div>
            </div>
        </div>
    </div>
HTML);
    }
}


$html->appendContent("</div><footer>Dernière modification :</footer>");
echo $html->toHTML();
