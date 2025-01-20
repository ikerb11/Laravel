window.onload = function() {
    const ContenedorNavbar = document.getElementById('navbar');
    
    fetch('nav.html')
        .then(response => {return response.text();})
        .then(data => {
            ContenedorNavbar.innerHTML = data;
            //Recojer el archivo sin la ruta completa
            const archivo = window.location.pathname.split("/").pop();
            //Seleccionar todas las opciones
            const ListaLinks = ContenedorNavbar.querySelectorAll('a');
            //Comparar cada enlace con la ruta actual
            ListaLinks.forEach(link => {
                console.log(archivo);
                console.log(link.getAttribute('href'));
                if (link.getAttribute('href') === archivo) {
                    link.classList.add('actual');
                }
            });
        })
        .catch(error => {
            console.error('Error al cargar el nav:', error);
        });
};