<?php
require dirname(__DIR__).'/modelos/Database.php';
require dirname(__DIR__).'/modelos/Cliente.php';
require dirname(__DIR__).'/servicios/Utilidades.php';
$title = "Compra";

$db = new Database();
session_start();
$cant_pasajes = (int)$_SESSION['pasajeros'];
$pasaje_id = $_SESSION['pasajeid'];
//La siguiente función genera los nombres de los campos de acuerdo a la cantidad de pasajes
//Por ej. nombre0, nombre1, apellido0, apellido1
$campos = get_field_names($cant_pasajes);
$clientes = array();

for ($x = 0; $x < $cant_pasajes; $x++){
    $clientes[] = new Cliente(
        //Recuperamos los valores con su respectiva clave
        nombre: $_POST[$campos['nombre'][$x]],
        apellido: $_POST[$campos['apellido'][$x]],
        dni: $_POST[$campos['dni'][$x]],
        genero: $_POST[$campos['genero'][$x]],
        nacimiento: $_POST[$campos['nacimiento'][$x]]
    );
}

$precio = $db->get_precio($pasaje_id) * $cant_pasajes;


$db->close();
$contador = 0;

require dirname(__DIR__).'/vistas/compra.view.php';