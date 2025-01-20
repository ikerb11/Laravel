import Swal from 'sweetalert2';

export function editarUsuarios(usuario) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `Estás a punto de editar el usuario: ${usuario.nombre}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, editar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llama aquí a la función real de editar usuario.
            console.log(`Editando usuario: ${usuario.id}`);
            Swal.fire('¡Editado!', 'El usuario ha sido editado.', 'success');
        }
    });
}

export function crearUsuarios(usuario) {
    Swal.fire({
        title: 'Crear nuevo usuario',
        text: `Estás a punto de crear un nuevo usuario: ${usuario.nombre}`,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Crear',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llama aquí a la función real de crear usuario.
            console.log(`Creando usuario: ${usuario.nombre}`);
            Swal.fire('¡Creado!', 'El usuario ha sido creado con éxito.', 'success');
        }
    });
}

export function eliminarUsuarios(usuario) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `Estás a punto de eliminar el usuario: ${usuario.nombre}`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llama aquí a la función real de eliminar usuario.
            console.log(`Eliminando usuario: ${usuario.id}`);
            Swal.fire('¡Eliminado!', 'El usuario ha sido eliminado.', 'success');
        }
    });
}
