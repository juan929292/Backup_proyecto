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
        $result=$connection->query("SELECT * FROM usuarios");
echo "</br><a href='../../../Proyecto/administracion_bd.php'>"."<input type='button' value='Volver a panel administración' style='font-family: Verdana; font-size: 10 pt'></br></a></br>";

echo "<h3>Editar Usuario:</h3></br>";
		?>
		<table class="centered bordered card-panel white" border=1 style="text-align:center;">
            <tr class="card-panel teal lighten-2 white-text" style="font-weight:bold">
                <td>Id_Usuario</td>
                <td>Nombre</td>
                <td>Contrasena</td>
                <td>Correo</td>
                <td>tipo</td>
            </tr>
            
        <?php
            while($obj=$result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->id_usuario</td>";
                echo "<td>$obj->nombre</td>";
                echo "<td>$obj->contrasena</td>";
                echo "<td>$obj->correo</td>";
                echo "<td>$obj->tipo</td>";
                echo "<td><a href='edita_bd.php?idd=$obj->id_usuario'><img width=26 src='../../img/edita.png'/></a></td>";
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
		echo "</br><a href='../../../Proyecto/administracion_bd.php'>"."<input type='button' value='Volver a panel administración' style='font-family: Verdana; font-size: 10 pt'></br></a></br>";

        $result=$connection->query("SELECT * FROM usuarios where id_usuario=".$_GET['idd'].";");
							echo "<form method='post' action='edita_fila.php' onsubmit='return checkForm(this);'>";
							while($obj=$result->fetch_object()){
								echo "<h3>Editar Usuario: ".$obj->nombre ."</h3>";
								echo "<input required type='hidden' value=".$obj->id_usuario ." name='val1' readonly='readonly'>"."</br>";
								echo "<h3>Nombre:</h3></br>";
								echo "<input required pattern='\w+' type='text' placeholder="."'".$obj->nombre ."'"." name='val2'>"."</br>";
								echo "</br><h3>Contraseña:</h3></br>";
								echo "<input required type='password' title='La contrasena debe contener al menos 6 caracteres, incluyendo minusculas, mayusculas y numeros' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' onchange='this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.pwd2.pattern = this.value;' name='val3'>"."</br>";
								echo "</br><h3>Confirmar contraseña:</h3></br>";
								echo "<input required type='password' title='Por favor introduzca la misma contrasena que antes' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' name='pwd2' onchange=".'"'."
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');>".'"'."</br>";
								echo "</br></br><h3>Correo:</h3></br>";
								echo "<input required type='email' placeholder="."'".$obj->correo ."'"." name='val4'>"."</br>";
								echo "</br><h3>Tipo de usuario:</h3></br>";
								echo "<select required multiple placeholder="."'".$obj->tipo ."'"." name='val5'>";
								echo "<option value='admin'>Administrador</option>";
								echo "<option value='estandar'>Estandar</option>";
								echo " </select></br>";
							echo "</br>"."<input type='submit' value='Enviar'>";
							}
							echo "</form>";
                    ?>
					<?php endif ?>
</br>
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


