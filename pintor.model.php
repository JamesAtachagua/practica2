<?php
class PintorModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost:3306;dbname=prod', 'utec', 'utec');
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

			$stm = $this->pdo->prepare("SELECT * FROM Pintor");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new Pintor();

				$vo->__SET('idPintor', $r->idPintor);
				$vo->__SET('nombre', $r->nombre);
				$vo->__SET('pais', $r->pais);
				$vo->__SET('fechaNacimiento', $r->fechaNacimiento);
				$vo->__SET('fechaFallecimiento', $r->fechaFallecimiento);
				$vo->__SET('idMaestrosPintor', $r->idMaestrosPintor);
				$vo->__SET('idEscuela', $r->idEscuela);
				$vo->__SET('idMecenas', $r->idMecenas);
				$vo->__SET('foto', $r->foto);

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
			          ->prepare("SELECT * FROM Pintor WHERE idPintor = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new Pintor();

			$vo->__SET('idPintor', $r->idPintor);
			$vo->__SET('nombre', $r->nombre);
			$vo->__SET('pais', $r->pais);
			$vo->__SET('fechaNacimiento', $r->fechaNacimiento);
			$vo->__SET('fechaFallecimiento', $r->fechaFallecimiento);
			$vo->__SET('idMaestrosPintor', $r->idMaestrosPintor);
			$vo->__SET('idEscuela', $r->idEscuela);
			$vo->__SET('idMecenas', $r->idMecenas);
			$vo->__SET('foto', $r->foto);

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
			          ->prepare("DELETE FROM Pintor WHERE idPintor = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Pintor $data)
	{
		try 
		{
			$sql = "UPDATE Pintor SET 
						idPintor          = ?, 
						nombre        = ?,
						pais          = ?, 
						fechaNacimiento        = ?,
						fechaFallecimiento           = ?,
						idMaestrosPintor          = ?, 
						idEscuela        = ?,
						idMecenas           = ?,
						foto           = ?
				    WHERE idPintor = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idPintor'), 
					$data->__GET('nombre'), 
					$data->__GET('pais'),
					$data->__GET('fechaNacimiento'), 
					$data->__GET('fechaFallecimiento'),
					$data->__GET('idMaestrosPintor'),
					$data->__GET('idEscuela'), 
					$data->__GET('idMecenas'),
					$data->__GET('foto'),
					$data->__GET('idPintor')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Pintor $data)
	{
		try 
		{
		$sql = "INSERT INTO Pintor (idPintor,nombre,pais,fechaNacimiento,fechaFallecimiento,idMaestrosPintor,idEscuela,idMecenas,foto) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idPintor'), 
				$data->__GET('nombre'), 
				$data->__GET('pais'),
				$data->__GET('fechaNacimiento'), 
				$data->__GET('fechaFallecimiento'),
				$data->__GET('idMaestrosPintor'),
				$data->__GET('idEscuela'), 
				$data->__GET('idMecenas'),
				$data->__GET('foto'),
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
