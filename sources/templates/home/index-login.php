<div class="body-container">
    <div class="content-1">
        <div class="text-container">
            <div class="title-content">
                <h1 class="title"><?= greats() . $_SESSION["USER_AUTH"]["name"]; ?></h1>
            </div>
            <div class="text-content">
                <p class="text">Que quieres hacer hoy?</p>
            </div>
        </div>
        <div class="links-button">
            <div class="link-button button-1">
                <a href="../explore/" class="button">Explorar <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="link-button button-2">
                <a href="../create/" class="button">Registrar mi tienda <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </div>
    <div class="content-2">
        <div class="text-container">
            <div class="title-content">
                <h3 class="sub-title"><i class="fa-solid fa-map-location-dot"></i> Explorar</h3>
            </div>
            <div class="text">
                <p>Descubre todo tipo de tiendas interesantes y los productos que te ofrecen. Puedes ver las diferentes tiendas registradas ordenadas por categoria, asi como tambien todos sus productos ordenados por categoria.</p>
            </div>
        </div>
        <div class="text-container">
            <div class="title-content">
                <h3 class="sub-title"><i class="fa-solid fa-shop"></i> Registrar tienda</h3>
            </div>
            <div class="text">
                <p>Registra tu tienda de forma gratuita para que las personas puedan ver tu lista de productos. Asegurate de seguir los pasos para registrarla correctamente, para dar a conocer tu tienda de forma correcta al público.</p>
            </div>
        </div>
    </div>
</div>