<?php include_once __DIR__. '/header-dash.php' ?>


<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id="agregar-tarea" > &#43; Nueva Tarea</button>
    </div>

    <ul id="listado-tareas" class="listado-tareas">
        
    </ul>
</div>



<?php include_once __DIR__. '/footer.php' ?>
   
<?php
$script='<script src="build/js/tareas.js"></script>';
?>