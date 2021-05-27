<?php
namespace App\Entity;


/**
 * Class Post
 * @package App\Entity
*/
class Post
{

    /**
     * @var int
     */
    protected $id;


    /**
     * @var string
    */
    protected $title;


    /**
     * @var string
    */
    protected $content;


    /**
     * @var \DateTimeInterface
    */
    protected $publishedAt;



    /**
     * @var bool
    */
    protected $published;



    /**
     * @var \DateTimeInterface
    */
    protected $createdAt;



    /**
     * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }
}