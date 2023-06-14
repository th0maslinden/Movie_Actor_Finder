<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\People;
use PDO;

class PeopleCollection
{
    /**
     *la méthode findAll renvoit un tableau des people
     * @return People[]
     */

    public static function findAll(): array
    {
        $stmt = myPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, avatarId, birthday, deathday, name, biography, placeOfBirth
    FROM people
    ORDER by name 
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, People::class);
    }


}
