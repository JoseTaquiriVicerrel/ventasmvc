
let inputFile = document.getElementById('inputFile1');
let formulario = document.getElementById("form");
let btnCerrar = document.getElementById("mCerrar");
let chkEstado = document.getElementById('chkEstado');

let idCategoria = document.getElementById("ID");
let Nombre = document.getElementById("nombre");
let Descripcion = document.getElementById("descripcion");
let tabla = document.getElementById('tbCategoria');
let image = document.getElementById('img1');
let chkEstadoOption = document.getElementById('chkEstadoOption');

chkEstado.addEventListener('change', () => {
  peticionEstado();
})
tabla.addEventListener("click", (e) => {
  let row;
  if (e.target.classList.contains('btn-info')) {
    row = e.target.parentNode.parentNode;
    mostrarFormulario(row);
  } else if (e.target.classList.contains('fa-pencil')) {
    row = e.target.parentNode.parentNode.parentNode;
    mostrarFormulario(row);
    
  }
  let id;
  if (e.target.classList.contains('btn-danger')) {
    id = e.target.dataset.id;
    peticionEliminar(id);
  } else if (e.target.classList.contains('fa-trash')) {
    id = e.target.parentNode.dataset.id;
    peticionEliminar(id);
  }
  console.log(id);
  e.preventDefault();
})

const URLWEB = "http://ventasmvc.com/";

function mostrarFormulario(row) {
  idCategoria.value = row.querySelectorAll('td')[0].textContent;
  Nombre.value = row.querySelectorAll('td')[1].textContent;
  Descripcion.value = row.querySelectorAll('td')[2].textContent;
  chkEstadoOption.checked = chkEstado.checked;
}

function name(params) {

}

function peticionEstado() {
  var url = URLWEB + 'categoria';
  var formData = new FormData();
  formData.append('Estado', chkEstado.checked);
  tabla.innerHTML = '';
  fetch(url, {
    method: 'POST', // or 'PUT'
    mode: 'cors',
    body: formData// data can be `string` or {object}!
  })
    .then(response => response.json())
    .then(data => {
      console.log(data)
      data.forEach(element => {
        tabla.insertAdjacentHTML('beforeend', itemCategoria(element))
      })
    })
    .catch(err => console.log(err))
}
function peticionEliminar(id) {
  var url = URLWEB + 'categoria/delete';
  var formData = new FormData();
  formData.append('id', id);
  //tabla.innerHTML = '';
  fetch(url, {
    method: 'POST', // or 'PUT'
    mode: 'cors',
    body: formData// data can be `string` or {object}!
  })
    .then(response => response.json())
    .then(data => {
      peticionEstado();
    })
    .catch(err => console.log(err))
}

function peticionActivar(operation, ID) {
  var url = `http://tienda.test/categoria/${operation}/${ID}`;

  fetch(url, {
    method: 'GET',
    mode: 'cors',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      Swal.fire({
        text: 'El proveedor ha sido dado de ' + operation,
        icon: 'success'
      })
      peticionEstado();
    })
    .catch(err => console.log(err))
}

function dialogoBaja(item) {
  Swal.fire({
    title: 'Estas segur@?',
    text: "Se va desactivar esta categoria!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, dar de baja',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      peticionActivar('baja', item.dataset.id)
    }
  })
}

function dialogoAlta(item) {
  Swal.fire({
    title: 'Estas segur@?',
    text: "Se va activar esta Categoria!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      peticionActivar('alta', item.dataset.id)
    }
  })
}



function itemCategoria(element) {
  let estado = chkEstado.checked;
  item = `<tr>
            <td>${element.IdCateg} </td>
            <td>${element.Nombre}</td>
            <td>${element.Descripcion}</td>
          <td>
          ${estado == true ? `<a class="btn btn-info" title="Editar" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-pencil"></i></a>` : ''}
          ${estado == false ? `<a class="btn btn-success" title="Dara Alta" ><i class="fa fa-arrow-up"></i></a>` : ''}
          <a class="btn btn-danger" data-id="${element.IdCateg}" title="Editar" href="" title="Eliminar"><i class="fa fa-trash"></i></a>
          </td >
      </tr>`;
  return item;
}

formulario.addEventListener("submit", function name(ev) {
  ev.preventDefault();
  save();
})

function save() {
  var url = 'http://ventasmvc.com/categoria/save';
  var formdat = new FormData(formulario);
  console.log(formdat.getAll('nombre'));
  fetch(url, {
    method: 'POST', // or 'PUT'
    mode: 'cors',
    body: formdat // data can be `string` or {object}!
  })
    .then(response => response.json())
    .then(data => {
      peticionEstado();
      btnCerrar.click();
    })
    .catch(err => console.log(err))
}



// function init() {
//   inputFile.addEventListener('change', mostrarImagen, false);
//   let label = document.querySelector('.overlay');
//   label.addEventListener('click', abrirInputFile, false);
// }

// function abrirInputFile(event) {
//   inputFile.click();
// }

// function mostrarImagen(event) {
//   var file = event.target.files[0];
//   var reader = new FileReader();
//   reader.onload = function (event) {
//     var img = document.getElementById('img1');
//     img.src = event.target.result;
//   }
//   reader.readAsDataURL(file);
// }

// window.addEventListener('load', init, false);