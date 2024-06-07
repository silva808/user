
//Función para deshabilitar la fecha seleccionada en fecha2 y un día más
    document.getElementById('fecha1').addEventListener('input', function() {
            // Obtener la fecha seleccionada en fecha1
            const fechaSeleccionada = new Date(this.value);
            // Agregar un día a la fecha seleccionada
            fechaSeleccionada.setDate(fechaSeleccionada.getDate() + 1);
            // Formatear la fecha seleccionada con el formato YYYY-MM-DD
            const fechaMinima = fechaSeleccionada.toISOString().split('T')[0];
            // Establecer la fecha mínima en fecha2
            document.getElementById('fecha2').setAttribute('min', fechaMinima);
        });