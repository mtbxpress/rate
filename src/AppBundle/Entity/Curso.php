<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CursoRepository")
 */
class Curso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
//@Assert\Regex("/^\w+/")  ([0][1-9]|[12][0-9]|3[01])       *     pattern="/^[a-z]/",       message="Formato incorrecto"


    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/([2]\d{3}\/\d{2})/",
     *     match=true,
     * )
     * @Assert\Length(
     *      min = "7",
     *      max = "7",
     * )
     * @ORM\Column(name="descripcion", type="string", length=7, unique=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * Many cursos have Many Titulaciones.
     * @ORM\ManyToMany(targetEntity="Titulacion", inversedBy="cursos")
     * @ORM\JoinTable(name="curso_titulacion")
     */
    private $titulaciones;

    public function __construct() {
        $this->titulaciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Curso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Curso
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return int
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Add titulacione
     *
     * @param \AppBundle\Entity\Titulacion $titulacione
     *
     * @return Curso
     */
    public function addTitulacione(\AppBundle\Entity\Titulacion $titulacione)
    {
        $this->titulaciones[] = $titulacione;

        return $this;
    }

    /**
     * Remove titulacione
     *
     * @param \AppBundle\Entity\Titulacion $titulacione
     */
    public function removeTitulacione(\AppBundle\Entity\Titulacion $titulacione)
    {
        $this->titulaciones->removeElement($titulacione);
    }

    /**
     * Get titulaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTitulaciones()
    {
        return $this->titulaciones;
    }
}
