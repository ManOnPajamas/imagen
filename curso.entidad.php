<?php
class Curso
{
	private $id;
	private $Codigo;
	private $Nombre;
	private $Creditos;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}