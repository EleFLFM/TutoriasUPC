<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="img/admin.png" alt="" style="width: 35px;">
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index_admin.php">
            <img src="img/casa.png" alt="" style="width: 35px;">
            <span>Inicio</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Usuario Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <img src="img/persona.png" alt="" style="width: 35px;">
            <span><strong>Usuario</strong></span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="add_user.php">Agregar Nuevo</a>
                <a class="collapse-item" href="gestion_usuario.php">Gestión de Usuario</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Cursos Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <img src="img/curso.png" alt="" style="width: 35px;">
            <span><strong>Cursos</strong></span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="create_curso.php">Agregar Nuevo</a>
                <a class="collapse-item" href="gestion_cursos.php">Gestión de Cursos</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Comentarios (sin collapse) -->
    <li class="nav-item">
        <a class="nav-link" href="comentarios_docente.php">
            <img src="img/reporte.png" alt="" style="width: 35px;">
            <span><strong>Comentarios</strong></span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>