<div class="contenedor login">
<?php include_once __DIR__.'/../templates/nombre.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <?php include_once __DIR__.'/../templates/alertas.php' ?>
        <form action="/" method="POST" class="formulario">
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="campo">
            <label for="email">Password</label>
            <input type="password" id="password" name="password" >
        </div>
        <input type="submit" class="boton" value="Iniciar Sesión">

        </form>
        <div class="acciones">
            <a href="/crear">No tienes cuenta? Crea una!</a>
            <a href="/olvide">Olvidaste tu password?</a>
        </div>
    </div>
</div>