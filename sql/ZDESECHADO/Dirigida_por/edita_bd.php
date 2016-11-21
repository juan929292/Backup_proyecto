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
        $result=$connection->query("SELECT peliculas.id_pelicula,peliculas.titulo,directores.id_director,directores.nombre
		FROM peliculas join dirigida_por on peliculas.id_pelicula=dirigida_por.id_pelicula join directores
		on dirigida_por.id_director=directores.id_director;");


		echo "<h3>Editar Registro de 'Dirigida_por'</h3>";
		?>
		<table class="centered bordered card-panel white"  style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
				<td>Id_pelicula</td>
                <td>titulo</td>
                <td>Id_director</td>
                <td>Nombre</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_pelicula</td>";
                echo "<td>$obj->titulo</td>";
                echo "<td>$obj->id_director</td>";
                echo "<td>$obj->nombre</td>";
                echo "<td><a href='edita_bd.php?id1=$obj->id_pelicula&id2=$obj->id_director'><img width=26 src='../../img/edita.png'/></a></td>";
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
		//$result=$connection->query("SELECT peliculas.id_pelicula,peliculas.titulo,directores.id_director,directores.nombre FROM peliculas
		//join dirigida_por on peliculas.id_pelicula=dirigida_por.id_pelicula join directores on dirigida_por.id_director=directores.id_director where
		//(dirigida_por.id_pelicula=".$_GET['id1'].") and (dirigida_por.id_director=".$_GET['id2'].");");
		$result2=$connection->query("SELECT * from peliculas");
		$result3=$connection->query("SELECT * from directores");
		$idasopeli=$_GET['id1'];
		$idasodir=$_GET['id2'];
		echo "<h3>Editar registro id_pelicula=>'$idasopeli' y id_director=>'$idasodir'</h3>";
							echo "<form method='post' action='edita_fila.php'>";
							
								echo "<h3>Director:</h3>";
								echo "<select required multiple name='val1'>";
								while($obj=$result3->fetch_object()){
									echo "<option value=".$obj->id_director .">".$obj->nombre ."</option>";
								}
								echo " </select></br>";
								
								echo "<h3>Pelicula:</h3>";
								echo "<select required multiple name='val2'>";
								while($obj2=$result2->fetch_object()){
									echo "<option value=".$obj2->id_pelicula .">".$obj2->titulo ."</option>";
								}
								echo " </select></br>";
								echo "<input required value=$idasopeli type='hidden' name='val3' readonly='readonly'>"."</br>";
								echo "<input required value=$idasodir type='hidden' name='val4' readonly='readonly'>"."</br>";
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php endif ?>
</body>
</html>
