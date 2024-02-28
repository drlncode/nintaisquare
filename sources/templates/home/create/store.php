<div class="body-container">
    <div class="body-content">
        <h2 class="body-title">Registrar tienda.</h2>
        <form action="" method="post" class="form-container">
            <label for="store-name">
                Nombre de la tienda o negocio<input type="text" name="store-name" id="store-name">
            </label>
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
            <label for="">
                Descripción de la tienda<input type="text" name="Desc" id="Desc">
            </label>
            <label for="">
                Logo de la tienda<input type="file" name="logo" id="logo">
            </label>
            <label for="">
                Dirección de la tienda<input type="text" name="direcc" id="direcc">
            </label>
            <label for="">
                Telefono de la tienda<input type="number" name="tel" id="tel">
            </label>
            <label for="">
                Email de la tienda<input type="email" name="s-email" id="s-email">
            </label>
            <div>
                <label for="">Redes Sociales de la tienda:</label>
                <input type="text" name="instagram">
                <input type="text" name="twitter">
                <input type="text" name="facebook">
            </div>
            <button type="submit">Registrar</button>
            <a href="">Cancelar</a>
        </form>
    </div>
</div>