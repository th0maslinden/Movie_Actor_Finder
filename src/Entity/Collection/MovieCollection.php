<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\Movie;

class MovieCollection
{
    /**
     *la méthode findAll renvoit un tableau des film
     * @return Movie[] liste film
     */

    public static function findAll(): array
    {
        $stmt = myPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT *
    FROM movie
    ORDER by title 
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }


}
