<?php
echo "<h1>".$_SERVER['SERVER_NAME'] ."</h1></br></br>";
echo "<h1>".$_SERVER['SERVER_ADDR'] ."</h1></br></br>";
echo "<h1>".$_ENV['OPENSHIFT_MYSQL_DB_HOST'] ."</h1></br></br>";
var_dump($_SERVER)."</br></br>";
echo "<h1>esto es el dolar env</h1></br></br>";
var_dump($_ENV)."</br></br>";
echo "<h1>esto es el dolar env db host</h1></br></br>";
echo $_ENV['OPENSHIFT_INSTALADOR_DB_HOST']."</br></br>";
echo $_ENV['OPENSHIFT_MYSQL_DB_HOST']." x</br></br>";
echo "<h1>esto es el dolar env db port</h1></br></br>";
echo $_ENV['OPENSHIFT_INSTALADOR_DB_USERNAME']."</br></br>";
echo "<h1>esto es el dolar env db username</h1></br></br>";
echo $_ENV['OPENSHIFT_INSTALADOR_DB_PASSWORD']."</br></br>";
echo "<h1>esto es el dolar env db host</h1></br></br>";
echo $_ENV['OPENSHIFT_INSTALADOR_DB_SOCKET']."</br></br>";
echo "<h1>esto es el dolar env db password</h1></br></br>";
echo $_ENV['OPENSHIFT_INSTALADOR_DB_URL']."</br></br>";
echo "<h1>esto es el dolar env db socket</h1></br></br>";
echo $OPENSHIFT_MYSQL_DB_PORT."</br></br>";
echo "<h1>esto es el dolar env db URL</h1></br></br>";
echo $OPENSHIFT_MYSQL_DB_HOST."</br></br>";

?>
