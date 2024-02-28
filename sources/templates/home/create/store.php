<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../../../assets/styles/create.css">
<link rel="stylesheet" href="../../../assets/styles/root.css">
<div class="body-container">
    <div class="body-content">
        <h2 class="body-title">Registrar tienda.</h2>
        <form action="" method="post" class="form-container">
            <label for="store-name">
                Nombre de la tienda o negocio<input type="text" name="store-name" id="store-name">
            </label>
            <label for="categoria">Categoria de la tienda</label>
            <select name="categoria" id="categoria">
                <option value="">Opciones</option>
                <hr>
                <option value="electronica">Electrónica</option>
                <option value="salud">Salud</option>
                <option value="entretenimiento">Entretenimiento</option>
                <option value="comidas">Comidas</option>
                <option value="ropas">Ropas</option>
                <option value="Otros">Otros</option>
            </select>
            <label for="desc">
                Descripción de la tienda<input type="text" name="desc" id="desc">
            </label>
            <label for="logo">
                Logo de la tienda<input type="file" name="logo" id="logo">
            </label>
            <label for="direcc">
                Dirección de la tienda<input type="text" name="direcc" id="direcc">
            </label>
            <label for="tel">
                Telefono de la tienda<input type="number" name="tel" id="tel" max="12">
            </label>
            <label for="s-email">
                Email de la tienda<input type="email" name="s-email" id="s-email">
            </label>
            <div class="input-icon-container">
                <label for="">Redes Sociales de la tienda (Opcional):</label>
                <div class="input-icon">
                    <input type="url" name="instagram" placeholder="URL Instagram"><i class="fa-brands fa-instagram"></i>
                </div>
                <div class="input-icon">
                    <input type="url" name="twitter" placeholder="URL Twitter"><i class="fa-brands fa-twitter"></i>
                </div>
                <div class="input-icon">
                    <input type="url" name="facebook" placeholder="URL Facebook"><i class="fa-brands fa-facebook"></i>
                </div>
            </div>
            <div class="actions">
                <button type="submit">Registrar</button>
                <a href="https://nintaisquare.com/create/">Cancelar</a>
            </div>
        </form>
    </div>
</div>