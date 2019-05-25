<?php
class Pintor
{
	private $idPintor;
	private $nombre;
	private $pais;
	private $fechaNacimiento;
	private $fechaFallecimiento;
	private $idMaestrosPintor;
	private $idEscuela;
	private $idMecenas;
	private $foto;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}