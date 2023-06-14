<?php

use Entity\Image;
use Entity\Movie;
use Entity\People;
use Html\WebPage;

$html = new WebPage();
$html->appendCssUrl("/css/DescriptionPeople.css");
$peopleId = -1;

if (empty($_GET['PeopleId']) or !is_numeric($_GET['PeopleId'])) {
    header('Location: /index.php');
    exit();
}

if (isset($_GET['PeopleId']) && !empty($_GET['PeopleId'])) {
    $peopleId = $html->escapeString($_GET['PeopleId']);
} else {
    http_response_code($response_code = 404);
}

if ($peopleId < 0 || $peopleId > 5000000) {
    header("Location: /index.php");
    exit();
}

$people = People::findById($peopleId);
$html->appendContent("<header><h1>{$html->escapeString($people->getName())}</h1></header><div class=\"content\"><div class=\"firstContent\">");
$html->appendContent("<img src=\"imgPeople.php?cover={$people->getAvatarId()}\">");
$html->appendContent(<<<HTML
            <div class="right">
                <div class="firstLine">
                    <h4>
                            {$html->escapeString("{$people->getName()}")}
                    </h4>
                </div>
                <div class="secondLine">
                    {$html->escapeString("{$people->getPlaceOfBirth()}")}
                </div>
                <div class="thirdLine">
                    <div class="dateNaiss">
                    {$html->escapeString("{$people->getBirthday()}")}
                    </div>
HTML);
if ($people->getDeathday() !== null) {
    $html->appendContent(<<<HTML
                    <div class="dateMort">
                    <pre>   -   {$html->escapeString("{$people->getDeathday()}")}</pre>
                    </div>
HTML);
}
$html->appendContent(<<<HTML
                </div>
                <div class="fourthlyLine">
                    {$html->escapeString("{$people->getBiography()}")}
                </div>
            </div>
        </div>
        <ul class=\"list\">
HTML);

$Movies = Movie::findByPeopleId(intval($peopleId));
foreach ($Movies as $movie) {
    $html->appendContent(
        <<<HTML
            <a href="DescriptionMovie.php?MovieId={$movie->getId()}">
                <li>
HTML
    );
    $html->appendContent("<img src=\"imgFilm.php?cover={$movie->getPosterId()}\">");
    $html->appendContent(
        <<<HTML
                    <div class="secondRight">
                        <div class="titleDate">
                            <div class="titleM">
                                {$html->escapeString("{$movie->getTitle()}")}
                            </div>
                            <div class="dateM">
                                {$html->escapeString("{$movie->getReleaseDate()}")}
                            </div>
                        </div>
                        <div class="Prole">
HTML
    );
    $peoples2 = People::findByMovieId($movie->getId());
    foreach ($peoples2 as $people2) {
        if ($people2->getId() == $people->getId()) {
            $html->appendContent($html->escapeString("{$people2->getRole()}"));
        }
    }
    $html->appendContent(<<<HTML
                        </div>
                    </div>
                </li>
            </a>
    HTML);
}


$html->appendContent("</ul><footer>Dernière modification :</footer>");
echo $html->toHTML();
