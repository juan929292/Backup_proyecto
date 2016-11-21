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
		<h2>Añadir registro a 'Dirigida_por'</h2>
                    <?php
					$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
					if($connection->connect_errno){
						echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
					}
					$result=$connection->query("SELECT * FROM directores;");
					$result2=$connection->query("SELECT * FROM peliculas;");
							echo "<form method='post' action='#'>";
								echo "<h3>Director:</h3>";
								echo "<select required multiple name='val1'>";
								while($obj=$result->fetch_object()){
									echo "<option value=".$obj->id_director .">".$obj->nombre ."</option>";
								}
								echo " </select></br>";
								
								echo "<h3>Pelicula:</h3>";
								echo "<select required multiple name='val2'>";
								while($obj2=$result2->fetch_object()){
									echo "<option value=".$obj2->id_pelicula .">".$obj2->titulo ."</option>";
								}
								echo " </select></br>";
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php else: ?>
					<?php
							$iddir=$_POST['val1'];
							$idpeli=$_POST['val2'];
							$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$consulta="insert into dirigida_por(id_director,id_pelicula) VALUES($iddir,$idpeli);";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Inserción realizada correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Dirigida_por/resultado.php',True,303)
						?>
					<?php endif ?>
    </div>
</body>
</html>