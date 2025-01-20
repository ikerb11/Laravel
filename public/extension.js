var idModificada;

async function cargarDatos() {

    var url = "ws/getUsuario.php";
    var data = {  };
    
    fetch(url, {
        method: "POST", // or 'PUT'
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function(response){
            generarTabla(response.data);
        });
}

function generarTabla(datos) {
    const tablaContenedor = document.getElementById("tabla");
    let tablaHTML = `
        <table border="1px">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>`;

    datos.forEach(persona => {
        tablaHTML += `
            <tr data-id="${persona.id}">
                <td>${persona.nombre}</td>
                <td>${persona.apellidos}</td>
                <td>${persona.telefono}</td>
                <td>${persona.email}</td>
                <td>${persona.sexo}</td>
                <td><button onclick="eliminarFila(${persona.id})">X</button></td>
                <td><button onclick="editarFila(${persona.id})">Editar</button></td>
            </tr>`;
    });

    tablaHTML += `
            </tbody>
        </table>`;

    tablaContenedor.innerHTML = tablaHTML;
}

async function eliminarFila(id) {
  var url = "ws/deleteUsuario.php";
  var data = { id: id };

  Swal.fire({
      title: '¿Estás seguro?',
      text: `Estás a punto de eliminar el usuario: ${id}`,
      icon: 'error',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          console.log(`Eliminando usuario: ${id}`);
          fetch(url, {
              method: "POST",
              body: JSON.stringify(data),
              headers: {
                  "Content-Type": "application/json",
              },
          })
              .then((res) => res.json())
              .then((response) => {
                  generarTabla(response.data);
                  Swal.fire('¡Eliminado!', 'El usuario ha sido eliminado.', 'success');
              })
      }
  });
}

async function editarFila(id) {
    idModificada = id;
    try {
        var url = "ws/getUsuario.php";
        var data = { id:id };

        fetch(url, {
            method: "POST", // or 'PUT'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers: {
              "Content-Type": "application/json",
            },
          })
            .then((res) => res.json())
            .catch((error) => console.error("Error:", error))
            .then(function(response){
                const user = response.data[0];

                // Asigna los valores a los campos del formulario
                document.getElementById("nombre").value = user.nombre|| "";
                document.getElementById("apellidos").value = user.apellidos|| "";
                document.getElementById("telefono").value = user.telefono || "";
                document.getElementById("email").value = user.email || "";
                document.getElementById("fecha").value = user.fecha_nacimiento || "";
                document.getElementById(user.sexo === "masculino" ? "masculino" : "femenino").checked = true;
        
                document.getElementById("formularioEdicion").style.display = "block";
            });


    } catch (error) {
        console.error("Error al cargar los datos de la persona:", error);
    }
}

async function guardarDatos() {
  const datosUsuario = {
      id: idModificada,
      nombre: document.getElementById("nombre").value,
      apellidos: document.getElementById("apellidos").value,
      telefono: document.getElementById("telefono").value,
      email: document.getElementById("email").value,
      sexo: document.querySelector("input[name='sexo']:checked").value,
      fecha_nacimiento: document.getElementById("fecha").value,
  };

  var url = "ws/modificarUsuario.php";
  var data = datosUsuario;

  Swal.fire({
      title: '¿Estás seguro?',
      text: `Estás a punto de cambiar el usuario: ${datosUsuario.id}`,
      icon: 'error',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, editar',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          console.log(`Editando usuario: ${datosUsuario.id}`);
          fetch(url, {
              method: "POST",
              body: JSON.stringify(data),
              headers: {
                  "Content-Type": "application/json",
              },
          })
              .then((res) => res.json())
              .then((response) => {
                  location.reload();
                  Swal.fire('¡Exito!', 'El usuario ha sido editado.', 'success');
              })
              .catch((error) => {
                  console.error("Error:", error);
                  Swal.fire('Error', 'Hubo un problema al editar el usuario.', 'error');
              });
      }
  });
}
async function crearUsuario() {
    const datosUsuario = {
        nombre: document.getElementById("nombre").value,
        apellidos: document.getElementById("apellidos").value,
        contrasena: document.getElementById("contrasena").value,
        telefono: document.getElementById("telefono").value,
        email: document.getElementById("email").value,
        sexo: document.querySelector("input[name='sexo']:checked").value,
        fecha_nacimiento: document.getElementById("fecha").value,
    };

    var url = "ws/crearUsuario2.php";
    var data = datosUsuario;

    Swal.fire({
        title: '¿Estás seguro?',
        text: `Estás a punto de crear un nuevo usuario`,
        icon: 'warning', // Cambiado a 'warning' para mayor coherencia
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Crear',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(`Creando usuario: ${datosUsuario.nombre}`);
            fetch(url, {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((res) => res.json())
                .then((response) => {
                    // Mostrar mensaje de éxito solo si la creación fue exitosa
                    Swal.fire('¡Creado!', 'El usuario ha sido creado.', 'success');
                    console.log(response);
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire('Error', 'Hubo un problema al crear el usuario.', 'error');
                });
        }
    });
}
 // Carga inicial de la tabla.