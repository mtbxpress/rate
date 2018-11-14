<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Cliente
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
    private $nombre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaCreacion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ColorCliente", mappedBy="cliente", orphanRemoval=true)
     */
    private $colorClientes;

    public function __construct()
    {
        $this->colorClientes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

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
            $colorCliente->setCliente($this);
        }

        return $this;
    }

    public function removeColorCliente(ColorCliente $colorCliente): self
    {
        if ($this->colorClientes->contains($colorCliente)) {
            $this->colorClientes->removeElement($colorCliente);
            // set the owning side to null (unless already changed)
            if ($colorCliente->getCliente() === $this) {
                $colorCliente->setCliente(null);
            }
        }

        return $this;
    }
}
