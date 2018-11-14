<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// * @ORM\Entity(repositoryClass="App\Repository\ColorRepository")
/**
 * @ORM\Entity()
 */
class Color
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $codigo;

    /**
     * @ORM\Column(type="smallint")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posicionCT;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormulaColor", mappedBy="color")
     */
    private $formulaColores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ColorIdioma", mappedBy="color")
     */
    private $colorIdiomas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ColorCliente", mappedBy="color", orphanRemoval=true)
     */
    private $colorClientes;


    public function __construct()
    {
        $this->formulaColores = new ArrayCollection();
        $this->colorIdiomas = new ArrayCollection();
        $this->colorClientes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getPosicionCT(): ?string
    {
        return $this->posicionCT;
    }

    public function setPosicionCT(string $posicionCT): self
    {
        $this->posicionCT = $posicionCT;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * @return Collection|FormulaColor[]
     */
    public function getFormulaColores(): Collection
    {
        return $this->formulaColores;
    }

    public function addFormulaColor(FormulaColor $formulaColor): self
    {
        if (!$this->formulaColores->contains($formulaColor)) {
            $this->formulaColores[] = $formulaColor;
            $formulaColor->setColor($this);
        }

        return $this;
    }

    public function removeFormulaColor(FormulaColor $formulaColor): self
    {
        if ($this->formulaColores->contains($formulaColor)) {
            $this->formulaColores->removeElement($formulaColor);
            // set the owning side to null (unless already changed)
            if ($formulaColor->getColor() === $this) {
                $formulaColor->setColor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ColorIdioma[]
     */
    public function getColorIdiomas(): Collection
    {
        return $this->colorIdiomas;
    }

    public function addColorIdioma(ColorIdioma $colorIdioma): self
    {
        if (!$this->colorIdiomas->contains($colorIdioma)) {
            $this->colorIdiomas[] = $colorIdioma;
            $colorIdioma->setColor($this);
        }

        return $this;
    }

    public function removeColorIdioma(ColorIdioma $colorIdioma): self
    {
        if ($this->colorIdiomas->contains($colorIdioma)) {
            $this->colorIdiomas->removeElement($colorIdioma);
            // set the owning side to null (unless already changed)
            if ($colorIdioma->getColor() === $this) {
                $colorIdioma->setColor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ColorCliente[]
     */
    public function getColorClientes(): Collection
    {
        return $this->colorClientes;
    }

    public function addColorCliente(ColorCliente $colorCliente): self
    {
        if (!$this->colorClientes->contains($colorCliente)) {
            $this->colorClientes[] = $colorCliente;
            $colorCliente->setColor($this);
        }

        return $this;
    }

    public function removeColorCliente(ColorCliente $colorCliente): self
    {
        if ($this->colorClientes->contains($colorCliente)) {
            $this->colorClientes->removeElement($colorCliente);
            // set the owning side to null (unless already changed)
            if ($colorCliente->getColor() === $this) {
                $colorCliente->setColor(null);
            }
        }

        return $this;
    }


}
