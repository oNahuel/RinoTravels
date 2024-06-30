<?php
//Asignamos el título de la pestaña
$title = "Inicio";
clean_session();
$db = new Database();
//Estos array se usan para cargar los selectores
$origen = $db->get_cities('origen');
$destino = $db->get_cities('destino');
$db->close();

//Cantidad de pasajeros
$cantidad = [1,2,3,4,5,6];
require 'vistas/home.view.php';
