<?php
class Pintor
{
	private $idPintor;
	private $nombre;
	private $pais;
	private $fechaNacimiento;
	private $fechaFallecimiento;
	private $foto;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}