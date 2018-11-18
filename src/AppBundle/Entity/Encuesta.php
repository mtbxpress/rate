<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(name="naevaluado", type="string", length=255, nullable=true)
     */
    private $naevaluado;

    /**
     * Many encuestas have one titulacion. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Titulacion", inversedBy="encuestas")
     * @ORM\JoinColumn(name="titulacion_id", referencedColumnName="id")
     */
    private $titulacion;

   /*
     * Many encuestas have Many preguntas.
     * @ORM\ManyToMany(targetEntity="Pregunta", inversedBy="encuestas")
     * @ORM\JoinTable(name="encuesta_pregunta")
     *
    private $preguntas;
*/

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EncuestaPregunta", mappedBy="encuesta", cascade={"persist"})
     */
    private $encuestapregunta;

    /**
     * Many encuestas have one usuario. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="encuestas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /*  EVALUADO NO ES CLAVE FORANEA
     * Many encuestas have one usuario. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="encuestas")
     * @ORM\JoinColumn(name="evaluado_id", referencedColumnName="id")
     */
    //      * @var  \AppBundle\Entity\Usuario
    /*
      * @var int
      *
      * @ORM\Column(name="evaluado", type="integer")
      */

    /**
     * Many encuestas have one usuario. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="encuestas")
     * @ORM\JoinColumn(name="evaluado_id", referencedColumnName="id")
     */
    private $evaluado;

    public function __construct() {
        //$this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encuestapregunta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set naevaluado
     *
     * @param string $naevaluado
     *
     * @return Encuesta
     */
    public function setNaevaluado($naevaluado)
    {
        $this->naevaluado = $naevaluado;

        return $this;
    }

    /**
     * Get naevaluado
     *
     * @return string
     */
    public function getNaevaluado()
    {
        return $this->naevaluado;
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

//     * @param \AppBundle\Entity\Usuario $usuario

    /**
     * Set evaluado
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Encuesta
     */
    public function setEvaluado(\AppBundle\Entity\Usuario $evaluado = null)
    {
        $this->evaluado = $evaluado;

        return $this;
    }

    /**
     * Get evaluado
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getEvaluado()
    {
        return $this->evaluado;
    }

    /**
     * Add encuestapregunta
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapregunta
     *
     * @return Encuesta
     */
    public function addEncuestapregunta(\AppBundle\Entity\EncuestaPregunta $encuestapregunta)
    {
        $this->encuestapregunta[] = $encuestapregunta;

        return $this;
    }

    /**
     * Remove encuestapregunta
     *
     * @param \AppBundle\Entity\EncuestaPregunta $encuestapregunta
     */
    public function removeEncuestapregunta(\AppBundle\Entity\EncuestaPregunta $encuestapregunta)
    {
        $this->encuestapregunta->removeElement($encuestapregunta);
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

}
