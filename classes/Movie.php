<?php
/**
 * @author roberto di biase
 */

class Movie
{
    /**
     * @var id
     * @type integer
     */
    public $id;
    /**
     * @var title
     * @type string
     */
    public $title;
    /**
     * @var language
     * @type string
     */
    public $language;
    /**
     * @var releaseDate
     * @type date
     */
    public $releaseDate;
    /**
     * @var overview
     * @type string
     */
    public $overview;
    /**
     * @var poster
     * @type image
     */
    public $posterPath;
    /**
     * @var genres
     * @type array
     */
    public $genres;
    /**
     * @var genres
     * @type string
     */
    public $trailerLink;

    /**
     * @return mixed
     */
    public function getTrailerLink()
    {
        return $this->trailerLink;
    }

    /**
     * @param mixed $trailerLink
     */
    public function setTrailerLink($trailerLink)
    {
        $this->trailerLink = $trailerLink;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param mixed $overview
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
    }

    /**
     * @return mixed
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @param mixed $posterPath
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }


}