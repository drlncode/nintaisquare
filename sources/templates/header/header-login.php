<div class="header-container">
    <div class="header-content-1">
        <div class="space"></div>
        <div class="logo">
            <a href="http://localhost/nintaisquare/"><img src="http://localhost/nintaisquare/sources/assets/img/logo.png" alt="NintaiSquare"></a>
        </div>
        <div class="user-container">
            <div class="user">
                <i class="fa-solid fa-circle-user"></i><i class="fa-solid fa-angle-down"></i>
                <ul class="user-options">
                    <li class="sistema user-link"><a href="http://localhost/nintaisquare/user/profile.php"><i class="fa-solid fa-user"></i> Mi perfil</a></li>
                    <li class="sistema user-link"><a href="http://localhost/nintaisquare/user/mystores.php"><i class="fa-solid fa-shop"></i> Mis tiendas</a></li>
                    <li class="sistema user-link"><a href="http://localhost/nintaisquare/user/settings.php"><i class="fa-solid fa-gear"></i> Ajustes</a></li>
                    <li class="sistema user-link"><a href="http://localhost/nintaisquare/user/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a></li>
                    <?php
                        if (isset($_SESSION["USER_AUTH"]["admin"]) && $_SESSION["USER_AUTH"]["admin"] === true) { ?>
                            <div class="line"></div><li><a href="" class="sistema list"><i class="fa-solid fa-user-gear"></i> Admin</a></li>
                        <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-content-2">
        <div class="links">
            <ul class="nav-container">
                <li class="sistema nav-link"><a href="http://localhost/nintaisquare/explore/">Explorar</a></li>
                <li class="sistema nav-link"><a href="http://localhost/nintaisquare/create/">Crear</a></li>
                <li class="sistema nav-link"><a href="http://localhost/nintaisquare/store/">Tiendas</a></li>
                <li class="sistema nav-link"><a href="http://localhost/nintaisquare/products/">Productos</a></li>
            </ul>
        </div>
        <div class="search">
            <a href="http://localhost/nintaisquare/search/" title="Buscar"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
    </div>
</div>