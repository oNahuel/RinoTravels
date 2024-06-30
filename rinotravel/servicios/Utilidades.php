<?php
function generate_dynamic_field_names(string $nombre , int $cantidad): array
//  NOTE: Esta función sirve para generar los nombres de formulario
// disponibles según la cantidad de pasajes elegidos
// EXAMPLE: nombre0, nombre1, apellido0, apellido1
{
    $permitidos = ['nombre','apellido','dni','genero','nacimiento'];
    $nombreconcatenado = [];
    if(in_array($nombre,$permitidos)){
        for ($x = 0; $x < $cantidad; $x++){
            $nombreconcatenado[] = $nombre.$x;
        }
        return $nombreconcatenado;
    } else {
        die();
    }
}
function redirect_to($uri): void
// NOTE: Esta función redirecciona a la URL especificada
{
    header("Location: $uri");
}

function clean_session() : void
// NOTE: Se usa para limpiar la sesión debido al flujo de la aplicación
// no se cierra la ventana y por ende, no se borra lo que está guardado en sesión
{
    if(session_status() == PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
    }
}
function set_date_format(string $date) : DateTime
// NOTE: Sirve para convertir un string al formato de fechas
{
    try {
        return DateTime::createFromFormat('Y-m-d',$date);
    } catch (Exception $e){
        die($e->getMessage());
    }
}
function set_time_format(string $time) : DateTime
// NOTE: Sirve para convertir un string al formato de tiempo
{
    try {
        return DateTime::createFromFormat('H:i:s',$time);
    } catch (Exception $e){
        die($e->getMessage());
    }
}
function get_date_latam(string $date) : string
// NOTE: Sirve para mostrar la fecha en nuestro formato mediante un string
{
    return set_date_format($date)->format('d-m-Y');
}
function get_time_latam(string $time) : string
// NOTE: Sirve para mostrar el tiempo en nuestro formato mediante un string
{
    return set_time_format($time)->format('H:i');
}
function get_field_names(int $cant_pasajes): array
{
    $nombres = generate_dynamic_field_names("nombre",$cant_pasajes);
    //Esto genera los campos nombre0,nombre1 de acuerdo a la cantidad de pasajes
    $apellidos = generate_dynamic_field_names("apellido",$cant_pasajes);
    $dnis = generate_dynamic_field_names("dni",$cant_pasajes);
    $generos = generate_dynamic_field_names("genero",$cant_pasajes);
    $nacimientos = generate_dynamic_field_names("nacimiento",$cant_pasajes);
    return [
        'nombre' => $nombres,
        //Esto tendría nombre0,nombre1 de acuerdo a la cantidad de pasajes
        'apellido' => $apellidos,
        'dni' => $dnis,
        'genero' => $generos,
        'nacimiento' => $nacimientos
    ];
}
