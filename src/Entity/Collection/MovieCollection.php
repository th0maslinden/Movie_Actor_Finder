<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\movie;

class MovieCollection
{
    /**
     *la méthode findAll renvoit un tableau des film
     * @return movie[] liste film
     */

    public static function findAll():array
    {
        MyPDO::setConfigurationFromIniFile();

        $stmt = myPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, posterId, title, releaseDate, tagline, overview
    FROM movie
    ORDER by id 
SQL

        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, movie::class);
    }


}