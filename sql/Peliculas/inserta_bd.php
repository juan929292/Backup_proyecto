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
	header('Refresh:1; url=../../login.php',True,303);
}
?>

<html>
<head> 
    <title>Film Review</title>
	<link href="../../css/general_admin_bd.css" rel="stylesheet" type="text/css" />
	<meta charset="utf-8"/>
</head>
<body>
<div id="page">
<div id="header">
<div id="login">
<?php
	if (isset($_SESSION['tiposesion'])&&($_SESSION['tiposesion']=='admin')){
		echo "";
	}
	else {
		echo "<h2>Acceso denegado, redireccionando...</h2>";
		echo "<style>page {display:none;}<style>";
	header('Refresh:1; url=../../login.php',True,303);
}
?>
				<h2>Bienvenido <?php
				//<?php if (!isset($_GET["idd"])) : 
				 if (isset($_SESSION["nombresesion"])){  
					echo $_SESSION['nombresesion']."</br>"."</br>";
					echo "<a href='sesiondestroy.php'>Cerrar Sesi&oacute;n</a>";
					}
					else{
						echo "Usted no es Administrador";
				echo "</h2>";
				echo "</br>";
				echo "<h3><p><a href='../../login.php'>Inicia Sesi&oacute;n</a> o <a href='registro.php'>reg&iacute;strate</a></p></h3>";
				}
				include_once("../../includes/cambiar_color_tema.php");
				?>
			</div>
</div>
   
	<div id="main">
		<div id="contenido" style="float:center;">
		<div id="info1" style="margin:2% 10% 2% 20%;">
    <?php if (!isset($_POST["val2"])) : ?>
		<?php	echo "<a href='../../../Proyecto/administracion_bd.php'>"."<input type='button' value='Volver a panel administración' style='font-family: Verdana; font-size: 10 pt'></br></a></br>"; ?>

		<h2>Añadir Pelicula:</h2>
                    <?php
					
					$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
							echo "<form method='post' enctype='multipart/form-data' action='inserta_bd.php'>";
								//echo "<h3>id_pelicula:</h3>";
								echo "<input required value='NULL' type='hidden' placeholder='NULL' name='val1'>"."</br>";
								echo "<h3>Titulo:</h3></br>";
								echo "<input required type='text' name='val2'>"."</br>";
								echo "</br><h3>Duración:</h3></br>";
								echo "<input required type='text' maxlength='3' name='val3' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'></br>";
								echo "</br><h3>Año:</h3></br>";
								echo "<input required type='text' maxlength='4' name='val4' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'>"."</br>";
								//echo "<h3>nota_media:</h3>";
								echo "<input type='hidden' value='0' placeholder='NULL' name='val5'>"."</br>";
								echo "<h3>Imagen:</h3></br>";
								echo "<input type='hidden' name='MAX_FILE_SIZE' value='3000000' />";
								echo "<input required type='file' name='val6'>"."</br>";
								echo "</br><h3>Director:</h3></br>";
								echo "<select required name='val7'>";
								$result3=$connection->query("SELECT * FROM directores;");
								$result4=$connection->query("SELECT * FROM generos;");
								while($obj=$result3->fetch_object()){
									echo "<option value=".$obj->id_director .">".$obj->id_director ." ".$obj->nombre ."</option>";
								}
								echo "</select>";
								echo "</br></br><h3>Género:</h3></br>";
								echo "<select required name='val8'>";
								while($obj2=$result4->fetch_object()){
									echo "<option value=".$obj2->id_genero .">".$obj2->id_genero ." ".$obj2->nombre ."</option>";
								}
								echo "</select>"."</br>";
							echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php else: ?>
					<?php
							$id=$_POST['val1'];
							$tit=$_POST['val2'];
							$dur=$_POST['val3']." min";
							$ani=$_POST['val4'];
							$not=$_POST['val5'];
							
							$dir_subida ='../../img/';
							$fichero_subido = $dir_subida . basename($_FILES['val6']['name']);
							
							var_dump($fichero_subido);
							var_dump($_FILES);
							echo '<pre>';
							if (move_uploaded_file($_FILES['val6']['tmp_name'], $fichero_subido)) {
								echo "El fichero es válido y se subió con éxito.\n";
							} else {
								echo "¡Posible ataque de subida de ficheros!\n";
							}

							echo 'Más información de depuración:';
							print_r($_FILES);

							print "</pre>";

							$img= '"'."<img width='150' height='200' src='/Proyecto/img/".$_FILES['val6']['name']."'>".'"';
							$director=$_POST['val7'];
							$genero=$_POST['val8'];

							$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$consulta="insert into peliculas(id_pelicula,titulo,duracion,anio,nota_media,imagen) VALUES($id,'$tit','$dur',$ani,$not,$img);";
								echo "</br>";
								
								if($connection->query($consulta)==true){
									echo "<h2>Inserción pelicula parte1, Redireccionando...</h2>";
									$ruta="Location: inserta_bd_2.php?tit=$tit&dir=$director&gen=$genero";
									header("$ruta");
								}else{
									echo $connection->error;   
								}
						?>
					<?php endif ?>
					</div>
    </div>
	</div>
	
		<div id="footer">
		
            <div id="footerleft">
          
            </div>
            <div id="footerright">
                <p>Copyright &copy; 2016, Desarrollada por <a href="">Velasco</a></p>
            </div>
		</div>
	</div>
</body>
</html>