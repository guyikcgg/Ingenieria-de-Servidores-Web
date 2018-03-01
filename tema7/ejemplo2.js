function NuevaVentana() {
    var ventana = open('','','status=yes, widtch=400, height=250, menubr=yes');
    ventana.document.write("Estoy escribiendo en la nueva ventana<br>");
}

function Confirmar() {
    var respuesta = confirm("Presione uno de los dos botones");
    if (respuesta) {
        alert("Presionó aceptar");
    } else {
        alert("Presionó cancelar");
    }
}

function changeBackgroundCol(col = '#f0ffc0') {
    document.body.style.backgroundColor = col;
}

function Alert() {
    alert("Esto es una alerta!!");
}

function Prompt() {
    prompt("Introduzca un valor:");
}
