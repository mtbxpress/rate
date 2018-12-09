<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoUsuario
 *
 * @ORM\Table(name="curso_usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CursoUsuarioRepository")
 */
class CursoUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * @var int
     *
     * @ORM\Column(name="curso", type="integer")
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curso", inversedBy="cursousuario")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

    /*
     * @var int
     *
     * @ORM\Column(name="usuario", type="integer")
     */
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario", inversedBy="cursousuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="decimal", precision=4, scale=1, nullable=true)
     */
    private $media;


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
     * Set curso
     *
     * @param integer $curso
     *
     * @return CursoUsuario
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return CursoUsuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return int
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return CursoUsuario
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }
}

