<section class="section">
    <div id="errors" style="margin-bottom:1em">
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
    $('body').on('submit', (e) => {
        if (e.target.id === "commentForm"){
            e.preventDefault()
            $('input[type=submit]').prop('disabled', true)
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
                <div class="box" id="${data.id}">
                    <article class="media" style="display:flex; justify-content: space-between; align-items: center">
                       <div style="margin-left:2em">
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
                       </div>
                       <button class="button is-ghost" onmousedown="deleteComment(${data.id})" title="Borrar comentario">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" id="trashButton"><style>#trashButton{fill:#d20010}</style><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                       </button>
                </article>
                `
                    const addedElement = $(`#${data.id}`)[0]
                    addedElement.scrollIntoView({
                        behavior: 'smooth'
                    })
                    $('input[type=submit]').prop('disabled', false)
                },
                error: (data) => {
                    $('input[type=submit]').prop('disabled', false)
                    const errorsEl = $('#errors')[0]
                    const errors = data.responseJSON
                    errorsEl.innerHTML += '<ul>'
                    for (const [key,value] of Object.entries(errors)){
                        if (Array.isArray(value)){
                            value.forEach((e) => {
                                errorsEl.innerHTML += `<li>${key}: ${e}`
                            })
                        }else{
                            errorsEl.innerHTML += `<li>${key}: ${value}`
                        }
                    }
                    errorsEl.innerHTML += '</ul>'
                    errorsEl.scrollIntoView({
                        behavior: 'smooth'
                    })
                }
            })
        }
    })
</script>
