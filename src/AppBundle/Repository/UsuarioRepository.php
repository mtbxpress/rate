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
					$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 ORDER By u.roles ";
			}
			else if($letra == 'admin'){
				$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 and u.roles  = 'ROLE_ADMIN'";
			}
			else if($letra == 'alumno'){
				$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 and u.roles  = 'ROLE_ALU'";
			}
			else if($letra == 'externo'){
				$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 and u.roles  = 'ROLE_PROFE'";
			}
			else if($letra == 'interno'){
				$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 and u.roles  = 'ROLE_PROFI'";
			}
			else{
				$query = "SELECT  u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE  cu.activo = 1 and (u.nombre LIKE  '$letra%' OR u.apellidos LIKE '$letra%') ORDER By u.roles";
			}

			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
/*
		            $em  = $this->getEntityManager();
		            $stmt = $em->getConnection()->prepare($query);
		            $stmt->bindParam(':letra',$letra);
		            $stmt->bindParam(':letra',$letra);
		            $stmt->execute();
		            $res = $stmt->fetchAll();
*/
	//	            echo count($res); echo "<pre>"; print_r($res);  echo "</pre>";die();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function busquedaGeneral($busqueda)	{

		try {

/*			$query = "SELECT DISTINCT u.*, cusu.media
					from usuario u
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = u.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
				WHERE  cu.activo = 1 and  u.nombre LIKE  '%$busqueda%' OR u.apellidos LIKE '%$busqueda%' OR  u.username LIKE '%$busqueda%'
				OR  u.email LIKE '%$busqueda%' or u.telefono LIKE '%$busqueda%' ORDER BY u.roles";
		*/
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, cusu.media
					from usuario usu
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = usu.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
					WHERE cu.activo = 1 and
						(usu.nombre LIKE  '%$busqueda%'
						OR usu.apellidos LIKE '%$busqueda%'
						OR  usu.username LIKE '%$busqueda%'
						OR  usu.email LIKE '%$busqueda%'
						OR usu.telefono LIKE '%$busqueda%' )
						ORDER BY usu.roles";
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

	public function mostarUsuariosConCursoActivo()	{

		try {
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, cusu.media
					from usuario usu
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = usu.id
					INNER JOIN curso cu on cusu.curso_id = cu.id
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
	public function mostarUsuariosConEncuestasEnCursoActivo()	{

		try {
			/*$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, cusu.media, tit.nombre as titulacion, tit.codigo
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.usuario_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id
					INNER JOIN curso_usuario cusu on cusu.usuario_id = usu.id
					WHERE cu.activo = 1";
					*/
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, cusu.media/*, tit.nombre as titulacion, tit.codigo*/
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.usuario_id
				/*	INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id*/
					INNER JOIN curso_usuario cusu on cusu.usuario_id = usu.id
					INNER JOIN curso cu on cusu.curso_id = cu.id and enc.curso_id = cu.id
					WHERE cu.activo = 1 ";
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
		/*	$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, tit.nombre as titulacion, tit.codigo
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.usuario_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id
					WHERE cu.activo = 1 and usu.id = $idUsuario";
		*/
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, cusu.media
					from usuario usu
                    				INNER JOIN curso_usuario  cusu on cusu.usuario_id = usu.id
					INNER JOIN curso cu on cusu.curso_id = cu.id and cu.id = cusu.curso_id
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

	public function mostarUsuarioEncuestaConCursoActivo($idUsuario)	{

		try {
		/*	$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono, usu.media, tit.nombre as titulacion, tit.codigo
					from usuario usu
					INNER JOIN encuesta enc on usu.id = enc.evaluado_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id and cu.id = enc.curso_id
					WHERE cu.activo = 1 and usu.id = $idUsuario";
		*/
			$query = "SELECT DISTINCT usu.id, usu.username,usu.nombre, usu.apellidos,usu.email,usu.fechaAlta, usu.avatar,usu.roles, usu.telefono,  tit.nombre as titulacion, tit.codigo, curu.media
					from usuario usu
                    				INNER JOIN curso_usuario curu ON usu.id = curu.usuario_id
					INNER JOIN encuesta enc on usu.id = enc.evaluado_id
					INNER JOIN titulacion tit on tit.id = enc.titulacion_id
					INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
					INNER JOIN curso cu on ct.curso_id = cu.id and cu.id = enc.curso_id and cu.id = curu.curso_id
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
	    if($res){
		return $res[0];
	    }
	}
/* CALCULA LA MEDIA TOTAL
SELECT SUM(valor)/COUNT(r.id)
FROM encuesta_pregunta ep
INNER JOIN encuesta e ON e.id = ep.encuesta_id
INNER JOIN resultado r ON ep.resultado_id = r.id
WHERE e.evaluado_id = 35 and e.completada = 'SI'
*/

	public function calcularMedias($idUsuario)	{

		try {
		/*	$query = "SELECT ep.* , e.*, res.valor
				FROM encuesta_pregunta ep
				INNER JOIN encuesta e on ep.encuesta_id = e.id
				INNER JOIN resultado res on ep.resultado_id = res.id
				WHERE e.evaluado_id = $idUsuario AND e.completada = 'SI' ";
*/
			$query = "SELECT ep.* , e.*, res.valor
				FROM encuesta_pregunta ep
				INNER JOIN encuesta e on ep.encuesta_id = e.id
				INNER JOIN resultado res on ep.resultado_id = res.id
				INNER JOIN titulacion t ON t.id = e.titulacion_id
				INNER JOIN curso_titulacion ct ON ct.titulacion_id = t.id
				INNER JOIN curso c ON c.id = ct.curso_id and c.id = e.curso_id
				WHERE e.evaluado_id = $idUsuario AND e.completada = 'SI' AND c.activo = 1 ";

			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();

			// Media de de todos los años
			// $query2 = "SELECT DISTINCT COUNT(id) as numEnc
			// 	FROM encuesta enc
			// 	WHERE enc.completada = 'SI' and enc.evaluado_id = $idUsuario ";

			//// Media del año activo
			$query2 = "SELECT DISTINCT COUNT(enc.id) as numEnc
				FROM encuesta enc
                INNER JOIN curso c on c.id = enc.curso_id
				WHERE enc.completada = 'SI' and enc.evaluado_id = $idUsuario and c.activo = 1 ";

			$stmt = $db->prepare($query2);
			$param = array();
			$stmt->execute($param);
			$res2 = $stmt->fetchAll();
//echo "<pre>"; print_r($res2[0]);  echo "</pre>";die();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
	    $array = [];
	    foreach ($res as $key => $row) {
	    	if(isset($array[$row['pregunta_id']])){
			$array[$row['pregunta_id']] +=  $row['valor'];
	    	}
	    	else{
	    		$array[$row['pregunta_id']] =  $row['valor'];
	    	}
	    }
	    foreach ($array as $key => $row) {
	    	$array[$key]  = $row /  $res2[0]['numEnc'];
	    }
//echo $res2[0]['numEnc'];
//echo "<pre>"; print_r($array);  echo "</pre>"; die();
//echo "<pre>"; print_r($res);  echo "</pre>";die();
	    if($array){
		return $array;
	    }
	}


	public function calcularMediaTotalAnual($idUsuario)	{

		try {
/*  ESTA CONSULTA CALCULA LA MEDIA TOTAL DE TODOS LOS AÑOS
			$query = "SELECT SUM(valor)/COUNT(r.id) as media
			FROM encuesta_pregunta ep
			INNER JOIN encuesta e ON e.id = ep.encuesta_id
			INNER JOIN resultado r ON ep.resultado_id = r.id
			WHERE e.evaluado_id = $idUsuario and e.completada = 'SI' ";
*/
			$query = "SELECT SUM(valor)/COUNT(r.id) as media
			FROM encuesta_pregunta ep
			INNER JOIN encuesta e ON e.id = ep.encuesta_id
			INNER JOIN resultado r ON ep.resultado_id = r.id
            		INNER JOIN curso c ON c.id = e.curso_id
			WHERE e.evaluado_id = $idUsuario and e.completada = 'SI' AND c.activo = 1 ";

			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();

	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
//	    echo "string ".$query;
//echo "<pre>"; print_r($res);  echo "</pre>"; die();
	  return $res;

	}

	public function calcularNumTiposUsuarios()	{

		try {
/*			$query = "SELECT
			SUM(CASE WHEN roles = 'ROLE_ADMIN' THEN 1 ELSE 0 END) admin,
			SUM(CASE WHEN roles = 'ROLE_ALU' THEN 1 ELSE 0 END) alumno,
			SUM(CASE WHEN roles = 'ROLE_PROFE' THEN 1 ELSE 0 END) profe,
			SUM(CASE WHEN roles = 'ROLE_PROFI' THEN 1 ELSE 0 END) profi,
			SUM(CASE WHEN roles = 'ROLE_PROFI' OR roles = 'ROLE_PROFE' OR roles = 'ROLE_ADMIN' OR roles = 'ROLE_ALU' THEN 1 ELSE 0 END) total
			FROM usuario; ";
*/
			$query = "SELECT
			SUM(CASE WHEN roles = 'ROLE_ADMIN' THEN 1 ELSE 0 END) admin,
			SUM(CASE WHEN roles = 'ROLE_ALU' THEN 1 ELSE 0 END) alumno,
			SUM(CASE WHEN roles = 'ROLE_PROFE' THEN 1 ELSE 0 END) profe,
			SUM(CASE WHEN roles = 'ROLE_PROFI' THEN 1 ELSE 0 END) profi,
			SUM(CASE WHEN roles = 'ROLE_PROFI' OR roles = 'ROLE_PROFE' OR roles = 'ROLE_ADMIN' OR roles = 'ROLE_ALU' THEN 1 ELSE 0 END) total
				FROM usuario u
			            INNER JOIN curso_usuario cu on cu.usuario_id = u.id
			            INNER JOIN curso c on c.id = cu.curso_id
			            WHERE c.activo = 1;";

			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();

	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
	  return $res[0];
	}

	public function calcularNumEncuestas($idCursoActivo)	{

		try {
			$query = "SELECT
				SUM(CASE WHEN completada = 'SI' THEN 1 ELSE 0 END) completada,
				SUM(CASE WHEN completada = 'NO' THEN 1 ELSE 0 END) nocompletada,
				SUM(CASE WHEN completada = 'SI' OR completada = 'NO' THEN 1 ELSE 0 END) total
				FROM encuesta where encuesta.curso_id = $idCursoActivo;";

			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();

	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
	  return $res[0];
	}

	public function calcularNumEncuestasPorUsuarios($idCursoActivo, $completada = null)	{

		try {

			$query = "SELECT
			SUM(CASE WHEN roles = 'ROLE_ADMIN' THEN 1 ELSE 0 END) admin,
			SUM(CASE WHEN roles = 'ROLE_ALU' THEN 1 ELSE 0 END) alumno,
			SUM(CASE WHEN roles = 'ROLE_PROFE' THEN 1 ELSE 0 END) profe,
			SUM(CASE WHEN roles = 'ROLE_PROFI' THEN 1 ELSE 0 END) profi,
			SUM(CASE WHEN roles = 'ROLE_PROFI' OR roles = 'ROLE_PROFE' OR roles = 'ROLE_ADMIN' OR roles = 'ROLE_ALU' THEN 1 ELSE 0 END) total
			FROM usuario u
            			INNER JOIN encuesta e ON u.id = e.usuario_id
            			WHERE e.completada='$completada' and e.curso_id = $idCursoActivo ";


			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();

	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
	  return $res[0];
	}

	public function calcularTopUsuarios($rolUsuario, $cantidad)	{

		try {

			$query = "SELECT *
				    FROM usuario u
			                 INNER JOIN curso_usuario cu on cu.usuario_id = u.id
			                 INNER JOIN curso c on c.id = cu.curso_id
			                 WHERE c.activo = 1 and u.roles = '$rolUsuario'
			                 ORDER BY cu.media DESC LIMIT $cantidad;";

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
}

