<?php 
session_start();
include_once("./db_configuration.php");
?>
 <?php if (isset($_GET['idpel'])) : ?>					
		<?php		
			$idepel=$_GET['idpel'];
			$notaso=$_GET['idnot'];
			$ideusu=$_SESSION['idsesion'];
			$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
			if($connection->connect_errno){
				echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
					} 
					$consulta="insert into valoraciones(id_valoracion,nota,id_usuario) VALUES('NULL',$notaso,$ideusu);";
					if($connection->query($consulta)==true){
						$_SESSION['idepeliculaso']=$idepel;
						}
					else{
						echo $connection->error;
					}
					echo "<h3>Valoracion en curso, Redireccionando...</h3>";
			header('Refresh:2; url=/Proyecto/valora_pelicula_2.php',True,303);
		?>
		
		<?php else: ?>
		
			<?php
			var_dump($_SESSION);
			$idepel=$_GET['idpel'];
			$notaso=$_GET['idnot'];
			$ideusu=$_SESSION['idsesion'];
			echo "<h2>Error valora_pelicula</h2>";
			echo "--pelicula: ".$idepel."--nota: ".$notaso."--idusuario: ".$ideusu;
			?>
			
		<?php endif ?>