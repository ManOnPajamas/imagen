<?php
class ProductoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost:3306;dbname=acad', 'root', '');
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

			$stm = $this->pdo->prepare("SELECT * FROM productos");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new producto();

				$vo->__SET('id', $r->id);
				$vo->__SET('Descripcion', $r->Descripcion);
				$vo->__SET('Precio', $r->Precio);
				$vo->__SET('Stock', $r->Stock);
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
			          ->prepare("SELECT * FROM productos WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new producto();

			$vo->__SET('id', $r->id);
			$vo->__SET('Descripcion', $r->Descripcion);
			$vo->__SET('Precio', $r->Precio);
			$vo->__SET('Stock', $r->Stock);
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
			          ->prepare("DELETE FROM productos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(producto $data)
	{
		try 
		{
			$sql = "UPDATE productos SET 
						Descripcion          = ?, 
						Precio        = ?,
						Stock            = ? ,
						Imagen			= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Descripcion'),
					$data->__GET('Precio'),  
					$data->__GET('Stock'),
					$data->__GET('Imagen'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(producto $data)
	{
		try 
		{
		$sql = "INSERT INTO productos (Descripcion,Precio,Stock,Imagen) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Descripcion'),
				$data->__GET('Precio'), 
				$data->__GET('Stock'),
				$data->__GET('Imagen')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}