<?php require(dirname(__DIR__).'/vistas/partials/header.php') ?>
    <div class="nav-bar">
        <div class="nav-items">
            <div class="emp-logo">
                <a href="/rinotravel/">RinoTravel</a>
            </div>
            <a>Ingrese datos de los pasajeros</a>
        </div>
    </div>
<div class="body-low">
    <p>Para no cargar datos, usar dni 1234 o 4321 o 1111</p>
    <div class="personas-form">

        <!--Generamos una serie de campos a llenar por cada pasajero
        y le asignamos un número al nombre para diferenciarlos
        en la carga-->
        <form method="post" action="CompraController.php">
            <?php for($x = 0; $x < (int)$_SESSION['pasajeros'];$x++):?>
            <h2>Pasajero <?php echo $x + 1?></h2>
            <div class="clientes-fields">
                <label for="nombre<?php echo $x?>"> Nombre
                    <input name="nombre<?php echo $x?>" type="text" required>
                </label>
                <label for="apellido<?php echo $x?>"> Apellido
                    <input name="apellido<?php echo $x?>" type="text" required>
                </label>
            </div>
            <div class="clientes-fields">
                <label for="dni<?php echo $x?>"> Número de documento
                    <input name="dni<?php echo $x?>" type="number" required>
                </label>
                <label for="genero<?php echo $x?>">Género
                    <select name="genero<?php echo $x?>" required>
                        <option selected disabled value="">Seleccione una opción...</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="no-binario">No-binario</option>
                    </select>
                </label>
            </div>
            <div>
                <label for="nacimiento<?php echo $x?>"> Fecha de nacimiento
                    <input name="nacimiento<?php echo $x?>" type="date" required>
                </label>
            </div>
            <?php endfor; ?>
            <div class="clientes-submit">
                <input type="submit" class="btn btn-submiteo-2" value="Confirmar">
            </div>

        </form>
    </div>


</div>
<?php require (dirname(__DIR__).'/vistas/partials/footer.php');