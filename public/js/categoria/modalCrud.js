$(document).ready(function () {
  $.ajaxSetup({ cache: false });

  $('a[is-modal]').on('click', function (e) {
    $('#modalGenerico').modal({  keyboard: true }, 'show');
    $('#content-modal').load(this.href, function () {
      console.log(this.href);
      crud();
    });
    return false;
    // alert('holaf')

    // console.log(e);
  });
  $('#modalGenerico').on('hidden.bs.modal', function () {
    $('#content-modal').html('');
  });
})


function crud() {
  const form = document.getElementById('form');
  console.log('holaf')
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const action = myform.getAttribute('action');
    const data = new FormData(form);
    console.log(action);
    console.log(data.getAll('nombre'));

    fetch(action, { method: 'POST', body: data })
      .then(response => {
        return response.json()
      })
      .then(data => {
        console.log(data);
        switch (response.success) {
          case 1:
            alert('Hola mundo');
            Location.href = response.redirecion;
            break;
          case 0:
            alert('Hola mundo');
            
            break;
          case -1:
            alert('Hola mundo');
            renderError(response.data, 'Errores');
            break;
          default:
            break;
        }
      })
  })
}

function render(error,id_item) {
  function renderError(errors, id_item) {
    let err = Object.values(errors);
    let lista = "<ul class='text text-error'>";
    for (let i = 0; i < err.length; i++) {
      lista += "<li> * " + err[i] + "</li>";
    }
    lista += "</ul>";
    document.getElementById(id_item).innerHTML = lista;
  }

}