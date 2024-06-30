<?php require(dirname(__DIR__).'/vistas/partials/header.php') ?>
    <div class="nav-bar">
        <div class="nav-items">
            <div class="emp-logo">
            <a href="/rinotravel/">RinoTravel</a>
            </div>
            <a>Resumen de su compra</a>
        </div>
    </div>
<div class="body-low">
    <div class="compra-rect">
        <form class="compra-form" method="post" action="FinalController.php">
            <?php foreach ($clientes as $cliente) : ?>
                <div class="compra-pasajeros-container">
                    <div class="compra-pasajeros-id">
                        <label for="cantidad">
                            <input name="cantidad" type="text" value="Pasajero <?php echo $contador + 1?>">
                        </label>

                    </div>
                    <div class="compra-pasajeros-fields">
                        <label for="nombre<?php echo $contador?>">
                            Nombre:
                            <input name="nombre<?php echo $contador?>" type="text" value="<?php echo $cliente->getNombre() ?>" readonly>
                        </label>
                        <label for="apellido<?php echo $contador?>">
                            Apellido:
                            <input name="apellido<?php echo $contador?>" type="text" value="<?php echo $cliente->getApellido() ?>" readonly>
                        </label>
                        <label>
                            DNI:
                            <input name="dni<?php echo $contador?>" type="text" value="<?php echo $cliente->getDni() ?>" readonly>
                        </label>
                        <label for="genero<?php echo $contador?>">
                            Género:
                            <input name="genero<?php echo $contador ?>" type="text" value="<?php echo $cliente->getGenero() ?>" readonly>
                        </label>
                        <label for="nacimiento<?php echo $contador ?>">
                            Fecha de nacimiento:
                            <input name="nacimiento<?php echo $contador ?>" type="text" value="<?php echo $cliente->getNacimiento(); ?>" readonly>
                        </label>
                    </div>
                </div>
                <?php $contador++?>
            <?php endforeach;?>
            <!--Mostrar precio-->
            <div class="compra-pasajeros-precio">
                <h4>El precio final es $<?php echo $precio; ?></h4>
            </div>
            <div class="compra-pasajeros-confirm">
                <button class="btn btn-submiteo-3"><a href="ClientesController.php">Editar</a></button>
                <div style="width: 10%"></div>
                <button class="btn btn-submiteo" type="submit">Confirmar</button>
            </div>
        </form>
    </div>
</div>

<?php require (dirname(__DIR__).'/vistas/partials/footer.php');