<?php
include_once("../db_configuration.php");
  //Checking if we are into the OpenShift App
/*  if (isset($_ENV['OPENSHIFT_APP_NAME'])) {
    $db_user=$_ENV['OPENSHIFT_MYSQL_DB_USERNAME']; //Openshift db name OPENSHIFT_MYSQL_DB_USERNAME
    $db_host=$_ENV['OPENSHIFT_MYSQL_DB_HOST']; //Openshift db host OPENSHIFT_MYSQL_DB_HOST
    $db_password=$_ENV['OPENSHIFT_MYSQL_DB_PASSWORD']; //Openshift db password OPENSHIFT_MYSQL_DB_PASSWORD
    $db_name="Cine"; //Openshift db name
  } else {
    $db_user="root"; //my db user
    $db_host="localhost"; //my db host
    $db_password=""; //my db password
    $db_name="Cine"; //my db name
  }*/
	$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
			if($connection->connect_errno){
				echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
			}
	$result20=$connection->query("select count(valoraciones.id_valoracion) as votos_mes,
	monthname(valoraciones.fecha) as mes from valoraciones group by month(valoraciones.fecha)
	order by month(valoraciones.fecha) limit 3;");	
		$columnas=[];
		$votos=[];
	while($obj20=$result20->fetch_object()){
		$columnas[]= substr($obj20->mes,0,3);
		$votos[]=$obj20->votos_mes;
	}	
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_bar.php');
//Instancia del objeto del tipo Graph en donde como parametro
// se le pasan los valore de ancho y altura
$grafica = new Graph(200,250);
$grafica->SetScale("textlin");
 
//Posición de los puntos del eje de las Y
$mayor = array(0,2,4,6,8,10);
$menor = array(1,3,5,7,9,11);
 
$grafica->yaxis->SetTickPositions($mayor,$menor); 
$grafica->SetBox(false);
//Nombre de las columnas

$grafica->xaxis->SetTickLabels($columnas);
 
//Objeto del tipo BarPlot que se le enviara a la gráfica y el cual
//recibe como parametros los datos a graficar
$barras = new BarPlot($votos);
 
$grafica->Add($barras);
//Color de los bordes 
 
//Color de borde de las barras
$barras->SetColor("white");
//Color de relleno de las barras
$barras->SetFillColor("#4B0082");
//Ancho de las barras
$barras->SetWidth(45);
 
$grafica->title->Set("Estadísticas votos");
$grafica->title->SetFont(FF_TIMES,FS_ITALIC,18);
$grafica->Stroke();

?>