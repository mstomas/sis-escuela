<?php 

class Modelo_usuario extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT a.idUsuario, a.Nombre, a.Password, a.idEstatusUsuario, a.UltimaFechaIngreso, a.idRole, a.cod_docente,
				b.Descripcion estado, c.Nombre role, d.nombre as docente
				FROM usuario a, estatususuario b, role c, docente d
				WHERE a.idEstatusUsuario = b.idEstatusUsuario
				AND a.idRole = c.idRole
				AND a.cod_docente = d.cod_docente";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($idUsuario)
	{
		$sql = "SELECT a.idUsuario, a.Nombre, a.Password, a.idEstatusUsuario, a.UltimaFechaIngreso, a.idRole, a.cod_docente,
				b.Descripcion estado, c.Nombre role, d.nombre as docente
				FROM usuario a, estatususuario b, role c, docente d
				WHERE a.idEstatusUsuario = b.idEstatusUsuario
				AND a.idRole = c.idRole
				AND a.cod_docente = d.cod_docente
				AND a.idUsuario = ".$this->db->escape($idUsuario);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($nombre, $password, $idEstatusUsuario, $idRole, $cod_docente)
	{
		$sql_max = "SELECT IFNULL(MAX(idUsuario),0) + 1 as idUsuario FROM usuario";
		$res_max = $this->db->query($sql_max);
		$obj_max = $res_max->row();
		$idUsuario = $obj_max->idUsuario;

		$sql = "INSERT INTO usuario(idUsuario, Nombre, Password, idEstatusUsuario, idRole, cod_docente) VALUE (".$this->db->escape($idUsuario).",".$this->db->escape($nombre).",".$this->db->escape($password).",".$this->db->escape($idEstatusUsuario).",".$this->db->escape($idRole).",".$this->db->escape($cod_docente).")";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($idUsuario, $nombre, $password, $idEstatusUsuario,$idRole,$cod_docente)
	{
		$sql = "UPDATE usuario
				SET nombre = ".$this->db->escape($nombre).",
				password = ".$this->db->escape($password).",
				idEstatusUsuario = ".$this->db->escape($idEstatusUsuario).",
				idRole = ".$this->db->escape($idRole).",
				cod_docente = ".$this->db->escape($cod_docente)."
				WHERE idUsuario = ".$this->db->escape($idUsuario);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($idUsuario)
	{
		$sql = "DELETE FROM usuario WHERE idUsuario = ".$this->db->escape($idUsuario);

		$this->db->query($sql);
	}

}

 ?>