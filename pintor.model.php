<?php
class pintorModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost:3306;dbname=acad', 'phpmyadmin', 'root');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pintor");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new pintor();

				$vo->__SET('id', $r->id);
				$vo->__SET('nombre', $r->nombre);
				$vo->__SET('ciudad', $r->ciudad);
				$vo->__SET('pais', $r->pais);
				$vo->__SET('nacimiento', $r->nacimiento);
				$vo->__SET('muerte', $r->muerte);
				$vo->__SET('Imagen', $r->Imagen);

				$result[] = $vo;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pintor WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new pintor();

			$vo->__SET('id', $r->id);
			$vo->__SET('nombre', $r->nombre);
			$vo->__SET('ciudad', $r->ciudad);
			$vo->__SET('pais', $r->pais);
			$vo->__SET('nacimiento', $r->nacimiento);
			$vo->__SET('muerte', $r->muerte);
			$vo->__SET('Imagen', $r->Imagen);

			return $vo;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM pintor WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(pintor $data)
	{
		try 
		{
			$sql = "UPDATE pintor SET 
						nombre   = ?, 
						ciudad        = ?,
						pais         = ?,
						nacimiento         = ?,
						muerte         = ?,
						Imagen		  = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'),
					$data->__GET('ciudad'),  
					$data->__GET('pais'),
					$data->__GET('nacimiento'),
					$data->__GET('muerte'),
					$data->__GET('Imagen'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(pintor $data)
	{
		try 
		{
		$sql = "INSERT INTO pintor (nombre,ciudad,pais,nacimiento,muerte,Imagen) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'),
				$data->__GET('ciudad'), 
				$data->__GET('pais'),
				$data->__GET('nacimiento'),
				$data->__GET('muerte'),
				$data->__GET('Imagen')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}