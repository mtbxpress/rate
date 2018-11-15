<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Encuesta
 *
 * @ORM\Table(name="encuesta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EncuestaRepository")
 */
class Encuesta
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * Many encuestas have one titulacion. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Titulacion", inversedBy="encuestas")
     * @ORM\JoinColumn(name="titulacion_id", referencedColumnName="id")
     */
    private $titulacion;

   /**
     * Many encuestas have Many preguntas.
     * @ORM\ManyToMany(targetEntity="Pregunta", inversedBy="encuestas")
     * @ORM\JoinTable(name="encuesta_pregunta")
     */
    private $preguntas;

    /**
     * Many encuestas have one usuario. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="encuestas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Many encuestas have one usuario. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="encuestas")
     * @ORM\JoinColumn(name="evaluado_id", referencedColumnName="id")
     */
    private $evaluado;

    public function __construct() {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Encuesta
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
     * Set titulacion
     *
     * @param \AppBundle\Entity\Titulacion $titulacion
     *
     * @return Encuesta
     */
    public function setTitulacion(\AppBundle\Entity\Titulacion $titulacion = null)
    {
        $this->titulacion = $titulacion;

        return $this;
    }

    /**
     * Get titulacion
     *
     * @return \AppBundle\Entity\Titulacion
     */
    public function getTitulacion()
    {
        return $this->titulacion;
    }

    /**
     * Add pregunta
     *
     * @param \AppBundle\Entity\Pregunta $pregunta
     *
     * @return Encuesta
     */
    public function addPregunta(\AppBundle\Entity\Pregunta $pregunta)
    {
        $this->preguntas[] = $pregunta;

        return $this;
    }

    /**
     * Remove pregunta
     *
     * @param \AppBundle\Entity\Pregunta $pregunta
     */
    public function removePregunta(\AppBundle\Entity\Pregunta $pregunta)
    {
        $this->preguntas->removeElement($pregunta);
    }

    /**
     * Get preguntas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Encuesta
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
