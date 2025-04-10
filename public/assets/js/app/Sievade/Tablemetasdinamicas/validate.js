// Validacion de fórmulario
document.getElementById("myForm").addEventListener("submit", function(event) {
    if ( //Validacion de campos requeridos y max caracteres
        isFieldEmpty($('#alineacion_pnd').val(), 'alineacion_pnd') ||
        isFieldEmpty($('#desc_um_medicina').val(), 'desc_um_medicina') ||
        isFieldEmpty($('#obj_contribucion').val(), 'obj_contribucion') ||
        isFieldEmpty($('#satisfactorio').val(), 'satisfactorio') ||
        isFieldEmpty($('#no_satisfactorio').val(), 'no_satisfactorio') ||
        isFieldEmpty($('#no_aprobatorio').val(), 'no_aprobatorio') ||
        isFieldEmpty($('#peso_ind').val(), 'peso_ind') ||
        isFieldEmpty($('#dependencia').val(), 'dependencia') ||
        isFieldEmpty($('#ur').val(), 'ur') ||
        isFieldEmpty($('#estaus').val(), 'estaus') ||
        isFieldEmpty($('#area_responsable').val(), 'area_responsable') ||
        isFieldEmpty($('#ponderacion').val(), 'ponderacion') ||
        isFieldEmpty($('#unidad_medica').val(), 'unidad_medica') ||
        isFieldEmpty($('#calificacion').val(), 'calificacion') ||
        isExceedingLength($('#alineacion_pnd').val(), 'alineacion_pnd', 200) ||
        isExceedingLength($('#desc_um_medicina').val(), 'desc_um_medicina', 200) ||
        isExceedingLength($('#obj_contribucion').val(), 'obj_contribucion', 200) ||
        isExceedingLength($('#satisfactorio').val(), 'satisfactorio', 200) ||
        isExceedingLength($('#no_satisfactorio').val(), 'no_satisfactorio', 200) ||
        isExceedingLength($('#no_aprobatorio').val(), 'no_aprobatorio', 200) ||
        isExceedingLength($('#peso_ind').val(), 'peso_ind', 200) ||
        isExceedingLength($('#dependencia').val(), 'dependencia', 200) ||
        isExceedingLength($('#ur').val(), 'ur', 200) ||
        isExceedingLength($('#estatus').val(), 'estatus', 200) ||
        isExceedingLength($('#area_responsable').val(), 'area_responsable', 200) ||
        isExceedingLength($('#ponderacion').val(), 'ponderacion', 200) ||
        isExceedingLength($('#unidad_medica').val(), 'unidad_medica', 200) ||
        isExceedingLength($('#calificacion').val(), 'calificacion', 200)) {
        event.preventDefault(); // Evita el envío del formulario
        return; // Detener la ejecución aquí
    }
});