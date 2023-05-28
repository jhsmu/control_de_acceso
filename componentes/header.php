<?php
        session_start();
        require './database/conexion.php'; 

        $consulta=$DB_con->prepare('SELECT * FROM administrador WHERE id=:id');
        $consulta->bindParam(':id', $_SESSION['id']);
        $consulta->execute();
        $cliente=$consulta->fetch(PDO::FETCH_ASSOC);  
?>
<header>
<nav class="navbar navbar-expand-md border-bottom border-primary">
        <div class="container-fluid">
            <a href="./administracion.php" class="navbar-brand">Control De Acceso</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="MenuNavegacion" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto" id="nav1">
                    <li class="nav-item"><a href="./colaboradores.php" class="nav-link">Colaboradores</a></li>
                    <li class="nav-item"><a href="./estudiantes.php" class="nav-link">Estudiantes</a></li>
                    <li class="nav-item"><a href="./entrad-salida.php" class="nav-link">Entrada/Salida</a></li>
                    <li class="nav-item"><a href="./informe.php" class="nav-link">Informe</a></li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <label for="" class="centro"><?php echo $cliente["nombre"] ?></label>
                        </a>
                        <div class=" transparentes">
                            <ul class="dropdown-menu" id="menu">
                                <li class="nav-item"><a class="nav-link dropdown-item"
                                        href="./sesion/cerrarsesion.php"><i class="fa fa-door-open"></i>Cerrar
                                        sesión</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>