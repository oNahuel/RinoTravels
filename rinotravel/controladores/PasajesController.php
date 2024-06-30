<?php
require dirname(__DIR__).'/modelos/Database.php';
require dirname(__DIR__).'/servicios/Utilidades.php';
$title = "Pasajes";
//Se obtienen los valores enviados por el formulario
$origen = strtolower($_POST['origen']);
$destino = strtolower($_POST['destino']);
$pasajeros = $_POST['pasajeros'];
$fecha = $_POST['fecha'];

$db = new Database();

$pasajes = $db->get_pasajes($origen,$destino,$pasajeros,$fecha);
$db->close();
//Guardamos en una variable global la cantidad de pasajeros para el futuro
session_start();
$_SESSION['pasajeros'] = $pasajeros;
// Pedimos la vista
require dirname(__DIR__).'/vistas/pasajes.view.php';

