<?php

namespace AppBundle\Repository;

/**
 * UsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends \Doctrine\ORM\EntityRepository
{

	public function buscaUsarioLetra($letra)	{

		try {
			if($letra == 'All'){
					$query = "SELECT  u.*
					FROM usuario u
					WHERE  1 ORDER By u.roles ";
			}
			else if($letra == 'admin'){
				$query = "SELECT  u.*
					FROM usuario u
					WHERE  u.roles  = 'ROLE_ADMIN'";
			}
			else if($letra == 'alumno'){
				$query = "SELECT  u.*
					FROM usuario u
					WHERE  u.roles  = 'ROLE_ALU'";
			}
			else if($letra == 'externo'){
				$query = "SELECT  u.*
					FROM usuario u
					WHERE  u.roles  = 'ROLE_PROFE'";
			}
			else if($letra == 'interno'){
				$query = "SELECT  u.*
					FROM usuario u
					WHERE  u.roles  = 'ROLE_PROFI'";
			}
			else{
				$query = "SELECT  u.*
					FROM usuario u
					WHERE  u.nombre LIKE  '$letra%' OR u.apellidos LIKE '$letra%' ORDER By u.roles";
			}
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
//echo "<pre>"; print_r($res);  echo "</pre>";die();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function busquedaGeneral($busqueda)	{

		try {
			$query = "SELECT  u.*
				FROM usuario u
				WHERE  u.nombre LIKE  '%$busqueda%' OR u.apellidos LIKE '%$busqueda%' OR  u.username LIKE '%$busqueda%'
				OR  u.email LIKE '%$busqueda%' or u.telefono LIKE '%$busqueda%' ORDER BY u.roles";
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
//echo "<pre>"; print_r($res);  echo "</pre>";die();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function mostarUsuariosCursoActivo()	{

		try {
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, tit.nombre as titulacion, tit.codigo
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.usuario_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id
					WHERE cu.activo = 1";
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function mostarUsuarioCursoActivo($idUsuario)	{

		try {
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, tit.nombre as titulacion, tit.codigo
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.usuario_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id
					WHERE cu.activo = 1 and usu.id = $idUsuario";
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
//echo "<pre>"; print_r($res);  echo "</pre>";die();
	    if($res){
		return $res[0];
	    }
	}

}


