<div class="content-stores">
    <div class="filter-container-stores">
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
                            <input type="radio" name="store-category" value="entretenimiento" id="entretenimiento">Entretenimiento
                        </label>
                        <label for="comida">
                            <input type="radio" name="store-category" value="comida" id="comida">Comida
                        </label>
                        <label for="salud">
                            <input type="radio" name="store-category" value="salud" id="salud">Salud
                        </label>
                        <label for="ropas">
                            <input type="radio" name="store-category" value="ropas" id="ropas">Ropas
                        </label>
                        <label for="tecnologia">
                            <input type="radio" name="store-category" value="tecnologia" id="tecnologia">Tecnología
                        </label>
                        <label for="canasta-basica">
                            <input type="radio" name="store-category" value="canasta-basica" id="canasta-basica">Canasta básica
                        </label>
                        <label for="mecanica">
                            <input type="radio" name="store-category" value="mecanica" id="mecanica">Mecánica
                        </label>
                        <label for="ventas-generales">
                            <input type="radio" name="store-category" value="ventas-generales" id="ventas-generales">Ventas generales
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
                            <input type="radio" name="order-by" value="ASC" id="newest">Más nuevo
                        </label>
                        <label for="older">
                            <input type="radio" name="order-by" value="DESC" id="older">Más antiguo
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
            if (isset($_GET["store-category"]) && isset($_GET["order-by"])) { ?>
                <div class="filter-result"><span>Tiendas filtradas por <b>"<?= $_GET["store-category"] ?>"</b> & <b>"<?= $_GET["order-by"] ?>"</b>.</span></div>
            <?php }
        ?>
        <div class="results-stores">
            <?php
                do { ?>
                    <a href="">
                        <div class="result">
                            <div class="result-content-1">
                                <div class="img-result">
                                    <img src="../sources/assets/img/logo-socials.jpg" alt=""/>
                                </div>
                                <div class="title-category-result">
                                    <div class="title-result">
                                        <span class="title"><b>NintaiSquare</b></span>
                                    </div>
                                    <div class="category-result">
                                        <span class="category">Categoria: <b>Tecnología</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="result-content-2">
                                <div class="desc-result">
                                    <span class="desc">Te ayudamos a impulsar tu negocio de forma rápida, sencilla y gratis. Dar a conocer tu negocio nunca fue tan fácil.</span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } while (2>3)
            ?>
        </div>
    </div>
</div>