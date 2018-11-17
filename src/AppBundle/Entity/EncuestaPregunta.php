<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncuestaPregunta
 *
 * @ORM\Table(name="encuesta_pregunta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EncuestaPreguntaRepository")
 */
class EncuestaPregunta
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
     * @ORM\Column(name="encuesta", type="integer")
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Encuesta", inversedBy="encuestapregunta")
     * @ORM\JoinColumn(name="encuesta_id", referencedColumnName="id")
     */
    private $encuesta;

    /*
     * @var int
     *
     * @ORM\Column(name="pregunta", type="integer")
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pregunta", inversedBy="encuestapregunta")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
     */
    private $pregunta;


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
     * Set encuesta
     *
     * @param integer $encuesta
     *
     * @return EncuestaPregunta
     */
    public function setEncuesta($encuesta)
    {
        $this->encuesta = $encuesta;

        return $this;
    }

    /**
     * Get encuesta
     *
     * @return int
     */
    public function getEncuesta()
    {
        return $this->encuesta;
    }

    /**
     * Set pregunta
     *
     * @param integer $pregunta
     *
     * @return EncuestaPregunta
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return int
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }
}

