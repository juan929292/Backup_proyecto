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
		echo "<h3>Borrar Registro de 'Tienen'</h3>";
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
                echo "<td><a href='borra_bd.php?id1=$obj->id_pelicula&id2=$obj->id_comentario'><img width=26 src='../../img/borra.png'/></a></td>";
                echo "</tr>";   
            }
        ?>
        </table>
	</div>
	<?php else: ?>
				<?php
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								}
								$idp=$_GET['id1'];
								$idc=$_GET['id2'];
								$consulta="DELETE FROM tienen WHERE (id_pelicula=$idp) and (id_comentario=$idc);";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Borrado realizado correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Tienen/resultado.php',True,303);
					?>
								<?php endif ?>
</body>
</html>
