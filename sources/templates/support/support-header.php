<div class="header-container">
    <div class="logo-text">
        <img src="https://nintaisquare.com/sources/assets/img/logo-socials-negro.png">
        <h3 class="header-text">Soporte</h3>
    </div>
    <div class="user">
        <?php
            if (!isset($_SESSION["USER_AUTH"])) { ?>
                <a href="https://nintaisquare.com/user/signin.php?support" class="login"><i class="fa-solid fa-right-to-bracket"></i>Iniciar sesión</a>
            <?php } else { ?>
                <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $_SESSION["USER_AUTH"]["user_id"] ?>" class="account" target="_blank" title="<?= $_SESSION["USER_AUTH"]["name"] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
                    <p class="text"><?= $_SESSION["USER_AUTH"]["name_parts"][0] ?></p>
                </a>
            <?php }
        ?>
    </div>
</div>