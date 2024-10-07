$(document).ready(function(){

    //Variables de las secciones de la web
    const home = $(".home");
    const aboutMe = $(".aboutMe");
    const proyects = $(".proyects");
    const contact = $(".contact");

    //Variables de los botones de la barra de navegacion
    let idHome = $("#idHome");
    let idAboutMe = $("#idAboutMe");
    let idProyects = $("#idProyects");
    let idContact = $("#idContact");

    // Variables de las tarjetas de competencias
    let imageBack = [];
    let imageFront = [];
    let imageDataBase = [];
    let imageDevOps = [];
    let imageTesting = [];
    let imageSecurity = [];
    let imageVersionControl = [];
    let imageMethodology = [];

    //Funciones para los botones de la barra de navegacion
    idHome.on("click",function(e){                // funcion para el boton HOME
        e.preventDefault();
        $("html,body").animate({
            scrollTop: home.offset().top},800);
    });

    idAboutMe.on("click",function(e){                   // funcion para el boton Habilidades
        e.preventDefault();
        $("html,body").animate({
            scrollTop: aboutMe.offset().top},800);
    });

    idProyects.on("click",function(e){                       // funcion para el boton Trayectoria
        e.preventDefault();
        $("html,body").animate({
            scrollTop: proyects.offset().top},800);
    });

    idContact.on("click",function (e) {                     // funcion para el boton Proyectos
        e.preventDefault();
        $("html,body").animate({
            scrollTop: contact.offset().top},800);
    });

    //Funcion para mover la barra de navegación al hacer scroll
    $(function (){
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.mainNav').addClass("colorMainScroll").addClass('navRight0').removeClass('navRight20');
            } else {
                $(".mainNav").removeClass("colorMainScroll").addClass('navRight20').removeClass('navRight0');
            }
        });
    });

    // Llamada AJAX para obtener las imágenes del backend
    $.ajax({
        url: '/api/get-technical-skills',
        method: 'GET',
        dataType: 'json',
        success: function(response) {

            // Recibimos la respuesta y actualizamos los arrays con las imágenes dinámicamente
            imageBack = response['Backend'].map(skill => [skill['logo']]);
            imageFront = response['Frontend'].map(skill => [skill['logo']]);
            imageDataBase = response['Bases de Datos'].map(skill => [skill['logo']]);
            imageDevOps = response['DevOps'].map(skill => [skill['logo']]);
            imageTesting = response['Testing'].map(skill => [skill['logo']]);
            imageSecurity = response['Seguridad'].map(skill => [skill['logo']]);
            imageVersionControl = response['Control de Versiones'].map(skill => [skill['logo']]);
            imageMethodology = response['Metodologías'].map(skill => [skill['logo']]);

            // Una vez que las imágenes están cargadas, inicializamos la rotación de imágenes
            rotarImagenes();
            setInterval(rotarImagenes, 2000);  // Indicamos que cada 2 segundos cambie la imagen
        },

        error: function(err) {
            console.error('Error al cargar las imágenes', err);
            console.error('Detalles del error:', err.responseText);
        }
    });

    // Funcion para cambiar la imagen y link
    function rotarImagenes()
    {
        // Verifica si los arrays están llenos antes de proceder
        if (imageBack.length === 0 || imageFront.length === 0 || imageDataBase.length === 0 || imageDevOps.length === 0 || imageTesting.length === 0 || imageSecurity.length === 0 || imageVersionControl.length === 0 || imageMethodology.length === 0 ) {
            return;
        }

        // obtenemos un numero aleatorio entre 0 y la cantidad de imagenes que hay
        const indexBack = Math.floor((Math.random() * imageBack.length));
        const indexFront = Math.floor((Math.random() * imageFront.length));
        const indexDataBase = Math.floor((Math.random() * imageDataBase.length));
        const indexDevOps = Math.floor((Math.random() * imageDevOps.length));
        const indexTesting = Math.floor((Math.random() * imageTesting.length));
        const indexSecurity = Math.floor((Math.random() * imageSecurity.length));
        const indexVersionControl = Math.floor((Math.random() * imageVersionControl.length));
        const indexMethodology = Math.floor((Math.random() * imageMethodology.length));

        // cambiamos la imagen y la url
        document.getElementById("imageBackend").src=imageBack[indexBack][0];
        document.getElementById("imageFrontend").src=imageFront[indexFront][0];
        document.getElementById("imageBasesdeDatos").src=imageDataBase[indexDataBase][0];
        document.getElementById("imageDevOps").src = imageDevOps[indexDevOps][0];
        document.getElementById("imageTesting").src=imageTesting[indexTesting][0];
        document.getElementById("imageSeguridad").src=imageSecurity[indexSecurity][0];
        document.getElementById("imageControldeVersiones").src=imageVersionControl[indexVersionControl][0];
        document.getElementById("imageMetodologías").src=imageMethodology[indexMethodology][0];
    }

    // Función que se ejecuta una vez cargada la página
    onload = function()
    {
        // Cargamos una imagen aleatoria
        rotarImagenes();
        // Indicamos que cada 2 segundos cambie la imagen
        setInterval(rotarImagenes,2000);
    }

    $(document).ready(function () {
        $('#contact-form').on('submit', function (e) {
            e.preventDefault(); // Evitar el envío normal del formulario

            const form = $(this);
            const formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Esto indica que es una solicitud AJAX
                },
                success: function (response) {
                    // Mostrar mensaje de éxito o error
                    if (response.status === 'success') {
                        $('#form-message').html('<p class="success">' + response.message + '</p>');
                        form[0].reset(); // Limpiar el formulario
                        alert(response.message);
                    } else {
                        $('#form-message').html('<p class="error">' + response.message + '</p>');
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr) {
                    $('#form-message').html('<p class="error">Error al enviar el formulario. Inténtalo más tarde.</p>');
                    console.error('Error al enviar el formulario:', xhr.responseText);
                }
            });
        });
    });





});
