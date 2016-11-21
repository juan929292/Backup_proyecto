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
<?php if (!isset($_GET["id1"])) : ?>
	<div id="info1" style="">
		    <?php
        //conexion a la base de datos-peliculas
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_errno){
            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
        }
        $result=$connection->query("SELECT peliculas.titulo,es.id_pelicula,es.id_genero,generos.nombre FROM peliculas join es
		on peliculas.id_pelicula=es.id_pelicula join generos on es.id_genero=generos.id_genero");
		echo "<h3>Editar Registro de 'Es'</h3>";
		?>
		<table class="centered bordered card-panel white"  style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_Pelicula</td>
                <td>Titulo</td>
                <td>Id_genero</td>
                <td>Nombre</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_pelicula</td>";
                echo "<td>$obj->titulo</td>";
                echo "<td>$obj->id_genero</td>";
                echo "<td>$obj->nombre</td>";
                echo "<td><a href='edita_bd.php?id1=$obj->id_pelicula&id2=$obj->id_genero'><img width=26 src='../../img/edita.png'/></a></td>";
                echo "</tr>";   
            }
        ?>
        </table>
	</div>
	<?php else : ?>
	  <?php
        //conexion a la base de datos-peliculas
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_errno){
            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
        }
		$result2=$connection->query("SELECT * from peliculas");
		$result3=$connection->query("SELECT * from generos");
		$idasopeli=$_GET['id1'];
		$idasogene=$_GET['id2'];
		echo "<h3>Editar registro id_pelicula=>'$idasopeli' y id_genero=>'$idasogene'</h3>";
							echo "<form method='post' action='edita_fila.php'>";
							
								echo "<h3>Pelicula:</h3>";
								echo "<select required multiple name='val1'>";
								while($obj=$result2->fetch_object()){
									echo "<option value=".$obj->id_pelicula .">".$obj->titulo ."</option>";
								}
								echo " </select></br>";
								echo "<h3>Genero:</h3>";
								echo "<select required multiple name='val2'>";
								while($obj2=$result3->fetch_object()){
									echo "<option value=".$obj2->id_genero .">".$obj2->nombre ."</option>";
								}
								echo " </select></br>";
								echo "<input required value=$idasopeli type='hidden' name='val3' readonly='readonly'>"."</br>";
								echo "<input required value=$idasogene type='hidden' name='val4' readonly='readonly'>"."</br>";
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php endif ?>
</body>
</html>
