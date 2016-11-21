<?php 
session_start();
include_once("./db_configuration.php");
?>
 <?php if (isset($_GET['pelicu'])) : ?>											
					<?php
			echo $_GET['pelicu'];
			$valuep=$_GET['pelicu'];
			$valueu=$_SESSION['idsesion'];
						$rutasa="Location: ficha_pelicula.php?id=$valuep";
						$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$result=$connection->query("select id_comentario from comentarios order by fecha desc limit 1;");
								while($obj=$result->fetch_object()){
									$valuec=$obj->id_comentario;
								}
								$consulta="insert into tienen(id_pelicula,id_comentario) VALUES($valuep,$valuec);";
								if($connection->query($consulta)==true){
									echo "<h2>Comentario enviado correctamente, Redireccionando...</h2>";
									header("$rutasa");
								}else{
									echo $connection->error;   
								}
					?>
	<?php else: ?>
	
		<?php
		
		echo "<h2>Error anade_comentario</h2>";
		echo $_GET['pelicu']."</br>";
		echo "valor pelicula: ".$valuep."</br>";
		echo "valor usuario: ".$valueu."</br>";
		echo "valor comentario: ".$valuec."</br>";
		?>
		
	<?php endif ?>