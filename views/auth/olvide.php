<div class="contenedor olvide">
   <?php include_once __DIR__.'/../templates/nombre.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reecuperar Password</p>

        <form  method="POST" class="formulario">

       
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com">
        </div>

       
        <input type="submit" class="boton" value="Recuperar Cuenta">

        </form>
        <div class="acciones">
            <a href="/">Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/crear">No tienes cuenta? Crea una!</a>
        </div>
    </div>
</div>