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
        $result=$connection->query("SELECT posee.id_valoracion,posee.id_pelicula,peliculas.titulo,usuarios.nombre,usuarios.id_usuario,valoraciones.nota FROM usuarios join valoraciones on usuarios.id_usuario=valoraciones.id_usuario join posee 
					on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula;");

echo "<h3>Editar Registro de 'Posee'</h3>";
		?>
		<table class="centered bordered card-panel white"  style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_Pelicula</td>
                <td>Titulo</td>
				<td>Id_usuario</td>
                <td>Id_Valoracion</td>
				<td>Nota</td>
                <td>Nombre</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_pelicula</td>";
                echo "<td>$obj->titulo</td>";
                echo "<td>$obj->id_usuario</td>";
                echo "<td>$obj->id_valoracion</td>";
                echo "<td>$obj->nota</td>";
                echo "<td>$obj->nombre</td>";
                echo "<td><a href='edita_bd.php?id1=$obj->id_pelicula&id2=$obj->id_valoracion'><img width=26 src='../../img/edita.png'/></a></td>";
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
					$result=$connection->query("SELECT posee.id_valoracion,posee.id_pelicula,peliculas.titulo,usuarios.nombre,valoraciones.nota FROM usuarios join valoraciones on usuarios.id_usuario=valoraciones.id_usuario join posee 
					on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula;");
					$result3=$connection->query("SELECT * FROM peliculas;");
					$result4=$connection->query("SELECT usuarios.nombre, valoraciones.id_usuario, valoraciones.id_valoracion, valoraciones.nota FROM usuarios join valoraciones
					on usuarios.id_usuario=valoraciones.id_usuario;");
							$idpelicu=$_GET['id1'];
							$idvalora=$_GET['id2'];
									echo "<h3>Editar registro id_pelicula=>'$idpelicu' y id_valoracion=>'$idvalora'</h3>";
							echo "<form method='post' action='edita_fila.php'>";

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
								echo "<input required value=$idpelicu type='hidden' name='val3' readonly='readonly'>"."</br>";
								echo "<input required value=$idvalora type='hidden' name='val4' readonly='readonly'>"."</br>";
							echo "</br>"."<input type='submit' value='Enviar'>";
							
							echo "</form>";
                    ?>
					<?php endif ?>
</body>
</html>
