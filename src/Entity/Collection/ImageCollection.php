<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Image;
use PDO;

class ImageCollection
{
    /**
     *la méthode findAll renvoit un tableau d'images
     * @return Image[]
     */

    public static function findAll(): array
    {

        $stmt = myPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, jpeg
    FROM image
SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Image::class);
    }

}