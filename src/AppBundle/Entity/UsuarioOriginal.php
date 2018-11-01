<?php

namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Usuario
 */
class UsuarioOriginal implements UserInterface
{
    /**
     * @var integer
     */
    private $idUsuario;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido1;

    /**
     * @var string
     */
    private $apellido2;

    /**
     * @var string
     */
    private $documentoIdentificacion;

    /**
     * @var string
     */
    private $correoelectronico;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $poblacion;

    /**
     * @var string
     */
    private $provincia;

    /**
     * @var string
     */
    private $codigopostal;

    /**
     * @var string
     */
    private $centroeducativo;

    /**
     * @var \DateTime
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     */
    private $fechaBaja;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var \AppBundle\Entity\RolSistema
     */
    private $idFkRolSistema;

    /**
     * @var \AppBundle\Entity\Tipodi
     */
    private $idFkTipodi;


    function __construct() {
        $this->activo = true;
       // $this->idFkRolSistema= new ArrayCollection();
    }

    /**
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
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
     * Set apellido1
     *
     * @param string $apellido1
     *
     * @return Usuario
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     *
     * @return Usuario
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set documentoIdentificacion
     *
     * @param string $documentoIdentificacion
     *
     * @return Usuario
     */
    public function setDocumentoIdentificacion($documentoIdentificacion)
    {
        $this->documentoIdentificacion = $documentoIdentificacion;

        return $this;
    }

    /**
     * Get documentoIdentificacion
     *
     * @return string
     */
    public function getDocumentoIdentificacion()
    {
        return $this->documentoIdentificacion;
    }

    /**
     * Set correoelectronico
     *
     * @param string $correoelectronico
     *
     * @return Usuario
     */
    public function setCorreoelectronico($correoelectronico)
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string
     */
    public function getCorreoelectronico()
    {
        return $this->correoelectronico;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Usuario
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Usuario
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set codigopostal
     *
     * @param string $codigopostal
     *
     * @return Usuario
     */
    public function setCodigopostal($codigopostal)
    {
        $this->codigopostal = $codigopostal;

        return $this;
    }

    /**
     * Get codigopostal
     *
     * @return string
     */
    public function getCodigopostal()
    {
        return $this->codigopostal;
    }

    /**
     * Set centroeducativo
     *
     * @param string $centroeducativo
     *
     * @return Usuario
     */
    public function setCentroeducativo($centroeducativo)
    {
        $this->centroeducativo = $centroeducativo;

        return $this;
    }

    /**
     * Get centroeducativo
     *
     * @return string
     */
    public function getCentroeducativo()
    {
        return $this->centroeducativo;
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
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     *
     * @return Usuario
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idFkRolSistema
     *
     * @param \AppBundle\Entity\RolSistema $idFkRolSistema
     *
     * @return Usuario
     */
    public function setIdFkRolSistema(\AppBundle\Entity\RolSistema $idFkRolSistema = null)
    {
        $this->idFkRolSistema = $idFkRolSistema;

        return $this;
    }

    /**
     * Get idFkRolSistema
     *
     * @return \AppBundle\Entity\RolSistema
     */
    public function getIdFkRolSistema()
    {
        return $this->idFkRolSistema;
    }

    /**
     * Set idFkTipodi
     *
     * @param \AppBundle\Entity\Tipodi $idFkTipodi
     *
     * @return Usuario
     */
    public function setIdFkTipodi(\AppBundle\Entity\Tipodi $idFkTipodi = null)
    {
        $this->idFkTipodi = $idFkTipodi;

        return $this;
    }

    /**
     * Get idFkTipodi
     *
     * @return \AppBundle\Entity\Tipodi
     */
    public function getIdFkTipodi()
    {
        return $this->idFkTipodi;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
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
}
