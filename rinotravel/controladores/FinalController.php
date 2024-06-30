<?php
require dirname(__DIR__).'/modelos/Database.php';
require dirname(__DIR__).'/modelos/Cliente.php';
require dirname(__DIR__).'/servicios/Utilidades.php';
$title = "Fin de la compra";
$db = new Database();
//Se recuperan los datos de la sesión
session_start();
$pasaje_id = $_SESSION['pasajeid'];
$cant_pasajes = (int)$_SESSION['pasajeros'];

//Se recuperan los datos del formulario
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
$status = 0;
// Se cargan los clientes a la base de datos
foreach ($clientes as $cliente) {
    //Si existe un cliente con el DNI no se inserta
    if($db->insertarCliente($cliente)) {
        // Si se carga el cliente porque no existe en la base de datos
        // obtener el ID y guardar la venta
        if($db->set_ventas($db->get_cliente_id($cliente->getDni()),$pasaje_id)){
            $status = 1;
        }
    } else {
        // Cuando el cliente existe y coinciden sus datos
        if($db->client_data_exists($cliente->getNombre(),
            $cliente->getApellido(), $cliente->getDni(),
            $cliente->getGenero(), $cliente->getNacimiento()))
        {
            // Obtenemos el ID y guardamos la venta
            if($db->set_ventas($db->get_cliente_id($cliente->getDni()),$pasaje_id)){
                $status = 1;
            }
        } else {
            // Cuando el cliente existe, pero no coinciden sus datos
            $status = 0;
        }
    }
}

require dirname(__DIR__).'/vistas/final.view.php';