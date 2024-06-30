<?php
//Usar clase
use Dotenv\Dotenv;
use PgSql\Connection;

//cargar paquete env
require dirname(__DIR__) . '/vendor/autoload.php';
//ruta .env
$dotenv = Dotenv::createMutable(dirname(__DIR__));
//cargar
$dotenv->load();

class   Database
{

    private PDO|null $connection;
    public function __construct()
    {
        try {
            $host = $_ENV['HOST'];
            $database = $_ENV['DATABASE'];
            $user = $_ENV['USERNAME'];
            $pass = $_ENV['PASSWORD'];
            $this->connection = new PDO("mysql:host=$host;dbname=$database",$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_cities(string $type): array
    {
        try {
            $query = "SELECT nombre FROM $type";

            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();  //Devuelve array asociativo. [Clave => Valor]
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }

    public function get_pasajes(string $origen, string $destino, int $pasajes, string $fecha): array
    {
        try {
            // Esta consulta selecciona todas las columnas de pasajes y las columnas
            // capacidad y tipo de la tabla vehiculos.
            // Mediante el uso de JOIN unimos las tablas origen y destino
            // que tengan el mismo ID del pasaje con ese origen, destino y fecha (WHERE)
            // También, añadimos la tabla vehículos de acuerdo al ID del vehículo especificado
            // y las ventas mediante el mismo id del pasaje.
            // Luego se agrupan para obtener la capacidad restante de cada combinación
            // y se filtran restando a la capacidad del vehículo los pasajes vendidos
            // NOTA: Es importante destacar que se debe verificar que en la resta
            // COUNT no sea nulo, para ello se usa COALESCE equivalente a IFNULL
            // que verifica si los valores son null, y retorna el siguiente
            // de esta forma la consulta se va a ejecutar correctamente
            // cuando no haya ventas relacionadas en el JOIN ventas
            $query = "SELECT p.*,v.tipo ,v.capacidad - COALESCE(COUNT(s.id), 0) AS capacidad
            FROM pasajes p
            JOIN origen o ON p.origen_id = o.id
            JOIN destino d ON p.destino_id = d.id
            JOIN vehiculos v ON p.vehiculo_id = v.id
            LEFT JOIN ventas s ON s.pasaje_id = p.id
            WHERE o.nombre = '$origen'
            AND d.nombre = '$destino'
            AND p.fecha_salida = '$fecha'
            GROUP BY p.id, v.tipo, v.id
            HAVING capacidad > $pasajes";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
        } catch (PDOException $ex) {
            die("Error:" . $ex->getMessage());
        }
    }

    public function close(): void
    {
        $this->connection = null;
    }

    public function get_cliente_id(int $dni): int
    {
        try {
            $query = "SELECT id FROM clientes WHERE dni = ?";

            $result = $this->connection->prepare($query);
            $result->execute([$dni]);
            return (int)$result->fetchColumn();
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }


    public function insertarCliente(Cliente $cliente): bool
    {
        try {
            $dni = $cliente->getDni();
            $query = "SELECT COUNT(*) AS count FROM clientes WHERE dni = ?";

            $result = $this->connection->prepare($query);
            $result->execute([$dni]);
            $data = $result->fetch(PDO::FETCH_ASSOC);

            if ((int)$data['count'] > 0) {
                // Ya existe un cliente con el mismo DNI, no se inserta
                return false;
            }

            $nombre = strtolower($cliente->getNombre());
            $apellido = strtolower($cliente->getApellido());
            $genero = $cliente->getGenero();
            $nacimiento = $cliente->getNacimiento();

            $query = "INSERT INTO clientes (nombre, apellido, dni, genero, nacimiento) VALUES (?, ?, ?, ?, ?)";
            $result = $this->connection->prepare($query);
            $result->execute([$nombre, $apellido, $dni, $genero, $nacimiento]);

            return true;
        } catch (PDOException $ex) {
            // Manejo del error si ocurre alguna excepción
            die("Error: " . $ex->getMessage());
        }
    }

    public function set_ventas(int $idcliente, int $idpasaje): bool
    {
        try {
            $query = "INSERT INTO ventas (pasaje_id, cliente_id) VALUES (?, ?)";

            $result = $this->connection->prepare($query);
            return $result->execute([$idpasaje, $idcliente]);
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }

    public function get_precio($pasaje_id) : int
    {
        try {
            $query = "SELECT precio FROM pasajes WHERE id = $pasaje_id";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result = $this->connection->query($query);
            return (int)$result->fetchColumn();
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }

    public function client_data_exists(string $nombre, string $apellido, int $dni, string $genero, string $nacimiento) : bool
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM clientes c
                WHERE c.nombre = '$nombre'
                AND c.apellido = '$apellido'
                AND c.dni = $dni
                AND c.genero = '$genero'
                AND c.nacimiento = '$nacimiento'";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $success = $result->fetchAll();
            if($success[0]['count'] >= 1){
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }

}
