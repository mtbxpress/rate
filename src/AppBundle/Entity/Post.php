<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PostTag", mappedBy="post", cascade={"persist"})
     */
    private $posttags;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Post
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posttags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posttag
     *
     * @param \App\Entity\PostTag $posttag
     *
     * @return Post
     */
    public function addPosttag(\App\Entity\PostTag $posttag)
    {
        $this->posttags[] = $posttag;

        return $this;
    }

    /**
     * Remove posttag
     *
     * @param \App\Entity\PostTag $posttag
     */
    public function removePosttag(\App\Entity\PostTag $posttag)
    {
        $this->posttags->removeElement($posttag);
    }

    /**
     * Get posttags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosttags()
    {
        return $this->posttags;
    }
}
