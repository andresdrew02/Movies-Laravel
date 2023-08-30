<!--TODO: Hacer funcionar los filtros, crear orden de peliculas y crear el apartado de ver mis comentarios-->
<section class="section">
    <form>
        <div class="container">
            <div class="field has-addons">
                <div class="control">
                    <div class="select">
                        <select name="categoria">
                            @php
                                $categorias = \App\Models\Category::all();
                                foreach ($categorias as $categoria)
                                    {
                                        echo '<option value="' . $categoria->name . '">' . $categoria->name . '</option>';
                                    }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="control">
                    <div class="select">
                        <select name="estrellas">
                            <option value="1">1 estrella</option>
                            <option value="2">2 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" type="text" placeholder="Búsqueda por nombre" name="q">
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary">Filtrar</button>
                </div>
            </div>
        </div>
    </form>
</section>
