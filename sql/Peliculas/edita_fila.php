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
				<?php
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								}
								$idpel=$_POST['val1'];
								$titu=$_POST['val2'];
								$dura=$_POST['val3']." min";
								$ani=$_POST['val4'];
								$not=$_POST['val5'];
								$gen=$_POST['val8'];
								$director=$_POST['val7'];
								$img= '"'."<img width='150' height='200' src='/Proyecto/img/".$_POST['val6']."'>".'"';
									if (isset($_POST['val9'])){ 
										$antiguogen=$_POST['val9'];
										$consulta2="update es set id_pelicula=$idpel, id_genero=$gen WHERE id_pelicula=$idpel and id_genero=$antiguogen;";
										}
									else {
										$consulta2="insert into es (id_pelicula, id_genero) values ($idpel,$gen);";
									}
									
									if (isset($_POST['val10'])){ 
										$antiguodir=$_POST['val10'];
										$consulta3="update dirigida_por set id_pelicula=$idpel, id_director=$director WHERE id_pelicula=$idpel and id_director=$antiguodir;";
										}
									else {
										$consulta3="insert into dirigida_por (id_pelicula, id_director) values ($idpel,$director);";
									}

								$consulta="update peliculas set titulo='$titu',duracion='$dura',anio=$ani,nota_media=$not WHERE id_pelicula=$idpel;";
								echo "</br>";
								if($connection->query($consulta)==true){
									if($connection->query($consulta2)==true){
												if($connection->query($consulta3)==true){
												echo "<h2>Actualizacion 1 realizada correctamente, Redireccionando...</h2>";
											}else{
											echo $connection->error; 
											}
										echo "<h2>Actualizacion 2 realizada correctamente, Redireccionando...</h2>";
									}else{
									echo $connection->error; 
									}
									echo "<h2>Actualizacion 3 realizada correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Peliculas/resultado.php',True,303);
					?>
								
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
