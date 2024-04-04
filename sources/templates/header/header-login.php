<div class="header-container">
    <div class="header-content-1">
        <div class="space"></div>
        <div class="logo">
            <a href="https://nintaisquare.com/"><img src="https://nintaisquare.com/sources/assets/img/logo.png" alt="NintaiSquare"></a>
        </div>
        <div class="user-container">
            <div class="user">
                <i class="fa-solid fa-circle-user"></i><i class="fa-solid fa-angle-down"></i>
                <ul class="user-options">
                    <li class="sistema user-link"><a href="https://nintaisquare.com/user/profile.php?user_id=<?= $_SESSION['USER_AUTH']['user_id'] ?>"><i class="fa-solid fa-user"></i> Mi perfil</a></li>
                    <li class="sistema user-link"><a href="https://nintaisquare.com/user/mystores.php"><i class="fa-solid fa-shop"></i> Mis tiendas</a></li>
                    <li class="sistema user-link"><a href="https://nintaisquare.com/user/settings.php" target="_blank"><i class="fa-solid fa-gear"></i> Ajustes</a></li>
                    <li class="sistema user-link"><a href="https://nintaisquare.com/user/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a></li>
                    <?php
                        if (isset($_SESSION["USER_AUTH"]["admin"]) && $_SESSION["USER_AUTH"]["admin"] === true) { ?>
                            <div class="line"></div><li><a href="https://nintaisquare.com/sources/controller/admin/" class="sistema list"><i class="fa-solid fa-user-gear"></i> Admin</a></li>
                        <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-content-2">
        <div class="links">
            <ul class="nav-container"> <!-- Encabezado modificado; D: Tiendas, Productos. A: Inicio. -->
                <li class="sistema nav-link"><a href="https://nintaisquare.com/home/">Inicio</a></li>
                <li class="sistema nav-link"><a href="https://nintaisquare.com/explore/">Explorar</a></li>
                <li class="sistema nav-link"><a href="https://nintaisquare.com/create/">Crear</a></li>
            </ul>
        </div>
        <div class="search">
            <a href="https://nintaisquare.com/search/" title="Buscar"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
    </div>
</div>