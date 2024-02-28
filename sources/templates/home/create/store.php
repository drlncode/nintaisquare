<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../../../assets/styles/create.css">
<link rel="stylesheet" href="../../../assets/styles/root.css">
<div class="body-container">
    <div class="body-content">
        <h2 class="body-title"><i class="fa-solid fa-pen-to-square"></i>Regístrar tienda.</h2>
        <form action="" method="post" class="form-container">
            <label for="store-name">
                Nombre de la tienda o negocio<input type="text" name="store-name" id="store-name" placeholder="Nombre de la tienda...">
            </label>
            <label for="categoria">Categoria de la tienda</label>
            <select name="categoria" id="categoria">
                <option value="">Seleccione</option>
                <hr>
                <option value="electronica">Tecnología</option>
                <option value="salud">Salud</option>
                <option value="entretenimiento">Entretenimiento</option>
                <option value="comidas">Comida</option>
                <option value="ropas">Vestimenta</option>
            </select>
            <label for="desc">
                Descripción de la tienda<input type="text" name="desc" id="desc" placeholder="Descripción breve de la tienda...">
            </label>
            <label for="logo">
                Logo de la tienda (Menos de 2MB)<input type="file" name="logo" id="logo">
            </label>
            <label for="direcc">
                Dirección de la tienda<input type="text" name="direcc" id="direcc" placeholder="Dirección actual de la tienda...">
            </label>
            <label for="tel">
                Telefono de la tienda<input type="number" name="tel" id="tel" max="12" placeholder="Teléfono de la tienda...">
            </label>
            <label for="s-email">
                Email de la tienda (Opcional)<input type="email" name="s-email" id="s-email" placeholder="Correo de la tienda...">
            </label>
            <div class="input-icon-container">
                <label for="">Redes Sociales de la tienda (Opcional)</label>
                <div class="input-icon">
                    <input class="ig urls-inputs" type="url" name="instagram" placeholder="URL Instagram"><i class="fa-brands fa-instagram"></i>
                </div>
                <div class="input-icon">
                    <input class="tw urls-inputs" type="url" name="twitter" placeholder="URL Twitter"><i class="fa-brands fa-twitter"></i>
                </div>
                <div class="input-icon">
                    <input class="fc urls-inputs" type="url" name="facebook" placeholder="URL Facebook"><i class="fa-brands fa-facebook"></i>
                </div>
            </div>
            <div class="actions">
                <button type="submit">Registrar</button>
                <a href="https://nintaisquare.com/create/">Cancelar</a>
            </div>
        </form>
    </div>
</div>