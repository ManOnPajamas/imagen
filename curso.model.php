<?php
class CursoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM cursos");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new Curso();

				$vo->__SET('id', $r->id);
				$vo->__SET('Codigo', $r->Codigo);
				$vo->__SET('Nombre', $r->Nombre);
				$vo->__SET('Creditos', $r->Creditos);

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
			          ->prepare("SELECT * FROM cursos WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new Curso();

			$vo->__SET('id', $r->id);
			$vo->__SET('Codigo', $r->Codigo);
			$vo->__SET('Nombre', $r->Nombre);
			$vo->__SET('Creditos', $r->Creditos);;

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
			          ->prepare("DELETE FROM cursos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Curso $data)
	{
		try 
		{
			$sql = "UPDATE cursos SET 
						Codigo          = ?, 
						Nombre        = ?,
						Creditos            = ? 
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Codigo'),
					$data->__GET('Nombre'),  
					$data->__GET('Creditos'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Curso $data)
	{
		try 
		{
		$sql = "INSERT INTO cursos (Codigo,Nombre,Creditos) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Codigo'),
				$data->__GET('Nombre'), 
				$data->__GET('Creditos'),
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}