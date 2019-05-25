<?php
class Usuario
{
	private $id;
	private $Login;
	private $Clave;
	private $Estado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
