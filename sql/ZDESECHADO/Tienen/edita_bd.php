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
		$result=$connection->query("SELECT comentarios.id_comentario,comentarios.contenido,usuarios.nombre,peliculas.id_pelicula,peliculas.titulo FROM usuarios join comentarios
		on usuarios.id_usuario=comentarios.id_usuario join tienen on comentarios.id_comentario=tienen.id_comentario join peliculas on
		tienen.id_pelicula=peliculas.id_pelicula;");
		echo "<h3>Editar Registro de 'Tienen'</h3>";
		?>
		<table class="centered bordered card-panel white"  style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_Pelicula</td>
                <td>Titulo</td>
                <td>Id_Comentario</td>
                <td>Contenido</td>
                <td>Nombre</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_pelicula</td>";
                echo "<td>$obj->titulo</td>";
                echo "<td>$obj->id_comentario</td>";
                echo "<td>$obj->contenido</td>";
                echo "<td>$obj->nombre</td>";
                echo "<td><a href='edita_bd.php?id1=$obj->id_pelicula&id2=$obj->id_comentario'><img width=26 src='../../img/edita.png'/></a></td>";
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
					$idpp=$_GET['id1'];
					$idcc=$_GET['id2'];
					$result=$connection->query("SELECT comentarios.id_comentario,comentarios.contenido,usuarios.nombre FROM comentarios join usuarios
					on comentarios.id_usuario=usuarios.id_usuario;");
					$result2=$connection->query("SELECT * FROM peliculas;");
						echo "<h3>Editar registro id_pelicula=>'$idpp' y id_comentario=>'$idcc'</h3>";
							echo "<form method='post' action='edita_fila.php'>";
								echo "<h3>Pelicula:</h3>";
								echo "<select required multiple name='val1'>";
								while($obj=$result2->fetch_object()){
									echo "<option value=".$obj->id_pelicula .">".$obj->titulo ."</option>";
								}
								echo " </select></br>";
								
								echo "<h3>Comentario:</h3>";
								echo "<select required multiple name='val2'>";
								while($obj2=$result->fetch_object()){
									echo "<option value=".$obj2->id_comentario .">"." -- nombre: ".$obj2->nombre ." -- contenido: ".$obj2->contenido ." -- id_comentario: ".$obj2->id_comentario ."</option>";
								}
								echo " </select></br>";
								echo "<input required value=$idpp type='hidden' name='val3' readonly='readonly'>"."</br>";
								echo "<input required value=$idcc type='hidden' name='val4' readonly='readonly'>"."</br>";
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
                    ?>
					<?php endif ?>
</body>
</html>
