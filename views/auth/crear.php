<div class="contenedor crear">
   <?php include_once __DIR__.'/../templates/nombre.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu Cuenta</p>


        <?php include_once __DIR__.'/../templates/alertas.php' ?>
        <form method="POST" class="formulario">

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario->nombre?>">
        </div>

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"  value="<?php echo $usuario->email?>">
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" >
        </div>
        <div class="campo">
            <label for="password2">Confirmar password</label>
            <input type="password" id="password2" name="password2" >
        </div>
       
        <input type="submit" class="boton" value="Crean Cuenta">

        </form>
        <div class="acciones">
            <a href="/">Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/olvide">Olvidaste tu password?</a>
        </div>
    </div>
</div>