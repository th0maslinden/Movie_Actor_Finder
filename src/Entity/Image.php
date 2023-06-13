<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Image
{
    private int $id ;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * @param string $jpeg
     */
    public function setJpeg(string $jpeg): void
    {
        $this->jpeg = $jpeg;
    }
    /**

    Retourne l'objet Image correspondant à l'ID donné.*
    @param int $id
    @return Image*/
    public static function findById(int $id): Image
    {
        MyPDO::setConfigurationFromIniFile();

        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM image
        WHERE id = ?
        SQL
        );

        $stmt->execute([$id]);

        $ImageData = $stmt->fetch(PDO::FETCH_ASSOC);

        $image = new Image();
        $image->id = $ImageData['id'];
        $image->jpeg = $ImageData['jpeg'];
        return $image;
    }

}
