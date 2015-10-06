var paperkit = new Paperkit();
paperkit.init();

var currentTab = "parkour";

window.addEventListener("load", function() {
    addInputsClickListener(document.querySelector("form"));
});

function movementListHandler(tile) {
    var last = tile.parentNode.querySelector("md-tile.open");
    if (last) {
        last.classList.remove("open");
        last.style.borderLeft = "";
    }
    tile.classList.add("open");
    tile.style.borderLeft = "8px black solid";
    var uri = "movimientos/movement/" + tile.getAttribute("data-id") + "/" + tile.parentNode.getAttribute("data-discipline");
    ajaxCall("GET", uri, false, true, function(response) {
        var container = tile.parentNode.parentNode.parentNode.querySelector(".movement-form");
        var form = response.target.responseText;
        container.innerHTML = form;
        paperkit.initElement(container);
        addInputsClickListener(container);
        var id = container.querySelector("form.movement").getAttribute("data-id");
        if (tile.getAttribute("data-id") === "new") {
            tile.setAttribute("data-id", id);
        }
        tile.querySelector("md-text").textContent = container.querySelector("form.movement md-input[name=\"name\"]").getAttribute("value");
    });
}

function deleteMovement(button) {
    var tile = button.parentNode;
    var list = tile.parentNode;
    var uri = "movimientos/remove-movement/" + tile.getAttribute("data-id");
    ajaxCall("GET", uri, false, true, function() {});
    if (tile.classList.contains("open") && list.children.length > 1) {
        if (tile.nextElementSibling) {
            tile.nextElementSibling.click();
        } else {
            tile.previousElementSibling.click();
        }
    } else if (tile.classList.contains("open")) {
        var container = tile.parentNode.parentNode.parentNode.querySelector(".movement-form");
        container.innerHTML = '<md-paper md-padding md-shadow="shadow-1"><p md-typo="display-1" md-position="text-center-x">No hay movimientos en esta disciplina</p><p md-typo="headline" md-position="text-center-x">Crea uno en el menú de la izquierda para comenzar</p></md-paper>';
    }
    tile.parentNode.removeChild(tile);
}

function addMovement(button) {
    var list = button.parentNode.parentNode.parentNode.querySelector(".movements-list");
    var tile = list.addItem();
    tile.innerHTML = '<md-text>Nuevo movimiento</md-text><md-icon-button md-action="custom: deleteMovement" class="show-parent-hover" md-image="icon: delete"></md-icon-button>';
    tile.setAttribute("data-id", "new");
    paperkit.initElement(tile);
    list.appendChild(tile);
    tile.removeAttribute("id");
    tile.click();
}

function ajaxCall(method, uri, parameters, async, callback, csrf) {
    method = method || "GET";
    async = async || true;

    var xhr = new XMLHttpRequest();
    xhr.open(method, uri, async);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    if (typeof parameters == "FormData") {
        xhr.setRequestHeader("Content-type", "multipart/form-data");
    } else if (typeof parameters == "string") {
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
};

function getSpecificData(encode) {
    var page = document.querySelector(".page." + currentTab);
    var form = page.querySelector("form.movement");
    var discipline = form.getAttribute("data-discipline");
    var data = {};
    if (discipline === "1" || discipline === "2") {
        data.wall = form.querySelector("[name=\"wall\"]").getAttribute("value") === "on" ? true : false;
    }
    if (discipline === "2" || discipline === "3") {
        data.onefoot = form.querySelector("[name=\"onefoot\"]").getAttribute("value") === "on" ? true : false;
        data.twist = form.querySelector("[name=\"twist\"]").value;
        data.spin = form.querySelector("[name=\"spin\"]").value;
    }
    return encode ? JSON.stringify(data) : data;
}

function saveMovement() {
    var page = document.querySelector(".page." + currentTab);
    var form = page.querySelector("form.movement");
    var data = new FormData(form);
    var id = form.getAttribute("data-id");
    var csrf = form.getAttribute("data-csrf");


    page.querySelector(".movements-list md-tile.open md-text").textContent = page.querySelector("md-input[name=\"name\"]").getAttribute("value");

    var uri = "movimientos/save-movement/" + id;

    data.append("category", form.querySelector('md-input[name="category"]').getAttribute("value"));

    data.append("specific", getSpecificData(true));

    data.append("equals", form.querySelector('md-input[name="equals"]').getAttribute("data-value"));

    data.append("requirements", form.querySelector('md-input[name="requirements"]').getAttribute("data-value"));

    data.append("derived_from", form.querySelector('md-input[name="derived_from"]').getAttribute("data-value"));

    data.append("variations", form.querySelector('md-input[name="variations"]').getAttribute("data-value"));

    var lists = form.querySelectorAll("md-list");
    for (var i = lists.length - 1; i >= 0; i--) {
        var list = lists[i];
        var items = list.querySelectorAll("md-tile");

        var output = [];
        for (var o = 0; o < items.length; o++) {
            output.push(items[o].querySelector("md-input").value);
        }
        console.log("DATA IS " + output);
        data.append(list.getAttribute("name"), output.join("|"));
    }

    /*
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
function addInputsClickListener(form) {
    if (form.constructor === Array) {
        for (var i = form.length - 1; i >= 0; i--) {
            addInputsClickListener(form[i])
        };
    }
    form = form;
    [].forEach.call(
        form.querySelectorAll('.input-movement'),
        function(input) {
            input.addEventListener("click", inputMovementClick);
        });
    [].forEach.call(
        form.querySelectorAll('md-list'),
        function(list) {
            var tiles = list.children;
            for (var i = tiles.length - 1; i >= 0; i--) {
                inputListTileAddDrag(tiles[i]);

            };
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

// Lists
function inputListDeleteClick(button) {
    var tile = button.parentNode;
    var list = tile.parentNode;
    list.removeChild(tile);

    if (list.classList.contains("numbered")) {
        inputListNumbered(list);
    }
}

function inputListNumbered(list) {
    var items = list.children;
    for (var i = 0; i < items.length; i++) {
        var tile = items[i];
        var number = i + 1;
        if (number === 1) {
            numberstring = "one";
        } else if (number === 2) {
            numberstring = "two";
        } else if (number === 3) {
            numberstring = "3";
        } else if (number === 4) {
            numberstring = "4";
        } else if (number === 5) {
            numberstring = "5";
        } else {
            numberstring = "6";
        }
        var image = "icon: looks_" + numberstring;
        tile.querySelector("md-icon.number").setAttribute("md-image", image);
    };
}

function inputListDragEnd(tile) {
    var list = tile.parentNode;
    var tiles = list.querySelectorAll("md-tile");

    /* Get tile position */
    var oldPosition = Array.prototype.indexOf.call(tiles, tile);
    var position = oldPosition + (parseInt(tile.style.top) / 56);
    if (position > oldPosition) {
        position++;
    }

    for (var i = 0; i <= tiles.length; i++) {
        if (i === position) {
            list.appendChild(tile);
        }
        if (tiles[i] && tiles[i] !== tile) {
            list.appendChild(tiles[i]);
        }
        if (tiles[i]) {
            tiles[i].style.top = "";
            tiles[i].style.left = "";
        }
    }
    if (list.classList.contains("numbered")) {
        inputListNumbered(list);
    }
}



function inputListTileAddDrag(tile) {
    var list = tile.parentNode;
    var draggie = new Draggabilly(tile, {
        handle: ".drag",
        axis: "y",
        containment: list,
        grid: [0, 56]
    });
    draggie.on('dragStart', function(event, pointer) {
        var theTile = document.querySelector(".is-pointer-down");
        theTile.classList.add("last-dragged");
    });

    draggie.on('dragEnd', function(event, pointer) {
        var theTile = document.querySelector(".last-dragged")
        theTile.classList.remove("last-dragged");
        inputListDragEnd(theTile);
    });
}

function inputListAdd(button) {    
    var page = document.querySelector(".page." + currentTab);
    var list = page.querySelector("md-list[name=\"" + button.getAttribute("data-list") + "\"");
    var tile = document.createElement("md-tile");
    var numbericon = "";
    if (list.classList.contains("numbered")) {
        numbericon = '<md-icon class="number" md-image="icon: looks_6"></md-icon>';
    }
    tile.innerHTML = '<md-icon class="drag" md-image="icon: drag"></md-icon>' + numbericon + '<md-input style="flex: 1;" type="text" value=""></md-input><md-icon-button class="show-parent-hover" md-action="custom: inputListDeleteClick" md-image="icon: delete"></md-icon-button>';
    paperkit.initElement(tile);
    inputListTileAddDrag(tile);
    list.appendChild(tile);
    if (list.classList.contains("numbered")) {
        inputListNumbered(list);
    }
    tile.querySelector("md-input input").focus();
}
