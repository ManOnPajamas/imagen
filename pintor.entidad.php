<?php
class pintor
{
	private $id;
	private $nombre;
	private $ciudad;
	private $pais;
	private $nacimiento;
	private $muerte;
	private $Imagen;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}