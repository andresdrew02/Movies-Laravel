<section class="section">
    <form id="movieFiltersForm">
        <div class="container">
            <div class="field has-addons">
                <div class="control">
                    <div class="select">
                        <select name="categoria">
                            <option value="">Elige una categoría</option>
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
                            <option value="">Mas estrellas que...</option>
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
    <script>
        const urlParams = new URLSearchParams(window.location.search)
        const categoria = urlParams.get('categoria')
        const estrellas = urlParams.get('estrellas')
        const q = urlParams.get('q')
        if (categoria !== null){
            document.querySelector('select[name="categoria"]').value = categoria
        }
        if (estrellas !== null){
            document.querySelector('select[name="estrellas"]').value = estrellas
        }
        if (q !== null){
            document.querySelector('input[name="q"]').value = q
        }

        $("#movieFiltersForm").on('submit', (e) => {
            e.preventDefault()
            const data = new FormData(e.target)
            const url = new URL(window.location.href)
            for(const pair of data.entries()){
                if (pair[1] !== ""){
                    url.searchParams.append(pair[0], pair[1])
                }
            }
            if (url.search !== ""){
                window.location.href = url.href
            }
        })
    </script>
</section>
