<?php 
session_start();
include_once("../../db_configuration.php");
?>
<?php
	if (isset($_SESSION['tiposesion'])&&($_SESSION['tiposesion']=='admin')){
		echo "";
	}
	else {
		echo "<h2>Acceso denegado, redireccionando...</h2>";
		echo "<style>div {display:none;}<style>";
	header('Refresh:1; url=/Proyecto/login.php',True,303);
}
?>

<html>
<head>
    <title></title>
</head>
<body>
   <div>
    <?php if (!isset($_POST["val2"])) : ?>
		<h2>Añadir registro a 'Posee'</h2>
                    <?php
					$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
					if($connection->connect_errno){
						echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
					}
					$result=$connection->query("SELECT posee.id_valoracion,posee.id_pelicula,peliculas.titulo,usuarios.nombre,valoraciones.nota FROM usuarios join valoraciones on usuarios.id_usuario=valoraciones.id_usuario join posee 
					on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula;");
					$result3=$connection->query("SELECT * FROM peliculas;");
					$result4=$connection->query("SELECT usuarios.nombre, valoraciones.id_usuario, valoraciones.id_valoracion, valoraciones.nota FROM usuarios join valoraciones
					on usuarios.id_usuario=valoraciones.id_usuario;");
							echo "<form method='post' action='#'>";
								echo "<h3>Pelicula:</h3>";
								echo "<select required multiple name='val1'>";
								while($obj=$result3->fetch_object()){
									echo "<option value=".$obj->id_pelicula .">".$obj->titulo ."</option>";
								}
								echo " </select></br>";
								echo "<h3>Valoracion:</h3>";
								echo "<select required multiple name='val2'>";
								while($obj2=$result4->fetch_object()){
										echo "<option value=".$obj2->id_valoracion .">"." -- id_usuario: ".$obj2->id_usuario." -- nombre: ".$obj2->nombre ." -- id_valoracion: ".$obj2->id_valoracion ." -- nota: ".$obj2->nota ."</option>";
								}
								
								echo " </select></br>";
								//echo "<h3>Valoracion:</h3>";
								//echo "<select required multiple name='val3'>";
								//while($obj3=$result2->fetch_object()){
								//	echo "<option value=".$obj3->id_valoracion .">".$obj3->nombre ."</option>";
								//}
								//echo " </select></br>";
								//echo "<input required value='NULL' type='hidden' name='val3' readonly='readonly'>"."</br>";
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php else: ?>
					<?php
							$idpeli=$_POST['val1'];
							$idval=$_POST['val2'];

							$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$consulta="insert into posee(id_pelicula,id_valoracion) VALUES($idpeli,$idval);";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Inserción realizada correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Posee/resultado.php',True,303)
						?>
					<?php endif ?>
    </div>
</body>
</html>