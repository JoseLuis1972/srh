// Validacion de fórmulario
document.getElementById("myForm").addEventListener("submit", function(event) {
    if ( //Validacion de campos requeridos y max caracteres
        isFieldEmpty($('#id_alineacion_pnd').val(), 'id_alineacion_pnd') ||
        isFieldEmpty($('#desc_um_medicina').val(), 'desc_um_medicina') ||
        isFieldEmpty($('#obj_contribucion').val(), 'obj_contribucion') ||
        isFieldEmpty($('#satisfactorio').val(), 'satisfactorio') ||
        isFieldEmpty($('#no_satisfactorio').val(), 'no_satisfactorio') ||
        isFieldEmpty($('#no_aprobatorio').val(), 'no_aprobatorio') ||
        isFieldEmpty($('#peso_ind').val(), 'peso_ind') ||
        isFieldEmpty($('#estatus').val(), 'estatus') ||
        isFieldEmpty($('#id_val_parametro').val(), 'id_val_parametro') ||
        isFieldEmpty($('#ponderacion').val(), 'ponderacion') ||
        isFieldEmpty($('#unidad_medica').val(), 'unidad_medica') ||
        isFieldEmpty($('#calificacion').val(), 'calificacion') ||
        isExceedingLength($('#id_alineacion_pnd').val(), 'id_alineacion_pnd', 200) ||
        isExceedingLength($('#desc_um_medicina').val(), 'desc_um_medicina', 200) ||
        isExceedingLength($('#obj_contribucion').val(), 'obj_contribucion', 200) ||
        isExceedingLength($('#satisfactorio').val(), 'satisfactorio', 200) ||
        isExceedingLength($('#no_satisfactorio').val(), 'no_satisfactorio', 200) ||
        isExceedingLength($('#no_aprobatorio').val(), 'no_aprobatorio', 200) ||
        isExceedingLength($('#peso_ind').val(), 'peso_ind', 200) ||
        isExceedingLength($('#estatus').val(), 'estatus', 200) ||
        isExceedingLength($('#id_val_parametro').val(), 'id_val_parametro', 200) ||
        isExceedingLength($('#unidad_medica').val(), 'unidad_medica', 200) ||
        isExceedingLength($('#calificacion').val(), 'calificacion', 200)) {
        event.preventDefault(); // Evita el envío del formulario
        return; // Detener la ejecución aquí
    }
});
