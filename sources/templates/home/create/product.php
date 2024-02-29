<div class="body-container">
    <div class="body-content">
        <h2 class="body-title"><i class="fa-solid fa-pen-to-square"></i>Regístrar producto.</h2>
        <form action="" method="post" class="form-container">
            <label for="p-name">
                Nombre de la tienda<input type="text" name="p-name" id="p-name" placeholder="Nombre de la tienda...">
            </label>
            <label for="p-tienda">Seleccinar la tienda</label>
            <select name="p-tienda" id="p-tienda">
                <option value="">Seleccione</option>
                <hr>
                <?php

                ?>
            </select>
            <label for="p-logo">
                Imagen del producto (Menos de 2MB)<input type="file" name="p-logo" id="p-logo">
            </label>
            <label for="p-desc">
                Descripción del producto<input type="text" name="p-desc" id="p-desc" placeholder="Descripción breve de la tienda...">
            </label>
            <label for="p-categoria">Categoria del producto</label>
            <select name="p-categoria" id="p-categoria">
                <option value="">Seleccione</option>
                <hr>
                <option value="tecnologia">Tecnologia</option>
                <option value="salud">Salud</option>
                <option value="entretenimiento">Entretenimiento</option>
                <option value="ropa">Ropa</option>
            </select>
            <div class="actions">
                <button type="submit">Registrar</button>
                <a href="https://nintaisquare.com/create/">Cancelar</a>
            </div>
        </form>
    </div>
</div>