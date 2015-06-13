var paperkit = new Paperkit();
paperkit.init();

var currentTab = "parkour";

window.addEventListener("load", function() {
    addInputsClickListener();
});

function movementListHandler(tile) {
    var last = tile.parentNode.querySelector("md-tile.open");
    if (last) {
        last.classList.remove('open');
        last.style.borderLeft = "";
    }
    tile.classList.add('open');
    tile.style.borderLeft = "8px black solid";
    var uri = "movimientos/movement/" + tile.getAttribute("data-id");
    ajaxCall("GET", uri, false, true, function(response) {
        var container = tile.parentNode.parentNode.parentNode.querySelector(".movement-form");
        var form = response.target.responseText;
        container.innerHTML = form;
        paperkit.initElement(container);
        addInputsClickListener();
    });
}

function ajaxCall(method, uri, parameters, async, callback, csrf) {
    method = method || "GET";
    async = async || true;

    var xhr = new XMLHttpRequest();
    xhr.open(method, uri, async);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    if (typeof parameters == 'FormData') {
        xhr.setRequestHeader("Content-type", "multipart/form-data");
    } else if (typeof parameters == 'string') {
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    } else {}
    if (csrf) {
        xhr.setRequestHeader("X-CSRF-TOKEN", csrf);
    }

    xhr.addEventListener("load", function(event) {
        callback(event, callback);
    });

    xhr.send(parameters);
}

var help = {
    generic: function(what) {
        console.log("This will show help with this text: " + what);
        alert(what);
    },
    slug: function() {
        help.generic("El identificador del movimiento, NO puede contener espacios, mayúsculas ni tildes, las palabras se separan por guiones. Por ejemplo: \"doble-backflip\".");
    },
    category: function() {
        help.generic("Elije la categoría que corresponda para este movimiento");
    },
    name: function() {
        help.generic("El nombre del movimiento, puede contener espacios, mayúsculas y tildes. Por ejemplo: \"Doble backflip\".");
    },
    name_variants: function() {
        help.generic("Las variantes del nombre separadas por comas (no dejes espacio detrás de la coma). Por ejemplo: \"Primera variación,Variante segunda,Tercer sinónimo\".");
    },
    equals: function() {
        help.generic("Los movimientos equivalentes de otras disciplinas (por ejemplo, el backflip aparece en street stunts y en tricking)");
    },
    tags: function() {
        help.generic("Las etiquetas separadas por comas. Por ejemplo: \"Carpado,Plancha\". Consulta la guía para completarlo correctamente.");
    },
    history: function() {
        help.generic("La historia del movimiento. Consulta la guía para completarlo correctamente.");
    },
    technique_description_text: function() {
        help.generic("La breve explicación técnica que también servirá de guión para el vídeo explicativo (además de mostrarse en formato texto). Consulta la guía para completarlo correctamente.");
    },
    steps: function() {
        help.generic("Los pasos del movimiento. Consulta la guía para completarlo correctamente.");
    },
    advice: function() {
        help.generic("Los consejos y errores comunes de este movimiento. Consulta la guía para completarlo correctamente.");
    },
    progressions: function() {
        help.generic("Las progresiones para el correcto aprendizaje del movimiento. Consulta la guía para completarlo correctamente.");
    },
    requirements: function() {
        help.generic("Los requisitos para aprender el movimiento. Consulta la guía para completarlo correctamente.");
    },
    derived_from: function() {
        help.generic("El movimiento o movimientos de los cuales deriva este movimiento. Consulta la guía para completarlo correctamente.");
    },
    variations: function() {
        help.generic("Las variaciones del movimiento. Consulta la guía para completarlo correctamente.");
    },
}

function saveMovement() {
    var page = document.querySelector(".page." + currentTab);
    var form = page.querySelector("form.movement");
    var data = new FormData(form);
    var id = form.getAttribute("data-id");
    var csrf = form.getAttribute("data-csrf");


    page.querySelector(".movements-list md-tile.open md-text").textContent = page.querySelector('md-input[name="name"]').getAttribute("value");

    var uri = "movimientos/save-movement/" + id;

    data.append("equals", form.querySelector('md-input[name="equals"]').getAttribute("data-value"));

    data.append("requirements", form.querySelector('md-input[name="requirements"]').getAttribute("data-value"));

    data.append("derived_from", form.querySelector('md-input[name="derived_from"]').getAttribute("data-value"));

    data.append("variations", form.querySelector('md-input[name="variations"]').getAttribute("data-value"));

    /*
    var tagInputs = form.querySelectorAll(".input-tags");
    for (var i = tagInputs.length - 1; i >= 0; i--) {
        data.append(tagInputs[i].id, getTagValues(tagInputs[i]));
    }
    var checkboxInputs = form.querySelectorAll(".input-checkbox");
    for (var i = checkboxInputs.length - 1; i >= 0; i--) {
        data.append(checkboxInputs[i].getAttribute("name"), checkboxInputs[i].getSelectedValues());
    }
    var switchInputs = form.querySelectorAll(".input-switch");
    for (var i = switchInputs.length - 1; i >= 0; i--) {
        data.append(switchInputs[i].getAttribute("name"), switchInputs[i].getAttribute("value") === "on" ? "on" : "off");
    }
    var listInputs = form.querySelectorAll(".input-list");
    for (var i = listInputs.length - 1; i >= 0; i--) {
        data.append(listInputs[i].getAttribute("name"), listInputs[i].getAttribute("value"));
    }
    var colorInputs = form.querySelectorAll(".input-color");
    for (var i = colorInputs.length - 1; i >= 0; i--) {
        data.append(colorInputs[i].getAttribute("name"), colorInputs[i].getAttribute("value"));
    }
    */

    ajaxCall("POST", uri, data, true, function(response) {}, csrf);

    var snackbar = document.getElementById("snackbar");
    snackbar.textContent = "Movimiento guardado";
    snackbar.animate();
}

function tabHandler(el, n) {
    if (n === 0) {
        currentTab = "parkour";
    } else if (n === 1) {
        currentTab = "streetstunts";
    } else if (n === 2) {
        currentTab = "tricking";
    }
}

// FORM

// Listener attacher
function addInputsClickListener() {
    [].forEach.call(
        document.querySelectorAll('.input-movement'),
        function(input) {
            input.addEventListener("click", inputMovementClick);
        });
}

// Clicks
function inputMovementClick(event) {
    var input = event.currentTarget;
    var currentInput = document.querySelector(".current-input");
    if (currentInput) {
        currentInput.classList.remove("current-input");
    }
    input.classList.add("current-input");

    paperkit.greylayer.show();

    var morphHelper = document.createElement("div");
    morphHelper.id = "morph-helper";
    morphHelper.style.opacity = "0";
    morphHelper.style.height = "500px";
    morphHelper.style.width = "580px";
    morphHelper.style.backgroundColor = "white";
    morphHelper.style.position = "fixed";
    morphHelper.style.top = "50%";
    morphHelper.style.left = "50%";
    morphHelper.style.transform = "translate(-50%, -50%)";
    document.body.appendChild(morphHelper);

    transition.morph(input, morphHelper, function(container) {
        morphHelper.parentNode.removeChild(morphHelper);
        var uri = "movimientos/list";
        ajaxCall("GET", uri, false, true, function(response) {
            var view = response.target.responseText;
            var data = input.getAttribute("data-value").split(",", -1);
            data = data[0] !== "" ? data : [];

            container.innerHTML = view;
            container.classList.add("current-input-dialog");
            paperkit.initElement(container);

            data.forEach(function(id) {
                var tile = container.querySelector("md-tile[data-id=\"" + id + "\"]");
                tile.click();
            });
        });
    });
}

function inputMovementSaveClick(button) {
    var inputDialog = document.querySelector(".current-input-dialog");
    var input = document.querySelector(".current-input");
    var tiles = inputDialog.querySelectorAll("md-tile.selected");
    var data = [];
    var names = [];
    [].forEach.call(tiles, function(tile) {
        var id = tile.getAttribute("data-id");
        var name = tile.querySelector("md-text").textContent;
        var discipline = tile.getAttribute("data-discipline");
        data.push(+id);
        names.push(name + " [" + discipline + "]");
    });
    input.setAttribute("data-value", data.join(","));
    input.setAttribute("value", names.join(", "));
    console.log(data);
    closeMorph();
}

function inputMovementListHandler(tile) {
    if (tile.classList.contains("selected")) {
        tile.classList.remove("selected");
        tile.style.borderLeft = "";
    } else {
        tile.classList.add("selected");
        tile.style.borderLeft = "4px solid black";
    }
}

function closeMorph() {
    transition.morphBack();
    setTimeout(paperkit.greylayer.hide, 1000);
}
