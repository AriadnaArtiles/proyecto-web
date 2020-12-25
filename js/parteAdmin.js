$(document).ready(function () {
    $("#myInputUsuario").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTableUsuario tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#myInputHistorial").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTableHistorial tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#myInputVuelo").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTableVuelo tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#myInputCarrito").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTableCarrito tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});



function deleteUsuario() {
    var confirmar = confirm("Seguro que quiere borrar este usuario!");
    if (confirmar == true) {
        return true;
    } else {
        return false;
    }
}
function deleteVuelo() {
    var confirmar = confirm("Seguro que quiere borrar este vuelo!");
    if (confirmar == true) {
        return true;
    } else {
        return false;
    }
}
function deleteCarrito() {
    var confirmar = confirm("Seguro que quiere borrar este carrito!");
    if (confirmar == true) {
        return true;
    } else {
        return false;
    }
}
function deleteHistorial() {
    var confirmar = confirm("Seguro que quiere borrar este registro del historial!");
    if (confirmar == true) {
        return true;
    } else {
        return false;
    }
}