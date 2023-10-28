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
          <h1 class="text-center"> Editar perfil </h1>
          <div class="card">
            <div class="card-body">
              <h4>Editar contraseña</h4>
              <hr>
              <?=$this->session->flashdata("msj")?>
              <form method="post" action="<?php echo site_url("profile/editar");?>">
                <div class="form-group">
                  <label for="pass">Nueva contraseña </label>
                  <input type="password" class="form-control" name="pass" id="pass">
                  <?=form_error("pass",'<small class="text-danger">','</small>')?>
                </div>  <!-- cierre de form-group -->
                <div class="form-group">
                  <label for="confpass">Confirmar contraseña </label>
                  <input type="password" class="form-control" name="confpass" id="confpass">
                  <?=form_error("confpass",'<small class="text-danger">','</small>')?>
                </div>  <!-- cierre de form-group -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-arrow-down-fill"> </i>Actualizar</button>
              </form>
            </div> <!-- cierre de card-body-->
          </div> <!-- cierre de card -->

          <br>
          <br>

          <div class="card">
            <div class="card-body">
              <h4>Editar usuario</h4>
              <hr>
              <?=$this->session->flashdata("msj-usuario")?>
              <form method="post" action="<?php echo site_url("profile/editar_usuario");?>">
                <div class="form-group">
                  <label for="newuser">Nuevo nombre de usuario </label>
                  <input type="text" class="form-control" name="newuser" id="newuser">
                  <?=form_error("newuser",'<small class="text-danger">','</small>')?>
                </div>  <!-- cierre de form-group -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-arrow-down-fill"> </i>Actualizar</button>
              </form>
            </div>
          </div>
        </div> <!-- CIERRE DE COL -->
      </div>  <!-- CIERRE DE ROW -->
      <br>
      <br>
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