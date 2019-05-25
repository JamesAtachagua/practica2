
<?php 

	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$pdo;

	// coneccion con la base da datos
		try
		{
			$pdo = new PDO('mysql:host=localhost:3306;dbname= mydb', 'utec', 'utec');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		try 
		{
			$stm = $pdo
			          ->prepare("SELECT * FROM administrador WHERE login = '$usuario' and clave = '$clave'");
			          

			$stm->execute();
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$us = $r->usuario;
			$ca = $r->clave;

			if ($usuario == $us and $clave == $clave){
				header("location:Primera_Ventana.php");
			}

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}


?>
