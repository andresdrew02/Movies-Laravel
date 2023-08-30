<section class="section">
    <div id="errors" style="margin:.5em">
    </div>
    <div class="container">
        <form action="{{route('comment.store', $movie->slug)}}" method="POST" id="commentForm">
            @csrf
            <div class="field">
                <figure class="image is-64x64" style="margin-bottom:.5em">
                    <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="{{Auth::user()->name}}" class="is-rounded">
                </figure>
                <div class="control">
                    <textarea name="comment" id="comment" rows="4" placeholder="Introduce tu comentario aquí..." style="width:100%; padding:.5em"></textarea>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input type="submit" value="Comentar" class="button is-ghost">
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    $('#commentForm').on('submit', (e) => {
        e.preventDefault()
        //Reseteamos los errors
        $('#errors')[0].innerHTML = ''

        //Se realiza la solicitud, si devuelve un 200 okay se agrega el comentario dinamicamente, si no se actualiza los errores
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
            }
        })
        $.ajax('{{route('comment.store', $movie->slug)}}', {
            method: 'POST',
            data: $('#commentForm').serialize(),
            success: (data) => {
                const comentariosEl = $('#comentarios')[0]
                const fecha = new Date(data.created_at)
                comentariosEl.innerHTML += `
                 <div class="box" id="dynamicComment${data.id}">
                    <article class="media">
                        <figure class="media-left">
                            <figure class="image is-64x64">
                                <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="{{Auth::user()->name}}" class="is-rounded">
                            </figure>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{{Auth::user()->name}}</strong>
                                    <br>
                                        ${data.comment}
                <br>
                <small>Publicado el ${fecha.getDate().toString().length === 1 ? "0" + fecha.getDate() : fecha.getDate()}/${fecha.getMonth().toString().length === 1 ? "0"+fecha.getMonth() : fecha.getMonth()}/${fecha.getFullYear()}</small>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
                `
                const addedElement = $(`#dynamicComment${data.id}`)[0]
                addedElement.scrollIntoView({
                    behavior: 'smooth'
                })
            },
            error: (data) => {
                const errorsEl = $('#errors')[0]
                const errors = data.responseJSON
                errorsEl.innerHTML += '<ul>'
                for (const [key,value] of Object.entries(errors)){
                    value.forEach((e) => {
                        errorsEl.innerHTML += `<li>${key}: ${e}`
                    })
                }
                errorsEl.innerHTML += '</ul>'
                errorsEl.scrollIntoView({
                    behavior: 'smooth'
                })
            }
        })
    })
</script>
