<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
  </head>
  <body>
    <?php $this->load->view("barra") ?>
    <div class="container">

      <div class="row">
        <div class="col">
          <br>
          <h1 class="text-center"> Tareas Pendientes </h1>
          <div class="card">
            <div class="card-body">
              <form method="post" action="<?php echo site_url("tareas/guardar");?>">
                <div class="form-group">
                  <label for="tarea">Tarea </label>
                  <input type="text" class="form-control" name="tarea" id="tarea">
                </div>  <!-- cierre de form-group -->
                <div class="form-group">
                  <select name="prioridad" class="form-control custom-select">
                    <!--Acá recorremos "prioridades", que son todas las prioridades que están activas-->
                    <?php foreach($prioridades as $p): ?>
                      <!--Si la "prioridad_id" es igual a 2 (osea normal), se le pone la propiedad "selected"-->
                      <option
                        <?php if($p["prioridad_id"] == 2): ?>
                          selected
                        <?php endif; ?>
                        value="<?=$p["prioridad_id"]?>">
                        <?=$p["prioridad"];?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-arrow-down-fill"> </i>Guardar tarea</button>
              </form>

            </div> <!-- cierre de card-body-->
          </div> <!-- cierre de card -->
        </div> <!-- CIERRE DE COL -->
      </div>  <!-- CIERRE DE ROW -->
      <br>
      <br>
      <div class="row">
        <div class="col">
          <!--Si hay tareas...-->
          <?php if($tareas): ?>
            <ul class="list-group">
              <!--Recorremos el array $tareas, que contiene la info de todas las tareas-->
              <?php foreach($tareas as $t): ?>
                <li class="list-group-item">
                  <!--Mostramos el texto de la tarea-->
                  <?=$t["texto"];?>
                  <span class="float-right">
                    <!--Hacemos el botón de borrar, que llama al método "quitar" del controlador "tareas" desde el href-->
                    <a href="<?=site_url("tareas/quitar/".$t["tarea_id"])?>" class="btn btn-danger btn-sm borrar">
                      <i class="bi bi-trash"></i>
                    </a>
                  </span>
                  <div class="float-right">
                    <!--Mostramos la prioridad de la tarea-->
                    <small><?=$t["prioridad"]?></small>&nbsp&nbsp&nbsp&nbsp&nbsp
                  </div>
              </li>
              <?php endforeach; ?>
            </ul>
            <br>
                <!--Mostramos la cantidad de tareas-->
                <p>
                  Total de tareas: <b><?=$total;?></b>
                  <span class="float-right">
                  <a id="btn-borrartodo" href="<?=site_url("tareas/quitar_todo")?>" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash">Borrar todo</i>
                  </a>
                </span>
                </p>
                
            <br>
          <!--Si no hay tareas, mostramos un cartel-->
          <?php else: ?>
            <div class="alert alert-primary text-center" role="alert">
              no hay pendientes 
            </div>
          <?php endif; ?>
        </div> <!-- CIERRE DE COL 2 -->
      </div> <!-- CIERRE DE ROW 2 -->
    </div>  <!-- CIERRE DE CONTAINER -->

   

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
      $(document).ready(function(){
        $("#btn-borrartodo,.borrar").click(function(e){
          e.preventDefault();
          // prop es para leer o modificar el contenido de cualquier propiedad
          var direccion = $(this).prop("href");
          bootbox.confirm("Estás seguro??", function(r){
            if(r){
              location.href = direccion;
            }
          })
        })
      })
    </script>
  </body>
</html>