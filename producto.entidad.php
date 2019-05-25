<?php
class Producto
{
	private $id;
	private $Descripcion;
	private $Precio;
	private $Stock;
	private $Imagen;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}