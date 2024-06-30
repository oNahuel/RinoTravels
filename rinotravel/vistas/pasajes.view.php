<?php require(dirname(__DIR__).'/vistas/partials/header.php') ?>
<div class="nav-bar">
    <div class="nav-items">
        <div class="emp-logo">
            <a href="/rinotravel/" title="Regresar al inicio">RinoTravel</a>
        </div>
        <a>Elija su pasaje</a>
    </div>
</div>
<div class="body-low">
    <?php if(!empty($pasajes)):?>
        <?php foreach ($pasajes as $pasaje):?>
        <div class="pasajes">
            <form method="post" action="ClientesController.php">
                <div class="pasaje-tipo">
                        <label for="pasajeid">Id
                            <input name="pasajeid" type="text" value="<?php echo $pasaje['id']?>" readonly>
                        </label>
                    <h2>Servicio <?php echo $pasaje['tipo'] ?></h2>
                </div>
                <div class="pasaje-horario">
                    <div class="pasaje-origen">
                        <div class="pasaje-text-1">SALE</div>
                        <div class="pasaje-text-2"><?php echo get_date_latam($pasaje['fecha_salida'])?></div>
                        <div class="pasaje-text-3"><?php echo get_time_latam($pasaje['hora_salida']).'hs'?></div>
                        <div class="pasaje-text-4"><?php echo ucwords($origen)?></div>
                    </div>
                    <div class="pasaje-tiempo">
                        <img src="/rinotravel/styles/icons/bus.svg" alt="clock">
                    </div>
                    <div class="pasaje-destino">
                        <div class="pasaje-text-1">LLEGA</div>
                        <div class="pasaje-text-2"><?php echo get_date_latam($pasaje['fecha_llegada'])?></div>
                        <div class="pasaje-text-3"><?php echo get_time_latam($pasaje['hora_llegada'])?></div>
                        <div class="pasaje-text-4"><?php echo ucwords($destino)?></div>
                    </div>
                </div>
                <div class="pasaje-precio">
                    <div class="pasaje-boton">
                        <div class="precio-php">
                            $<?php echo $pasaje['precio'] ?>
                            <small>por persona</small>
                        </div>
                        <input type="submit" class="btn btn-submiteo" value="Comprar">

                    </div>
                    <div class="asientos"><?php echo $pasaje['capacidad'] ?> asientos disponibles</div>
                </div>
            </form>

        </div>
        <?php endforeach; ?>
    <?php else:?>
    <div class="pasajes-not-found">
        <h3>No se encuentran pasajes para el origen, destino, pasajeros y fecha seleccionados</h3>
        <a href="/"><button class="btn btn-submiteo">Volver al inicio</button> </a>
    </div>
    <?php endif; ?>
</div>
<?php require (dirname(__DIR__).'/vistas/partials/footer.php');
