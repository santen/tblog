<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubric
 */
class Rubric
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $authorId;

    /**
     * @var string
     */
    private $rubric;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set authorId
     *
     * @param integer $authorId
     * @return Rubric
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer 
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set rubric
     *
     * @param string $rubric
     * @return Rubric
     */
    public function setRubric($rubric)
    {
        $this->rubric = $rubric;

        return $this;
    }

    /**
     * Get rubric
     *
     * @return string 
     */
    public function getRubric()
    {
        return $this->rubric;
    }
    /**
     * @var integer
     */
    private $posts;


    /**
     * Set posts
     *
     * @param integer $posts
     * @return Rubric
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get posts
     *
     * @return integer 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
