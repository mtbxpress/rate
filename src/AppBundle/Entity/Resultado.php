<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=5, nullable=false,  unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "1",
     *      max = "5",
     * )
     */
    private $valor;

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
     * @param string $valor
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
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }
}
