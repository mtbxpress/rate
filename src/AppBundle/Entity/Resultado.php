<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultado
 *
 * @ORM\Table(name="resultado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultadoRepository")
 */
class Resultado
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
     * @ORM\ManyToOne(targetEntity="Encuesta", inversedBy="resultados")
     * @ORM\JoinColumn(name="encuesta_id", referencedColumnName="id")
     */
    private $encuesta;

    /**
     * @var int
     *
     * @ORM\Column(name="valor", type="smallint")
     */
    private $valor;

    /**
     * @return Encuesta|null
     */
    public function getEncuesta() {
        return $this->encuesta;
    }

    /**
     * @param null|Resultado $resultados
     */
    public function setEncuesta($encuesta) {
        if($encuesta === null) {
      //      if($this->resultados !== null) {
      //          $this->resultados->getUsers()->removeElement($this);
      //      }
            $this->encuesta = null;
        } else {
   //         if(!$resultados instanceof \AppBundle\Entity\Resultado $resultados) {
   //             throw new InvalidArgumentException('$group must be null or instance of HelloWorld\UserGroup');
   //         }
    //        if($this->resultados !== null) {
     //           $this->resultados->getUsers()->removeElement($this);
   //         }
            $this->encuesta = $encuesta;
      //      $group->getUsers()->add($this);
        }
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
     * Set valor
     *
     * @param integer $valor
     *
     * @return Resultado
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return int
     */
    public function getValor()
    {
        return $this->valor;
    }
}

