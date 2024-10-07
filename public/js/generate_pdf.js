const puppeteer = require('puppeteer');

(async () => {
    try {
        console.log('Iniciando Puppeteer...');
        const browser = await puppeteer.launch();
        console.log('Navegador lanzado...');

        const page = await browser.newPage();
        console.log('Nueva página creada...');

        await page.goto('http://localhost:8000/curriculum', { waitUntil: 'networkidle0' });
        console.log('Página cargada...');

        // Generar el PDF y guardarlo en la ubicación especificada
        await page.pdf({
            path: 'C:/Users/ADMIN/Desktop/Proyectos/WebPersonalPHP/PersonalWebsite/public/pdf/ALBERTO_CUADRADO_(Full_Stack_Developer).pdf',
            format: 'A4'
        });

        console.log('PDF generado y guardado con éxito.');

        await browser.close();
        console.log('Navegador cerrado...');
    } catch (error) {
        console.error('Error al generar el PDF:', error);
    }
})();
