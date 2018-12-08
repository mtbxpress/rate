<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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
     * @Assert\NotBlank()
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

    /**
     * Many cursos have Many usuarios.
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="cursos")
     * @ORM\JoinTable(name="curso_usuario")
     */
    private $usuarios;

    /**
     * Many cursos have Many preguntas.
     * @ORM\ManyToMany(targetEntity="Pregunta", inversedBy="cursos")
     * @ORM\JoinTable(name="curso_preguntas")
     */
    private $preguntas;

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
     * Add titulacion
     *
     * @param \AppBundle\Entity\Titulacion $titulacione
     *
     * @return Curso
     */
    public function addTitulacion(\AppBundle\Entity\Titulacion $titulacione)
    {
        if (!$this->titulaciones->contains($titulacione)) {
            $this->titulaciones[] = $titulacione;
           // $titulacione->setCliente($this);
        }

/*        $existe = 0;
        foreach ($this->titulaciones as $tit) {
            if ($tit->getId() == $titulacione->getId()) {
                $existe = 1;
            }
        }
        if(!$existe){
            $this->titulaciones[] = $titulacione;
        }*/
        return $this;
    }

    /**
     * Remove titulacion
     *
     * @param \AppBundle\Entity\Titulacion $titulacione
     */
    public function removeTitulacion(\AppBundle\Entity\Titulacion $titulacione)
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
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Curso
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
    /*    $this->usuarios[] = $usuario;

        return $this;*/
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            //$usuario->setCurso($this);
        }

        return $this;

    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add pregunta
     *
     * @param \AppBundle\Entity\Pregunta $pregunta
     *
     * @return Curso
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
}
