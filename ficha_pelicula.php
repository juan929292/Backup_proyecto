<?php 
session_start();
include_once("./db_configuration.php");
?>
<html>
<head> 
    <title>Film Review</title>
    <link href="css/general.css" rel="stylesheet" type="text/css" />
	<meta charset="utf-8"/>
</head>
<body>

   <div id="page">
        <div id="header">  
			<div id="login">
				<h2>Bienvenido <?php
				//<?php if (!isset($_GET["idd"])) : 
			 if (isset($_SESSION["nombresesion"])){
					$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
					if($connection->connect_errno){
						echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
					}
					$consulta7="select posee.id_pelicula,usuarios.nombre from posee join valoraciones on posee.id_valoracion=valoraciones.id_valoracion
					join usuarios on valoraciones.id_usuario=usuarios.id_usuario where usuarios.id_usuario=".$_SESSION['idsesion']." and
					posee.id_pelicula=".$_GET['id'].";";
					$consulta8="select count(usuarios.nombre) as valorsiono from posee join valoraciones on posee.id_valoracion=valoraciones.id_valoracion
					join usuarios on valoraciones.id_usuario=usuarios.id_usuario where valoraciones.id_usuario=".$_SESSION['idsesion']." and
					posee.id_pelicula=".$_GET['id'].";";
					$result7=$connection->query($consulta8);
					while($obj10=$result7->fetch_object()){
								$valoradasino=$obj10->valorsiono;
							}
					/*si no ha votado*/if($valoradasino=='0'){
						echo $_SESSION['nombresesion']."</br>"."</br>";
							echo "<a href='sesiondestroy.php'>Cerrar Sesi&oacute;n</a>";
							echo "</br></br><a href='includes/imprimir_pdf.php' target='_blank'>Imprimir actividad</a></br></br>";
							echo "<style>#estrellas{display:inherit;}#valorada{display:none;}#invitadaso{display:none;}#mostrar1{display:inherit;}</style>";
									
					/*si ha votado*/}else{
						echo $_SESSION['nombresesion']."</br>"."</br>";
							echo "<a href='sesiondestroy.php'>Cerrar Sesi&oacute;n</a>";
							echo "</br></br><a href='includes/imprimir_pdf.php'>Imprimir actividad</a></br></br>";
							echo "<style>#invitadaso{display:none;}#estrellas{display:none;}#valorada{display:inherit;}#mostrar1{display:none;}</style>";	
							
						}
				}else{
						echo "Invitado";
						echo "<style>#valorada{display:none;}#mostrar1{display:none;}#estrellas{display:none;}#formulariaso{display:none;}</style>";
				echo "</h2>";
				echo "</br>";
				echo "<h3><p><a href='login.php'>Inicia Sesi&oacute;n</a> o <a href='registro.php'>reg&iacute;strate</a></p></h3>";
				}
			 include_once("includes/cambiar_color_tema.php");
				?>
			</div>
		</div>
        <div id="main">
		<div id="sidebaraso">
            <div id="sidebar">
                <h2>Men&uacute;</h2>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
					<?php
						if (isset($_SESSION['tiposesion'])&&($_SESSION['tiposesion']=='admin')){
					echo "<li><a href='includes/imprimir_pdf_admin.php' target='_blank'>Imprimir actividad Web</a></li>";
					echo "<li><a href='administracion_bd.php'>Panel Administraci&oacute;n</a></li>";
					
						}
						else{
							echo " ";
						}
					?>
					
                </ul>
                <h2>G&eacute;neros</h2>
				<?php
				$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
						if($connection->connect_errno){
							echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
						}
					$result7=$connection->query("SELECT nombre FROM generos");
                echo "<ul>";
				while($obj7=$result7->fetch_object()){
					echo "<li><a href='peliculas_genero.php?id=".$obj7->nombre ."'>".$obj7->nombre ."</a></li>";
				}
				echo "</ul>";
				?>
            </div>
			<img style="margin: 50px 10px 10px 15px; border: 1px solid black" src="includes/grafica.php"/>
		</div>
			<div id="contenido">
				<?php if (!isset($_POST["nuevocoment"])) : ?>
				
						<?php					
					$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
						if($connection->connect_errno){
							echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
						}
					/*peliculas*/
					$result0=$connection->query("SELECT * FROM peliculas where peliculas.id_pelicula=".$_GET['id'].";");
					/*peliculas-es-generos*/
					$result1=$connection->query("SELECT * FROM peliculas join es on peliculas.id_pelicula=es.id_pelicula join generos
					on es.id_genero=generos.id_genero where peliculas.id_pelicula=".$_GET['id'].";");
					/*peliculas-dirigida_por-directores*/
					$result2=$connection->query("SELECT directores.nombre FROM peliculas join dirigida_por on peliculas.id_pelicula=dirigida_por.id_pelicula join directores
					on dirigida_por.id_director=directores.id_director where peliculas.id_pelicula=".$_GET['id'].";");
					/*peliculas-tienen-comentarios-usuarios*/
					$result3=$connection->query("SELECT usuarios.nombre,comentarios.contenido,comentarios.fecha FROM peliculas join tienen on peliculas.id_pelicula=tienen.id_pelicula join comentarios 
					on tienen.id_comentario=comentarios.id_comentario join usuarios 
					on comentarios.id_usuario=usuarios.id_usuario where peliculas.id_pelicula=".$_GET['id'].";");
					/*peliculas-posee-valoraciones-usuarios*/
					$result4=$connection->query("SELECT round(avg(valoraciones.nota), 1) as media FROM peliculas join posee on peliculas.id_pelicula=posee.id_pelicula join valoraciones 
					on posee.id_valoracion=valoraciones.id_valoracion join usuarios on 
					valoraciones.id_usuario=usuarios.id_usuario where peliculas.id_pelicula=".$_GET['id'].";");
					echo "<div id='cont' style='float:right;padding-right:20%;'>";
					echo "</br>";
						while($obj=$result0->fetch_object()){
							echo "<h2>".$obj->titulo ."</h2>"."</br>";
							echo $obj->imagen ."</br>"."</br>";
							echo "<h3>Duración: ".$obj->duracion ."</h3>"."</br>";
							while($obj2=$result2->fetch_object()){
								echo "<h3>Director: ".$obj2->nombre ."</h3>"."</br>";
							}
							echo "<h3>Año: ".$obj->anio ."</h3>"."</br>";
							while($obj3=$result4->fetch_object()){
								$medi=$obj3->media;
									if ($medi> 0){
									echo "<h3>Nota media Usuarios Film Review: "."<h1>".$medi ."</h1>"."</h3>"."</br>";
									//echo "media es: ".$medi;
								}else{
									echo "<h3>Nota media Usuarios Film Review:</br></br> (Esta Pelicula aun no ha sido valorada)</h3>"."</br>";
								}
							}
							
						}
						echo "<h4 id='invitadaso'>¿Quieres valorar y comentar peliculas? <a href='registro.php'>reg&iacute;strate</a> o <a href='login.php'>inicia sesi&oacute;n</a></h4>";
						echo "<h3 id='mostrar1'>¿Aun no has valorado esta película?</h3>";
						echo "<h3 id='valorada'>Ya has valorado esta pelicula</h3>";
						echo "<div id='estrellas' class='ec-stars-wrapper'>";
							echo "<h2>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=0' data-value='0' title='Votar con 0 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=1' data-value='1' title='Votar con 1 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=2' data-value='2' title='Votar con 2 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=3' data-value='3' title='Votar con 3 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=4' data-value='4' title='Votar con 4 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=5' data-value='5' title='Votar con 5 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=6' data-value='6' title='Votar con 6 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=7' data-value='7' title='Votar con 7 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=8' data-value='8' title='Votar con 8 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=9' data-value='9' title='Votar con 9 estrellas'>&#9733;</a>";
							echo "<a href='valora_pelicula.php?idpel=".$_GET['id']."&idnot=10' data-value='10' title='Votar con 10 estrellas'>&#9733;</a>";
							echo "</h2>";
						echo "</div>";
							while($obj3=$result3->fetch_object()){
								echo "<p>";
								echo "<h4>".$obj3->fecha ." ".$obj3->nombre .": </h4>";
								echo "<p style='background-color:white;color:black;'>".$obj3->contenido ." </p>"."</br>";
							}
							echo "<form id='formulariaso' method='post' action='ficha_pelicula.php?id=".$_GET['id']."'>";
							echo "<input value='NULL' type='hidden' placeholder='NULL' name='id_coment'>";
							echo "<input value='NULL' type='hidden' placeholder='NULL' name='fechaso'>";
							echo "<input value=".$_GET['id']." type='hidden' placeholder='NULL' name='id_pelic'>";
							echo "<textarea id='comentariaso'name='nuevocoment' size=32 style='width:400px;height:100px;background-color:white;color:black;' cols='60' rows='8'></textarea>"."</br>";
							echo "</br>"."<input id='botonaso' type='submit' value='Enviar Comentario'>"."</br>"."</br>";
							echo "</form>";
						echo "</div>";
						?>
						<?php else : ?>
						<?php
						$valorr5=$_POST['id_pelic'];
						$valorr2=$_POST['nuevocoment'];
						$valorr4=$_SESSION['idsesion'];
						$valorr3=$_POST['fechaso'];
						$valorr1=$_POST['id_coment'];
						$rutaso="Location: anade_comentario.php?pelicu=$valorr5";
						
						$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$consulta="insert into comentarios(id_comentario,contenido,fecha,id_usuario,id_pelicula) VALUES($valorr1,'$valorr2',$valorr3,$valorr4,$valorr5);";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Comentario enviado correctamente, Redireccionando...</h2>";
									header("$rutaso");
								}else{
									echo $connection->error;   
								}
								unset($connection);
						?>
						<?php endif ?>
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