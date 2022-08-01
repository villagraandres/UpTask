!function(){!async function(){try{const t="/api/tareas?url="+i(),a=await fetch(t),o=await a.json();e=o.tareas,n()}catch(e){console.log(e)}}();let e=[],t=[];document.getElementById("agregar-tarea").addEventListener("click",(function(){o()}));function a(a){const o=a.target.value;t=""!==o?e.filter(e=>e.estado===o):[],n()}function n(){!function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),function(){const t=e.filter(e=>"0"===e.estado),a=document.querySelector("#pendientes");0===t.length?a.disabled=!0:a.disabled=!1}(),function(){const t=e.filter(e=>"1"===e.estado),a=document.querySelector("#completadas");0===t.length?a.disabled=!0:a.disabled=!1}();const a=t.length?t:e;if(0===a.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="Este proyecto aun no tiene tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const d={0:"Pendiente",1:"Completa"};a.forEach(t=>{const a=document.createElement("LI");a.dataset.tareaId=t.id,a.classList.add("tarea");const s=document.createElement("P");s.textContent=t.nombre,s.ondblclick=function(){o(!0,{...t})};const l=document.createElement("DIV");l.classList.add("opciones");const u=document.createElement("BUTTON");u.classList.add("estado-tarea"),u.classList.add(""+d[t.estado].toLowerCase()),u.textContent=d[t.estado],u.dataset.estadoTarea=t.estado,u.ondblclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,c(e)}({...t})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=t.id,m.textContent="Eliminar",m.onclick=function(){!function(t){Swal.fire({title:"Deseas eliminar la tarea?",text:"No podras revertir estos cambios!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Confirmar"}).then(a=>{a.isConfirmed&&async function(t){const{estado:a,id:o,nombre:c,proyectoId:d}=t,s=new FormData;s.append("id",o),s.append("nombre",c),s.append("estado",a),s.append("url",i());try{const a=r+"/api/tarea/eliminar",o=await fetch(a,{method:"POST",body:s});(await o.json()).resultado&&(Swal.fire("Eliminada!","La tarea ha sido borrado correctamente.","success"),e=e.filter(e=>e.id!==t.id),n())}catch(e){}}(t)})}({...t})},l.appendChild(u),l.appendChild(m),a.appendChild(s),a.appendChild(l);document.querySelector("#listado-tareas").appendChild(a)})}function o(t=!1,a={}){const o=document.createElement("DIV");o.classList.add("modal"),o.innerHTML=`\n       <form class="formulario nueva-tarea">\n        <legend>${t?"Editar Tarea":"Añade una nueva tarea"}</legend>\n\n        <div class="campo">\n            <label>Tarea</label>\n            <input type="text" name="tarea" placeholder="Nombre de la tarea" id="tarea" value="${a.nombre?a.nombre:""}" />\n        </div>\n\n        <div class="opciones">\n            <input type="submit" class="submit-nueva-tarea" value="${a.nombre?"Editar Tarea":"Crear Tarea"}" "/>\n\n            <button type="button" class="cerrar-modal"> Cancelar</button>\n        </div>\n\n\n       </form>\n       \n       `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),o.addEventListener("click",(function(s){if(s.preventDefault(),s.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{o.remove()},500)}if(s.target.classList.contains("submit-nueva-tarea")){const o=document.querySelector("#tarea").value.trim();if(""===o)return void d("El nombre de la tarea es obligatorio","error",document.querySelector(".formulario legend"));t?(a.nombre=o,c(a)):async function(t){const a=new FormData;a.append("nombre",t),a.append("proyectoId",i());try{const o=r+"/api/tarea",c=await fetch(o,{method:"POST",body:a}),i=await c.json();if(d(i.mensaje,i.tipo,document.querySelector(".formulario legend")),"exito"===i.tipo){const a=document.querySelector(".modal");btnCrear=document.querySelector(".submit-nueva-tarea"),btnCrear.disabled=!0,setTimeout(()=>{a.remove()},1e3);const o={id:String(i.id),nombre:t,estado:"0",proyectoId:i.proyectoId};e=[...e,o],n()}}catch(e){console.log(e)}}(o)}})),document.querySelector(".dashboard").appendChild(o)}document.querySelectorAll('#filtros input[type="radio"]').forEach(e=>{e.addEventListener("input",a)});const r=window.location.origin;async function c(a){try{const{estado:o,id:c,nombre:d,proyectoId:s}=a,l=new FormData;l.append("id",c),l.append("nombre",d),l.append("estado",o),l.append("url",i());const u=r+"/api/tarea/actualizar",m=await fetch(u,{method:"POST",body:l});if("exito"===(await m.json()).respuesta.tipo){Swal.fire({icon:"success",title:"La tarea se ha actualizado correctamente",showConfirmButton:!1,timer:1e3});const a=document.querySelector(".modal");a&&a.remove(),e=e.map(e=>(e.id===c&&(e.estado=o,e.nombre=d),e));const r=document.querySelector('input[name="filtro"]:checked').value;r&&(t=e.filter(e=>e.estado===r)),n()}}catch(e){console.log(e)}}function i(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).url}function d(e,t,a){const n=document.querySelector(".alertas");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alertas",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},4e3)}}();