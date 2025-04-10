// Validacion de fórmulario
document.getElementById("myForm").addEventListener("submit", function(event) {
    if ( //Validacion de campos requeridos y max caracteres
        isFieldEmpty($('#descripcion').val(), 'Descripcion') ||
        isExceedingLength($('#descripcion').val(), 'Descripcion', 200)) {
        event.preventDefault(); // Evita el envío del formulario
        return; // Detener la ejecución aquí
    }
});