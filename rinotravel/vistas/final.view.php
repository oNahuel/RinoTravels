<?php require(dirname(__DIR__).'/vistas/partials/header.php') ?>
    <div class="nav-bar">
        <div class="nav-items">
            <div class="emp-logo">
                <a href="/rinotravel/">RinoTravel</a>
            </div>
            <a>Compra finalizada</a>
        </div>
    </div>
<div class="body-end">
    <div class="body-desc">
        <?php if($status == 0) :?>
            <h2>Venta fallida</h2>
            <h3>Ya existe un cliente asignado a ese DNI y los datos no coinciden</h3>
        <?php else: ?>
            <h2>Venta exitosa</h2>
            <h3>Muchas gracias por su compra</h3>
        <?php endif; ?>
    </div>
    <?php if($status == 0) :?>
    <div>
        <a href="ClientesController.php"><button class="btn btn-submiteo-3">Editar los datos</button> </a>
        <a href="/rinotravel/"><button class="btn btn-submiteo">Volver al inicio</button> </a>
    </div>

    <?php else: ?>
        <a href="/rinotravel/"><button class="btn btn-submiteo">Volver al inicio</button> </a>
    <?php endif; ?>
</div>

<?php require (dirname(__DIR__).'/vistas/partials/footer.php');