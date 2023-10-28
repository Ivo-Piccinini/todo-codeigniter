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
            <h2 class="text-center">Administración de usuarios</h2>
            <br>
            <div class="card">
                <div class="card-body">
                    <br>
                    <?php if($usuarios): ?>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Contraseña</th>
                                    <th scope="col">Último login</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usuarios as $u): ?>
                                    <tr>
                                        <th scope="row"><?=$u["usuario_id"]?></th>
                                        <th><?=$u["usuario"]?></th>
                                        <th><?=$u["password"]?></th>
                                        <th><?=$u["ult_login"]?></th>
                                        <th><?=$u["rol"]?></th>
                                        <th><?=$u["estado"]?></th>
                                        <th>
                                            <a href="<?=site_url("profile/quitar_usuario/".$u["usuario_id"])?>" class="btn btn-danger btn-sm borrar float-right">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </th>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-primary text-center" role="alert">
                            No hay usuarios
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div> <!-- CIERRE DE COL -->
      </div>  <!-- CIERRE DE ROW -->
    </div>  <!-- CIERRE DE CONTAINER -->

   

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            $(".borrar").click(function(e){
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