<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><i class="bi bi-pencil-square"></i> Tareas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link" href="<?=site_url("tareas")?>"><i class="bi bi-house"></i> Inicio <span class="sr-only">(current)</span></a>
        </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-gear"></i> <?=ucfirst($this->session->userdata("usuario"))?>
        </a>
        <div class="dropdown-menu">
            <?php if($this->session->userdata("rol") == 1): ?>
            <a class="dropdown-item" href="<?=site_url("profile/admin_usuarios")?>"><i class="bi bi-people"></i> Adm. usuarios</a>
            <?php endif; ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?=site_url("profile/editar")?>"><i class="bi bi-people"></i> Editar Perfil</a>

            <a class="dropdown-item" href="<?=site_url("auth/logout")?>"><i class="bi bi-door-open"></i> Salir</a>
        </div>
        </li>
    </ul>
    </div>
</nav>