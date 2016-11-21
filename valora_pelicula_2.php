<?php 
session_start();
include_once("./db_configuration.php");
?>
 <?php if (isset($_SESSION['idepeliculaso'])) : ?>											
	<?php						
		$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
			if($connection->connect_errno){
				echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
					}
					$result3=$connection->query("select id_valoracion from valoraciones;");
					while($obj2=$result3->fetch_object()){		
					$val1=$_SESSION['idepeliculaso'];
					$ruta="Location: ficha_pelicula.php?id=$val1";
					$consulta2="insert into posee (id_pelicula,id_valoracion) VALUES ($val1,$obj2->id_valoracion);";
					}
					if($connection->query($consulta2)==true){
						echo "<h3>Valoracion realizada correctamente</br>2-Redireccionando...</h3>";
						unset($_SESSION['idepeliculaso']);
						header("$ruta");
						}
						
					else{
						echo $connection->error;
					}
					
					
	?>
	<?php else: ?>
	
		<?php
		echo "<h2>Error valora_2</h2>";
		?>
		
	<?php endif ?>