<?php include_once __DIR__. '/header-dash.php' ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>


       
        <form  class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $usuario->nombre ?>" placeholder="Tu Nombre">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $usuario->email ?>" placeholder="ejemplo@ejemplo.com">
            </div>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>


    <div class="acciones">
            <a class="enlace" href="/cambiar-password">Cambiar Password</a>
           
        </div>

        

<?php include_once __DIR__. '/footer.php' ?>
   