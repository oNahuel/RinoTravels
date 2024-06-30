<?php
$title = "Pasajeros";
//Luego vamos a guardarlo en una variable que persiste entre páginas
//estas siguen estando hasta que se cierra el navegador
session_start();
// Verificamos que la variable donde se guardará el ID del pasaje via POST
// no esté cargada, porque luego redireccionaremos a este controlador
// y no tendremos el valor a asignar mediante POST (lo que dará un error)
// porque ya estaría cargado

if(empty($_SESSION['pasajeid'])){
    $pasaje_id = $_POST['pasajeid'];
    $_SESSION['pasajeid'] = $pasaje_id;
}

$pasajeros = $_SESSION['pasajeros'];

require dirname(__DIR__).'/vistas/clientes.view.php';