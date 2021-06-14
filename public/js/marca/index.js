

let formulario = document.getElementById("form");
let btnCerrar = document.getElementById("mCerrar");
let btnAgregar = document.getElementById("btnAgregar");
let operacion = document.getElementById("operacion");
let chkEstado = document.getElementById('chkEstado');

let Id = document.getElementById("ID");
let Nombre = document.getElementById("nombre");
let Descripcion = document.getElementById("descripcion");
let tabla = document.getElementById('tbCategoria');
let chkEstadoOption = document.getElementById('chkEstadoOption');

function limpiar() {
  Id.value = 0;
  Nombre.value = '';
}
btnAgregar.addEventListener("click", () => {
  operacion.innerHTML = "Agregar";
})
tabla.addEventListener("click", (e) => {
  let row;
  if (e.target.classList.contains('btn-info')) {
    row = e.target.parentNode.parentNode;
    operacion.innerHTML = "Editar"
    mostrarFormulario(row);
  } else if (e.target.classList.contains('fa-pencil')) {
    row = e.target.parentNode.parentNode.parentNode;
    mostrarFormulario(row);
    operacion.innerHTML = "Editar"
  }
  let id;
  if (e.target.classList.contains('btn-danger')) {
    id = e.target.dataset.id;
    peticionEliminar(id);
  } else if (e.target.classList.contains('fa-trash')) {
    id = e.target.parentNode.dataset.id;
    peticionEliminar(id);
  }
  e.preventDefault();
})

const URLWEB = "http://ventasmvc.com/";

function mostrarFormulario(row) {
  Id.value = row.querySelectorAll('td')[0].textContent;
  Nombre.value = row.querySelectorAll('td')[1].textContent;
  Descripcion.value = row.querySelectorAll('td')[2].textContent;
}
function getAll() {
  var url = URLWEB + 'marca';
  var formData = new FormData();
  formData.append('Estado', true);
  tabla.innerHTML = '';
  fetch(url, {
    method: 'POST', // or 'PUT'
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      data.forEach(element => {
        tabla.insertAdjacentHTML('beforeend', itemMarca(element))
      })
    })
    .catch(err => console.log(err))
}

function peticionEliminar(id) {
  var url = URLWEB + 'marca/delete';
  var formData = new FormData();
  formData.append('id', id);
  tabla.innerHTML = '';
  fetch(url, {
    method: 'POST',
    mode: 'cors',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      getAll();
    })
    .catch(err => console.log(err))
}

function itemMarca(element) {

  item = `<tr>
            <td>${element.IdMarca} </td>
            <td>${element.Nombre}</td>
            <td>${element.Descripcion}</td>
          <td>
           <a class="btn btn-info" title="Editar" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-pencil"></i></a>
          <a class="btn btn-danger" data-id="${element.IdMarca}" title="Editar" href="" title="Eliminar"><i class="fa fa-trash"></i></a>
          </td >
      </tr>`;
  return item;
}

formulario.addEventListener("submit", function name(ev) {
  ev.preventDefault();
  save();
})

function save() {
  var url = URLWEB + 'marca/save';
  var formdat = new FormData(formulario);
  fetch(url, {
    method: 'POST',
    mode: 'cors',
    body: formdat
  })
    .then(response => response.json())
    .then(data => {
      getAll();
      btnCerrar.click();
      limpiar();
    })
    .catch(err => console.log(err))
}


