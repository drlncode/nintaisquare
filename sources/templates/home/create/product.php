<div class="body-container">
    <div class="body-content">
        <h2 class="body-title"><i class="fa-solid fa-pen-to-square"></i>Regístrar producto.</h2>
        <form action="" method="post" class="form-container">
            <label for="p-name">
                Nombre del producto<input type="text" name="p-name" id="p-name" placeholder="Nombre del producto...">
            </label>
            <label for="p-tienda">Seleccinar la tienda</label>
            <select name="p-tienda" id="p-tienda">
                <option value="">Seleccione</option>
                <hr>
                <?php

                ?>
            </select>
            <div class="price-container">
                <div class="label"><label for="">Precio del producto</label></div>
                <div class="price-content">
                    <div class="p-price"><input type="number" name="p-price" id="p-price" placeholder="Especificar precio..."></div>
                    <div class="divisor"></div>
                    <div class="p-free"><label for="p-free"><input type="checkbox" name="p-free" id="p-free">Gratis</label></div>
                </div>
            </div>
            <label for="p-logo">
                Imagen del producto (Menos de 2MB)<input type="file" name="p-logo" id="p-logo">
            </label>
            <label for="p-desc">
                Descripción del producto<textarea name="p-desc" id="p-desc" rows="5" placeholder="Descripción llamativa del producto..."></textarea>
            </label>
            <div class="actions">
                <button type="submit">Registrar</button>
                <a href="https://nintaisquare.com/create/">Cancelar</a>
            </div>
        </form>
    </div>
</div>