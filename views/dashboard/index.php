<?php include_once __DIR__. '/header-dash.php' ?>

    <?php if (count($proyectos) === 0  ){ ?>


        <p class="no-proyectos">Aun no tienes ningun proyecto  <a href="crear-proyecto">Crea uno!</a></p>
<?php } else { ?>

    <ul class="listado-proyectos">
    <?php foreach ($proyectos as $proyecto) {?>
        
     <a href="/proyecto?url=<?php echo $proyecto->url ?>"><li class="proyecto">
        <p><?php echo $proyecto->proyecto ?></p></li></a> 

   <?php } ?>
    </ul>

    <?php } ?>

<?php include_once __DIR__. '/footer.php' ?>
   