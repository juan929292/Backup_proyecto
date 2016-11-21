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
				</br>
			</div>
			</div>
	<div id="main">
		<div id="contenido" style="float:right;">
	<div id="info1" style="">
		    <?php
        //conexion a la base de datos-peliculas
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_errno){
            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
        }
        $result=$connection->query("SELECT * FROM comentarios");
			echo "</br><a href='../../../Proyecto/administracion_bd.php'>"."<input type='button' value='Volver a panel administración' style='font-family: Verdana; font-size: 10 pt'></br></a>";
		echo "</br><h3>Comentarios:</h3></br>";
		?>
				<table class="centered bordered card-panel white" border=1 style="text-align:center;background-color:grey;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_Comentario</td>
                <td>Contenido</td>
                <td>Fecha</td>
                <td>id_usuario</td>
                <td>id_pelicula</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_comentario</td>";
                echo "<td>$obj->contenido</td>";
                echo "<td>$obj->fecha</td>";
                echo "<td>$obj->id_usuario</td>";
                echo "<td>$obj->id_pelicula</td>";
                echo "</tr>";   
            }
			$result->close();
            unset($obj);
            unset($connection);
        ?>
        </table>
		</br>
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