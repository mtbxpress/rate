<?php

namespace AppBundle\Repository;

/**
 * EncuestaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EncuestaRepository extends \Doctrine\ORM\EntityRepository
{

	public function mostarEncuestasCursoActivo($idUsuario = null)	{

		try {
			if($idUsuario != null){
				$sub = "and enc.usuario_id = :idUsuario";
			}
			else{ $sub = ""; }
			$query = "SELECT enc.id, enc.completada, enc.titulacion_id as titulacion_id, enc.usuario_id as usuario, enc.evaluado_id as evaluado, c.descripcion as curso, tit.nombre as titulacion, usu.username, usu.nombre as nombre_usuario, usu.apellidos, enc.naevaluado
						from encuesta enc
                        			INNER JOIN usuario usu on usu.id = enc.usuario_id
						INNER JOIN titulacion tit on enc.titulacion_id = tit.id
						INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
						INNER JOIN curso c on c.id = ct.curso_id and c.id = enc.curso_id
                        			WHERE c.activo = 1 $sub";

		/*			$em  = $this->getEntityManager();
					$db = $em->getConnection();
					$stmt = $db->prepare($query);
					$param = array();
					$stmt->execute($param);
					$res = $stmt->fetchAll();
		*/
			            $em  = $this->getEntityManager();
			            $stmt = $em->getConnection()->prepare($query);
			            $stmt->bindParam(':idUsuario',$idUsuario);
			            $stmt->execute();
			            $res = $stmt->fetchAll();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function obtenerEncuestasCursoActivoEvaluado($idEvaluado = null)	{

		try {

			$query = "SELECT enc.id, enc.completada, enc.titulacion_id as titulacion_id, enc.usuario_id as usuario, enc.evaluado_id as evaluado, c.descripcion as curso, tit.nombre as titulacion, usu.username, usu.nombre as nombre_usuario, usu.apellidos, enc.naevaluado
						from encuesta enc
                        			INNER JOIN usuario usu on usu.id = enc.usuario_id
						INNER JOIN titulacion tit on enc.titulacion_id = tit.id
						INNER JOIN curso_titulacion ct on ct.titulacion_id = tit.id
						INNER JOIN curso c on c.id = ct.curso_id and c.id = enc.curso_id
                        			WHERE c.activo = 1 and enc.evaluado_id = :idEvaluado";
/*
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
*/
		            $em  = $this->getEntityManager();
		            $stmt = $em->getConnection()->prepare($query);
		            $stmt->bindParam(':idEvaluado',$idEvaluado);
		            $stmt->execute();
		            $res = $stmt->fetchAll();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function obtenerEncuestasSegunRol($rol)	{

		try {
			$query = "SELECT enc.id
				from encuesta enc
                        			INNER JOIN usuario usu on usu.id = enc.usuario_id
                        			WHERE  usu.roles = :rol ";
/*
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
*/
	            $em  = $this->getEntityManager();
	            $stmt = $em->getConnection()->prepare($query);
	            $stmt->bindParam(':rol',$rol);
	            $stmt->execute();
	            $res = $stmt->fetchAll();

	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

	public function obtenerPreguntasEncuestasCursoActivo($idEncuesta)	{

		try {
			$query = "SELECT ep.id as encpreg_id, ep.encuesta_id, ep.pregunta_id, resultado_id , p.*
				FROM encuesta_pregunta ep
				INNER JOIN pregunta p ON p.id = ep.pregunta_id
				INNER JOIN curso_preguntas cp ON cp.pregunta_id = p.id
				INNER JOIN curso c ON c.id = cp.curso_id
				WHERE  c.activo = 1 and ep.encuesta_id = :idEncuesta
				ORDER BY orden ASC";
/*
			$em  = $this->getEntityManager();
			$db = $em->getConnection();
			$stmt = $db->prepare($query);
			$param = array();
			$stmt->execute($param);
			$res = $stmt->fetchAll();
*/
	            $em  = $this->getEntityManager();
	            $stmt = $em->getConnection()->prepare($query);
	            $stmt->bindParam(':idEncuesta',$idEncuesta);
	            $stmt->execute();
	            $res = $stmt->fetchAll();
	    } catch (\Doctrine\ORM\NoResultException $exception) {
	        return null;
	    }
		return $res;
	}

}
