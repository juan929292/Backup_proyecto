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
		<div id="contenido" style="float:right;">
<?php if (!isset($_GET["idd"])) : ?>
	<div id="info1" style="">
		    <?php
        //conexion a la base de datos-peliculas
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_errno){
            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
        }
        //$result=$connection->query("SELECT * FROM valoraciones join posee on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula;");
		//$result2=$connection->query("SELECT * FROM valoraciones join usuarios on valoraciones.id_usuario=usuarios.id_usuario;");
		$result=$connection->query("SELECT valoraciones.id_valoracion, valoraciones.nota, valoraciones.id_usuario, usuarios.nombre, peliculas.titulo FROM usuarios join valoraciones on usuarios.id_usuario=valoraciones.id_usuario
		join posee on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula;");
		echo "</br><a href='../../../Proyecto/administracion_bd.php'>"."<input type='button' value='Volver a panel administración' style='font-family: Verdana; font-size: 10 pt'></br></a></br>";
echo "<h3>Borrar Valoracion:</h3></br>";
		?>
		<table class="centered bordered card-panel white" border=1 style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_valoracion</td>
                <td>Nota</td>
                <td>Id_usuario</td>
				<td>Nombre(Usuarios)</td>
				<td>Titulo</td>
            </tr>
            
        <?php
				echo "<tr>";
				while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_valoracion</td>";
                echo "<td>$obj->nota</td>";
                echo "<td>$obj->id_usuario</td>";
				//$result3=$connection->query("SELECT nombre,id_usuario FROM usuarios where id_usuario=".$obj->id_usuario .";");
				//while($obj2=$result3->fetch_object()){
				//echo "<td>$obj2->id_usuario</td>";
				echo "<td>$obj->nombre</td>";
				echo "<td>$obj->titulo</td>";  
				echo "<td><a href='borra_bd.php?idd=$obj->id_valoracion'><img width=26 src='../../img/borra.png'/></a></td>";
				}  
                echo "</tr>";   

        ?>
        </table>
	</div>
	<?php else: ?>
				<?php
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								}
								$idval=$_GET['idd'];
								$consulta="DELETE FROM valoraciones WHERE id_valoracion=$idval;";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Borrado realizado correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Valoraciones/resultado.php',True,303);
					?>
								<?php endif ?>
								</br>
								</div>
								
</br>
		<div id="footer">
		
            <div id="footerleft">
          
            </div>
            <div id="footerright">
                <p>Copyright &copy; 2016, Desarrollada por <a href="">Velasco</a></p>
            </div>
		</div>
	
	</div>
	</div>
</body>
</html>

