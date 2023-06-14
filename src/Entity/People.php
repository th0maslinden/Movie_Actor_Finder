<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class People
{
    private int $id;
    private ?int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;
    private ?string $role;

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
     * @return int
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * @param int $avatarid
     */
    public function setAvatarId(?int $avatarId = null): void
    {
        $this->avatarId = $avatarId;
    }

    /**
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthdya(?string $birthday = null): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * @param string $deathday
     */
    public function setDeathday(?string $deathday = null): void
    {
        $this->deathday = $deathday;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     */
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * @param string $placeOfBirth
     */
    public function setPlaceOfBirth(string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Retourne l'objet People correspondant à l'ID du Movie donné.
     *
     * @param int $id
     * @return People[]
     */
    public static function findByMovieId(int $movieId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT p.*, c.role
        FROM cast c
        JOIN people p ON p.id = c.peopleId
        WHERE movieId = ?
        SQL
        );

        $stmt->execute([$movieId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, People::class);
    }
}
