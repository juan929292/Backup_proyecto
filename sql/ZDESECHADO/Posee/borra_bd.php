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

echo "<h3>Borrar Registro de 'Posee'</h3>";
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
                echo "<td><a href='borra_bd.php?id1=$obj->id_pelicula&id2=$obj->id_valoracion'><img width=26 src='../../img/borra.png'/></a></td>";
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
								$idpelic=$_GET['id1'];
								$idvalor=$_GET['id2'];
								$consulta="DELETE FROM posee WHERE (id_pelicula=$idpelic) and (id_valoracion=$idvalor);";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Borrado realizado correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:3; url=/Proyecto/sql/Posee/resultado.php',True,303);
					?>
								<?php endif ?>
</body>
</html>
