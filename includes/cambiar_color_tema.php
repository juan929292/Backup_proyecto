<?php
echo "<h4>*Elige un tema:</br></h4>";
echo "<a href='index.php?tema=tema1'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/Proyecto/img/tema1.png'/></a>";
echo "<a href='index.php?tema=tema2'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/Proyecto/img/tema2.png'/></a>";
echo "<a href='index.php?tema=tema3'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/Proyecto/img/tema3.png'/></a></br>";
echo "<a href='/Proyecto/index.php?tema=tema0'>(Por defecto)</a>";
if (isset($_GET['tema'])){
	$_SESSION['tema']=$_GET['tema'];
}
else {
	
}

if (isset($_SESSION['tema'])){
		if ($_SESSION['tema']=='tema1'){
				echo "<style type='text/css'>#sidebaraso{background: #ff0000;}
				#sidebar{background: #ff0000;}
				#login{background: #ff0000;}
				#login > h4{color: black;}
				#main{background: #737373}
				body{background: black}
				#contenido{background: #737373;}
				a{color: black;}
				a:hover{color: blue;}
				#footerright{background: #990000;}'></style>";
		}
		elseif ($_SESSION['tema']=='tema2'){
				echo "<style type='text/css'>#sidebaraso{background: green;}
				#sidebar{background: green;}
				#login{background: green;}
				#login > h4{color: black;}
				#main{background: black}
				#contenido{background: black;}
				body{background: grey}
				a{color: white;}
				a:hover{color: blue;}
				#footerright{background: darkgreen;}'></style>";
		}
		
		elseif ($_SESSION['tema']=='tema3'){
				echo "<style type='text/css'>#sidebaraso{background: white;}
				#sidebar{background: white;}
				#login{background: white;}
				#login > h4{color: black;}
				#main{background: grey;}
				body{background: blue;}
				#contenido{background: grey;}
				a{color: black;}
				a:hover{color: blue;}
				#footerright{background: #D8D8D8; color: black}'></style>";
		}
		else {

		}
}
	else {}

//elementos a cambiar color:
                  
//				  tema1          tema2           tema3        
//--------------------------------------------------------				  
//#sidebaraso---> rojo --------- verde --------- blanco
//#sidebar------> rojo --------- verde --------- blanco
//#login--------> rojo --------- verde --------- blanco
//body----------> negro -------- gris ---------- azul
//#main---------> gris --------- negro --------- burdeos
//#contenido----> gris --------- negro --------- burdeos
//#footerright--> rojo oscuro -- verde oscuro -- gris
?>

			