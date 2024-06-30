<?php

class Cliente
{
    private string $nombre;
    private string $apellido;
    private int $dni;
    private string $genero;
    private DateTime $nacimiento;

    public function __construct(string $nombre, string $apellido, int $dni, string $genero, string $nacimiento)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->genero = $this->set_genero($genero);
        $this->nacimiento = $this->set_date_format($nacimiento);
    }
    //Getters para cada uno porque esto no es C#
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getDni(): int
    {
        return $this->dni;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function getNacimiento() : string
    {
        return $this->nacimiento->format('Y-m-d');
    }
    public function getNacimientoFormateado() : string
    {
        //Este método se usa para ver la fecha como nosotros
        // y no como en Estados Unidos (por ej.)
        return $this->nacimiento->format('d-m-Y');
    }

    //Verificamos que el género sea solo de los permitidos
    private function set_genero(string $genero) : string
    {
        $generoLower = strtolower($genero);
        $allowed = ['masculino','femenino','no-binario'];
        return in_array($generoLower,$allowed) ? $generoLower : die();
    }
    //La fecha mostrada dd/mm/year difiere del valor que guarda
    // que es year/mm/DD, dejamos la conversión para verificar
    // si es necesaria para la fecha de postgres
    private function set_date_format(string $date) : DateTime {
        try {
            return DateTime::createFromFormat('Y-m-d',$date);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }
}