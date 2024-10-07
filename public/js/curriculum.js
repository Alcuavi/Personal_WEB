document.addEventListener('DOMContentLoaded', function() {
    var experienceItems = document.querySelectorAll('.experience-item');

    experienceItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var description = this.querySelector('.experience-description');
            var chevron = this.querySelector('.fa-chevron-right');

            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
                item.classList.add('open');
            } else {
                description.style.display = 'none';
                item.classList.remove('open');
            }
        });
    });
/*
    $(document).ready(function() {
        $('#generate-pdf-btn').click(function() {
            console.log("Botón clicado");
            let generatePdfUrl = '{{ path("generate_pdf_script") }}'; // Verifica la URL generada
            console.log("URL para generar PDF:", generatePdfUrl);
            $.ajax({
                url: generatePdfUrl,
                method: 'GET',
                success: function(response) {
                    console.log("Respuesta del servidor:", response);
                    alert('PDF generado exitosamente.');
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud:", error);
                    console.log("Detalles del error: ", xhr.responseText);
                    alert('Hubo un error al generar el PDF. Detalles: ' + xhr.responseText);
                }
            });
        });
    });

 */

    $(document).ready(function() {
        $('.skill-item i').click(function() {
            $(this).siblings('.skill-description').toggleClass('hidden visible');
        });
    });



});
