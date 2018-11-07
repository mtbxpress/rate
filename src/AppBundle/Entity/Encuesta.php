<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Resultado", mappedBy="encuesta")
     */
    private $resultados;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=10)
     */
    private $tipo;

    public function __construct()
    {
        $this->resultados = new ArrayCollection();
    }

    /**
     * @return Resultado|null
     */
    public function getResultados() {
        return $this->resultados;
    }

    /**
     * @param null|Resultado $resultados
     */
    public function setResultados($resultados) {
        if($resultados === null) {
      //      if($this->resultados !== null) {
      //          $this->resultados->getUsers()->removeElement($this);
      //      }
            $this->resultados = null;
        } else {
   //         if(!$resultados instanceof \AppBundle\Entity\Resultado $resultados) {
   //             throw new InvalidArgumentException('$group must be null or instance of HelloWorld\UserGroup');
   //         }
    //        if($this->resultados !== null) {
     //           $this->resultados->getUsers()->removeElement($this);
   //         }
            $this->resultados = $resultados;
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Encuesta
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
}

