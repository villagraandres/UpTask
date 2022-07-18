<div class="contenedor reestablecer">
   <?php include_once __DIR__.'/../templates/nombre.php' ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablecer Password</p>
        <?php include_once __DIR__.'/../templates/alertas.php' ?>  
        <?php if(!$mostrar)  return ?>


        
        <form  method="POST" class="formulario">

       
       
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" >
        </div>


        <div class="campo">
            <label for="password2">Confirmar password</label>
            <input type="password" id="password2" name="password2" >
        </div>


        <input type="submit" class="boton" value="Recuperar Cuenta">

        </form>
       
    </div>
</div>