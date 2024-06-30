<?php require(dirname(__DIR__).'/vistas/partials/header.php') ?>
    <div class="nav-bar">
        <div class="nav-items">
            <div class="emp-logo">
                <a href="/rinotravel/">RinoTravel</a>
            </div>
            <a>Destinos</a>
            <a>Actividades</a>
            <a>Precios</a>

            <img src="/rinotravel/styles/icons/search.svg" alt="lupa">
        </div>
    </div>

    <div class="main-form">
        <div class="main-form-img">
            <img src="/rinotravel/styles/pexels-pok-rie-1726310.jpg" alt="marine">
        </div>
        <form class="home-form" method="post" action="controladores/PasajesController.php">
            <div class="main-form-group">
                <label for="origen" class="form-labels">Origen
                    <select name="origen" class="form-control form-control-sm">
                        <?php foreach ($origen as $ori):?>
                            <option value="<?php echo ucwords($ori['nombre']) ?>"><?php echo ucwords($ori['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label for="destino" class="form-labels">Destino
                    <select name="destino" class="form-control form-control-sm">
                        <?php foreach ($destino as $des):?>
                            <option value="<?php echo ucwords($des['nombre']) ?>"><?php echo ucwords($des['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label for="pasajeros" class="form-labels">Pasajeros
                    <select name="pasajeros" class="form-control form-control-sm" required>
                        <option selected disabled value="">--</option>
                        <?php foreach ($cantidad as $cant): ?>
                            <option value="<?php echo $cant ?>"><?php echo $cant ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label for="fecha" class="form-labels">Fecha
                    <input name="fecha" type="date" required>
                </label>

                <input type="submit" class="btn btn-submiteo" value="Consultar">

            </div>
        </form>
    </div>
<?php require (dirname(__DIR__).'/vistas/partials/footer.php');