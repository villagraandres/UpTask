<?php include_once __DIR__. '/header-dash.php' ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        
        <a href="/perfil" class="enlace">Volver al Perfil</a>

        <form  class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Password Actual</label>
                <input type="password" name="passwordActual">
            </div>
            <div class="campo">
                <label for="email">Password Nuevo</label>
                <input type="password" name="passwordNuevo" id="passwordActual">




            </div>

            
            <div class="form-check" >
            <input  class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="myFunction()">
            <label class="form-check-label" for="flexCheckDefault">
              Mostrar
            </label>
    </div>

    

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <div class="acciones">
    <a class="enlace" href="/olvide">Recuperar Contraseña Actual</a>
    </div>


    <script>
    function myFunction(){
        var check=document.getElementById("passwordActual");
    if (check.type==="password") {
        check.type="text";
    }else{
        check.type = "password";
    }
    }
    
</script>
    
<?php include_once __DIR__. '/footer.php' ?>
   