<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table(name="pregunta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PreguntaRepository")
 */
class Pregunta
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionIngles", type="string", length=255)
     */
    private $descripcionIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", columnDefinition="enum('PROFESOR_INTERNO', 'PROFESOR_EXTERNO',  'ALUMNO')" , length=20, nullable=false)
     */
    private $tipo;

    /**
     * @var int
     *
     * @ORM\Column(name="orden", type="smallint")
     */
    private $orden;

    /**
     * Many preguntas have Many encuestas.
     * @ORM\ManyToMany(targetEntity="Encuesta", mappedBy="preguntas")
     *
    private $encuestas;
    */


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EncuestaPregunta", mappedBy="pregunta", cascade={"persist"})
     */
    private $encuestapregunta;

    public function __construct() {
        $this->encuestas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pregunta
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Pregunta
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return Pregunta
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return int
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /*
     * Add encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     *
     * @return Pregunta
     *
    public function addEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
        $this->encuestas[] = $encuesta;

        return $this;
    }

    /*
     * Remove encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     *
    public function removeEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
        $this->encuestas->removeElement($encuesta);
    }

    /*
     * Get encuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     *
    public function getEncuestas()
    {
        return $this->encuestas;
    }
*/

    /**
     * Add encuestapreguna
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapreguna
     *
     * @return Pregunta
     */
    public function addEncuestapreguna(\AppBundle\Entity\EncuestaPregunta $encuestapreguna)
    {
 //       $this->encuestapregunta[] = $encuestapreguna;
        if (!$this->encuestapregunta->contains($encuestapreguna)) {
            $this->encuestapregunta[] = $encuestapreguna;
        }
        return $this;
    }

    /**
     * Remove encuestapreguna
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapreguna
     */
    public function removeEncuestapreguna(\AppBundle\Entity\EncuestaPregunta $encuestapreguna)
    {
        $this->encuestapregunta->removeElement($encuestapreguna);
    }

    /**
     * Get encuestapregunta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncuestapregunta()
    {
        return $this->encuestapregunta;
    }

    /**
     * Add encuestapreguntum
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapreguntum
     *
     * @return Pregunta
     */
    public function addEncuestapreguntum(\AppBundle\Entity\EncuestaPregunta $encuestapreguntum)
    {
  //      $this->encuestapregunta[] = $encuestapreguntum;
        if (!$this->encuestapregunta->contains($encuestapreguntum)) {
            $this->encuestapregunta[] = $encuestapreguntum;
        }
        return $this;
    }

    /**
     * Remove encuestapreguntum
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapreguntum
     */
    public function removeEncuestapreguntum(\AppBundle\Entity\EncuestaPregunta $encuestapreguntum)
    {
        $this->encuestapregunta->removeElement($encuestapreguntum);
    }

    /**
     * Set descripcionIngles
     *
     * @param string $descripcionIngles
     *
     * @return Pregunta
     */
    public function setDescripcionIngles($descripcionIngles)
    {
        $this->descripcionIngles = $descripcionIngles;

        return $this;
    }

    /**
     * Get descripcionIngles
     *
     * @return string
     */
    public function getDescripcionIngles()
    {
        return $this->descripcionIngles;
    }
}
