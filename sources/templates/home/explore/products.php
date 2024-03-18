<div class="content-sp">
    <div class="filter-container">
        <div class="title-filter">
            <h2 class="title"><i class="fa-solid fa-filter"></i>Filtrar por:</h2>
        </div>
        <div class="filter-options-container">
            <form action="../explore/filter/" method="get">
                <div class="sub-title-filter">
                    <h2>Categoria</h2>
                </div>
                <fieldset class="fieldset-container">
                    <legend class="fieldset-title">Seleccione una categoria</legend>
                    <div class="filter-options">
                        <label for="entretenimiento">
                            <input type="radio" name="product-category" value="entretenimiento" id="entretenimiento" checked>Entretenimiento
                        </label>
                        <label for="comida">
                            <input type="radio" name="product-category" value="comida" id="comida">Comida
                        </label>
                        <label for="salud">
                            <input type="radio" name="product-category" value="salud" id="salud">Salud
                        </label>
                        <label for="ropas">
                            <input type="radio" name="product-category" value="ropas" id="ropas">Ropas
                        </label>
                        <label for="tecnologia">
                            <input type="radio" name="product-category" value="tecnologia" id="tecnologia">Tecnología
                        </label>
                        <label for="canasta-basica">
                            <input type="radio" name="product-category" value="c-basica" id="canasta-basica">Canasta básica
                        </label>
                        <label for="mecanica">
                            <input type="radio" name="product-category" value="mecanica" id="mecanica">Mecánica
                        </label>
                        <label for="ventas-generales">
                            <input type="radio" name="product-category" value="v-generales" id="ventas-generales">Ventas generales
                        </label>
                    </div>
                </fieldset>
                <div class="sub-title-filter">
                    <h2>Creación</h2>
                </div>
                <fieldset class="fieldset-container">
                    <legend class="fieldset-title">Seleccione una opcion</legend>
                    <div class="filter-options">
                        <label for="newest">
                            <input type="radio" name="order-by" value="DESC" id="newest" checked>Más nuevo
                        </label>
                        <label for="older">
                            <input type="radio" name="order-by" value="ASC" id="older">Más antiguo
                        </label>
                    </div>
                </fieldset>
                <div class="filter-button">
                    <div class="div-space"></div>
                    <button class="sort" type="submit">Filtrar<i class="fa-solid fa-filter"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="results-container">
        <?php
            filter_result_pretty();
            if (isset($_GET["product-category"]) && isset($_GET["order-by"])) { ?>
                <div class="filter-result">
                    <span>Productos filtradas por <b>"<?= $_GET["product-category"] ?>"</b> & <b>"<?= $_GET["order-by"] ?>"</b>.</span>
                    <a href="<?= $_SERVER['REQUEST_URI'] ?>&refresh-products" class="refresh">Restablecer<i class="fa-solid fa-delete-left"></i></a>
                </div>
            <?php }
        ?>
        <div class="results">
            <?php
                while ($products = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                    <a href="">
                        <div class="result">
                            <div class="result-content-1">
                                <div class="img-result">
                                    <img src="data:image/png;base64,<?= $products["product_img"] ?>" alt=""/>
                                </div>
                                <div class="title-category-result">
                                    <div class="title-result">
                                        <span class="title"><b><?= $products["product_name"] ?></b></span>
                                    </div>
                                    <div class="category-result">
                                        <span class="category">Categoria: <b><?= $products["product_category"] ?></b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="result-content-2">
                                <div class="desc-result">
                                    <span class="desc"><?= $products["product_desc"] ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } 
            ?>
        </div>
    </div>
</div>