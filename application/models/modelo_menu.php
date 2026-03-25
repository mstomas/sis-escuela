<?php 
/**
* Modelo para el menú del sistema
*/
class Modelo_menu extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function aplicacion($idRol, $idUsuario){
		$sql = "SELECT DISTINCT a.idAplicacion, b.Nombre as Aplicacion
				FROM roleopcion as a, aplicacion b
				WHERE a.idAplicacion = b.idAplicacion
				AND a.idRole = ?
				UNION
				SELECT DISTINCT c.idAplicacion, d.Nombre as Aplicacion
        		FROM usuarioopcion as c, aplicacion as d
        		WHERE c.idAplicacion = d.idAplicacion
        		AND c.idUsuario = ? ";

		$query = $this->db->query($sql, array($idRol, $idUsuario));

		return $query->result_array();
	}

	public function menu($idRol, $idUsuario){
		$sql = "SELECT DISTINCT a.idAplicacion,a.idMenu, b.Nombre as Menu, b.Icono, b.Pagina
				FROM roleopcion as a, menu as b
				WHERE a.idMenu = b.idMenu
				AND a.idAplicacion = b.idAplicacion
				AND a.idRole = ?
				UNION
				SELECT DISTINCT c.idAplicacion, c.idMenu, d.Nombre as Menu, d.Icono, d.Pagina
				FROM usuarioopcion as c, menu as d
				WHERE c.idMenu = d.idMenu
				AND c.idAplicacion = d.idAplicacion
				AND c.idUsuario = ? ";

		$query = $this->db->query($sql, array($idRol, $idUsuario));

		return $query->result_array();
	}
}

 ?>