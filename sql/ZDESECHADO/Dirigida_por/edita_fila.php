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
				<?php
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								}
								$iddir=$_POST['val1'];
								$idpel=$_POST['val2'];
								$idedir=$_POST['val4'];
								$idepel=$_POST['val3'];
								echo $iddir."</br>";
								echo $idpel."</br>";
								$consulta="update dirigida_por set id_director=$iddir, id_pelicula=$idpel WHERE (id_director=$idedir) and (id_pelicula=$idepel);";
								echo $consulta;
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Actualizacion realizada correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:5; url=/Proyecto/sql/Dirigida_por/resultado.php',True,303);
					?>
								
</body>
</html>
