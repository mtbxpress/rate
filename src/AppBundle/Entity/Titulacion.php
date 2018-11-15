<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titulacion
 *
 * @ORM\Table(name="titulacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TitulacionRepository")
 */
class Titulacion
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=15, unique=true)
     */
    private $codigo;

    /**
     * Many titulaciones have Many usuarios.
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="titulaciones")
     */
    private $usuarios;

    /**
     * Many titulaciones have Many cursos.
     * @ORM\ManyToMany(targetEntity="Curso", mappedBy="titulaciones")
     */
    private $cursos;

    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Encuesta", mappedBy="titulacion")
     */
    private $encuestas;

    public function __construct() {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cursos   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encuestas = new ArrayCollection();
    }

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
     * @return Titulacion
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Titulacion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Titulacion
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add curso
     *
     * @param \AppBundle\Entity\Curso $curso
     *
     * @return Titulacion
     */
    public function addCurso(\AppBundle\Entity\Curso $curso)
    {
        $this->cursos[] = $curso;

        return $this;
    }

    /**
     * Remove curso
     *
     * @param \AppBundle\Entity\Curso $curso
     */
    public function removeCurso(\AppBundle\Entity\Curso $curso)
    {
        $this->cursos->removeElement($curso);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Add encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     *
     * @return Titulacion
     */
    public function addEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
        $this->encuestas[] = $encuesta;

        return $this;
    }

    /**
     * Remove encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     */
    public function removeEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
        $this->encuestas->removeElement($encuesta);
    }

    /**
     * Get encuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncuestas()
    {
        return $this->encuestas;
    }
}
