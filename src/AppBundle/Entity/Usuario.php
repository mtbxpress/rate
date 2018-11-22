<?php

namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\Titulacion;
#@ORM\OneToMany(targetEntity="App\Entity\FormulaColor", mappedBy="color")
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=80)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", columnDefinition="enum('ROLE_PROFE', 'ROLE_PROFI',  'ROLE_ALU', 'ROLE_ADMIN')" , length=15, nullable=false)
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=50)
     */
    private $avatar = 'img.jpg';

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="integer", nullable=true)
     */
    private $telefono;

    /**
     * Many titulaciones have Many cursos.
     * @ORM\ManyToMany(targetEntity="Curso", mappedBy="usuarios")
     */
    private $cursos;

    /* COMENTADO
     * Many Users have Many Titulaciones.
     * @ORM\ManyToMany(targetEntity="Titulacion", inversedBy="usuarios")
     * @ORM\JoinTable(name="usuario_titulacion")

    private $titulaciones;
    */


    /**
     * One usuario has many encuestas. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Encuesta", mappedBy="usuario")
     */
    private $encuestas;

    public function __construct() {
   //     $this->titulaciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Usuario
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Usuario
     */
    public function setRoles($roles)
    {
    if (!in_array($roles, array('ROLE_ALU', 'ROLE_ADMIN',  'ROLE_PROFI', 'ROLE_PROFE'))) {
        throw new \InvalidArgumentException("Rol no valido");
    }
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */

    public function getRoles()
    {
        return [$this->roles];
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Usuario
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get telefono
     *
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set telefono
     *
     * @param int $telefono
     *
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }


    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->idUsuario,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->idUsuario,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /*
     * Add titulacion
     *
     * @param \AppBundle\Entity\Titulacion $titulacion
     *
     * @return Usuario
     *
    public function addTitulacion(\AppBundle\Entity\Titulacion $titulacion)
    {
        $this->titulaciones[] = $titulacion;

        return $this;
    }

    /*
     * Remove titulacion
     *
     * @param \AppBundle\Entity\Titulacion $titulacion
     *
    public function removeTitulacion(\AppBundle\Entity\Titulacion $titulacion)
    {
        $this->titulaciones->removeElement($titulacion);
    }

    /*
     * Get titulaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     *
    public function getTitulaciones()
    {
        return $this->titulaciones;
    }
*/


    /**
     * Add encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     *
     * @return Usuario
     */
    public function addEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
     //   $this->encuestas[] = $encuesta;
        if (!$this->encuestas->contains($encuesta)) {
            $this->encuestas[] = $encuesta;
           // $titulacione->setCliente($this);
        }
        return $this;
    }

    /**
     * Remove encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     */
    public function removeEncuesta(\AppBundle\Entity\Encuesta $encuesta)
    {
        $this->encuestas->removeElement($encuesta);
    }

    /**
     * Get encuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncuestas()
    {
        return $this->encuestas;
    }

    /**
     * Add curso
     *
     * @param \AppBundle\Entity\Curso $curso
     *
     * @return Usuario
     */
    public function addCurso(\AppBundle\Entity\Curso $curso)
    {
        if (!$this->cursos->contains($curso)) {
            $this->cursos[] = $curso;
        }
        return $this;
    }

    /**
     * Remove curso
     *
     * @param \AppBundle\Entity\Curso $curso
     */
    public function removeCurso(\AppBundle\Entity\Curso $curso)
    {
        $this->cursos->removeElement($curso);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }
}
