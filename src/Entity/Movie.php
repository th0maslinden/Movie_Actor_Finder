<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Movie
{
    private int $id;
    private int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;


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
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * @param int $posterId
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @param string $originalLanguage
     */
    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     */
    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * @param int $runtime
     */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    /**
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Retourne l'objet Artist correspondant à l'ID donné.
     *
     * @param int $id
     * @return Movie
     */
    public static function findById(int $id): Movie
    {
        MyPDO::setConfigurationFromIniFile();

        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM movie
        WHERE id = ?
        SQL
        );

        $stmt->execute([$id]);

        $movieData = $stmt->fetch(PDO::FETCH_ASSOC);

        $movie = new Movie();
        $movie->id = $movieData['id'];
        $movie->originalLanguage = $movieData['originalLanguage'];
        $movie->originalTitle = $movieData['originalTitle'];
        $movie->overview = $movieData['overview'];
        $movie->releaseDate = $movieData['releaseDate'];
        $movie->runtime = $movieData['runtime'];
        $movie->posterId = $movieData['posterId'];
        $movie->tagline = $movieData['tagline'];
        $movie->title = $movieData['title'];

        return $movie;
    }

}
