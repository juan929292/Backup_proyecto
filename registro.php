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
					echo $_SESSION['nombresesion']."</br>"."</br>";
					echo "<a href='sesiondestroy.php'>Cerrar Sesi&oacute;n</a>";
					}
					else{
						echo "Invitado";
					
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
			<?php if (!isset($_POST["nombreusu"])) : ?>
			<div id="contenido">
					<?php
						echo "<div style='padding:15px 15px 15px 50px;'>";
							echo "<form method='post' action='registro.php' onsubmit='return checkForm(this);'>";
								echo "<input value='NULL' type='hidden' name='idusu' readonly='readonly'>"."</br>";
								echo "<h3>Nombre:</h3>";
								echo "<input required type='text' name='nombreusu'>"."</br>";
								
								echo "<h3>Contrase&ntilde;a:</h3>";
								echo "<input required type='password' title='La contrasena debe contener al menos 6 caracteres, incluyendo minusculas, mayusculas y numeros' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' onchange='this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
								if(this.checkValidity()) form.pwd2.pattern = this.value;' name='contrasenausu'>"."</br>";
								
								echo "<h3>Confirmar Contrase&ntilde;a:</h3>";
								echo "<input required type='password' title='Por favor introduzca la misma contrasena que antes' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' name='pwd2' onchange=".'"'."
								this.setCustomValidity(this.validity.patternMismatch ? this.title : '');>".'"'."</br>";
								
								echo "<h3>Correo:</h3>";
								echo "<input required type='email' placeholder='example@example.com' name='emailusu'>"."</br>";
								
								echo "<input value='estandar' type='hidden' placeholder='NULL' name='tipousu' readonly='readonly'>"."</br>";
								
								echo "</br>"."<input type='submit' value='Enviar'>";
							echo "</form>";
						echo "</div>";
                    ?>
					<?php else: ?>
					<?php
						$idusuario=$_POST['idusu'];
						$nombre=$_POST['nombreusu'];
						$contrasena=$_POST['contrasenausu'];
						$correo=$_POST['emailusu'];
						$tipo=$_POST['tipousu'];
						$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        if($connection->connect_errno){
                            echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
								} 
								$consulta="insert into usuarios(id_usuario,nombre,contrasena,correo,tipo) VALUES($idusuario,'$nombre','$contrasena','$correo','$tipo');";
								echo "</br>";
								if($connection->query($consulta)==true){
									echo "<h2>Registro realizado correctamente, Redireccionando...</h2>";
								}else{
									echo $connection->error;   
								}
								unset($connection);

								header('Refresh:5; url=/Proyecto/login.php',True,303)
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