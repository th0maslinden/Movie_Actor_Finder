<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Collection\ImageCollection;
use Entity\Collection\MovieCollection;
use Entity\Collection\PeopleCollection;
use Entity\Image;
use Entity\Movie;
use Entity\People;
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
$html->appendContent("<header><button class=\"back-button\" onclick=\"goBack()\">Retour</button><h1>{$html->escapeString($Movie->getTitle())}</h1></header><div class=\"content\"><div class=\"firstContent\">");
$html->appendJs("function goBack() {window.history.back();}");
$Movies = MovieCollection::findAll();
foreach ($Movies as $movie) {
    if ($movie->getId() == $movieId) {
        $html->appendContent("<img src='data:image/jpeg;base64," . base64_encode(Image::findById($movie->getPosterId())->getJpeg()) . "' alt='Image'>");
        $html->appendContent(<<<HTML
            <div class="right">
                <div class="firstLine">
                    <h4>
                        <div class="title">
                            {$html->escapeString("{$movie->getTitle()}")}
                        </div>
                    </h4>
                    <div class="date">
                        {$movie->getReleaseDate()}
                    </div>
                </div>
                <div class="secondLine">
                    {$html->escapeString("{$movie->getOriginalTitle()}")}
                </div>
                <div class="thirdLine">
                    {$html->escapeString("{$movie->getTagline()}")}
                </div>
                <div class="fourthlyLine">
                    {$html->escapeString("{$movie->getOverview()}")}
                </div>
            </div>
        </div>
        <ul class=\"list\">
HTML);
        $Peoples = People::findByMovieId(intval($movieId));
        foreach ($Peoples as $people) {
            $html->appendContent(<<<HTML
            <a href="DescriptionPeople.php?PeopleId={$people->getId()}">
                <li class="People">
HTML);
            $html->appendContent("<img src=\"imgPeople.php?cover={$people->getAvatarId()}\">");
            $html->appendContent(<<<HTML
                    <div class="roleName"
                        <div class="Pname">
                            {$people->getName()}
                        <div class="Prole">
                            {$people->getRole()}
                        </div>
                    </div>
                </li>
            </a>
    HTML);
        }
    }
}


$html->appendContent("</ul></div><footer>Dernière modification :</footer>");
echo $html->toHTML();
