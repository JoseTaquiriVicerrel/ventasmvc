

let formulario = document.getElementById("form");
let btnCerrar = document.getElementById("mCerrar");
let btnAgregar = document.getElementById("btnAgregar");
let operacion = document.getElementById("operacion");
let chkEstado = document.getElementById('chkEstado');

let idCategoria = document.getElementById("ID");
let Nombre = document.getElementById("nombre");
let Apellidos = document.getElementById("apellidos");
let Direccion = document.getElementById("direccion");
let Telefono = document.getElementById("telefono");
let CreditoLim = document.getElementById("limitcredito");
let Ruc = document.getElementById("ruc");
let tabla = document.getElementById('tbCategoria');
let chkEstadoOption = document.getElementById('chkEstadoOption');

function limpiar() {
  idCategoria.value = 0;
  Nombre.value = '';
  Apellidos.value = '';
  Direccion.value = ''
  Telefono.value = ''
  CreditoLim.value = 0;

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
  let name;
  if (e.target.classList.contains('btn-danger')) {
    id = e.target.dataset.id;
    name = e.target.dataset.name;
    eliminar(id, name);
  } else if (e.target.classList.contains('fa-trash')) {
    id = e.target.parentNode.dataset.id;
    name = e.target.parentNode.dataset.name;
    eliminar(id, name);
  }
  e.preventDefault();
})
function eliminar(ID, name) {
  Swal.fire({
    title: 'Desea eliminar el cliente: ' + name + '?',
    showDenyButton: true,
    confirmButtonText: `Aceptar`,
    denyButtonText: `Cancelar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      peticionEliminar(ID);
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 750
      })
    }
  })
}

const URLWEB = "http://ventasmvc.com/";

function mostrarFormulario(row) {
  idCategoria.value = row.querySelectorAll('td')[0].textContent;
  Nombre.value = row.querySelectorAll('td')[1].textContent;
}
function getAll() {
  var url = URLWEB + 'cliente';
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
        tabla.insertAdjacentHTML('beforeend', itemcliente(element))
      })
    })
    .catch(err => console.log(err))
}

function peticionEliminar(id) {

  var url = URLWEB + 'cliente/delete';
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
      console.log(data)
      getAll();
    })
    .catch(err => console.log(err))
}

function itemcliente(element) {

  item = `<tr>
            <td>${element.IdCliente} </td>
            <td>${element.Nombres}</td>
            <td>${element.Apellidos}</td>
            <td>${element.Direccion}</td>
          <td>
           <a class="btn btn-info" title="Editar" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-pencil"></i></a>
          <a class="btn btn-danger" data-id="${element.Idcliente}" data-name="${element.Nombres} ${element.Apellidos}" title="Eliminar"><i class="fa fa-trash"></i></a>
          </td >
      </tr>`;
  return item;
}

formulario.addEventListener("submit", function name(ev) {
  ev.preventDefault();
  save();
})

function save() {
  var url = URLWEB + 'cliente/save';
  var formdat = new FormData(formulario);
  fetch(url, {
    method: 'POST',
    mode: 'cors',
    body: formdat
  })
    .then(response => response.json())
    .then(data => {
      console.log(data)
      getAll();
      btnCerrar.click();
      limpiar();
    })
    .catch(err => console.log(err))
}


