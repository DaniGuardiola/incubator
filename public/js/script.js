var paperkit = new Paperkit();
paperkit.init();

function movementListHandler(el) {
	var uri = "home/movement/" + el.getAttribute("data-id");
    ajaxCall("GET", uri, false, true, function(response) {
    	console.log(response);
    });
}

function ajaxCall(method, uri, parameters, async, callback) {
    method = method || "GET";
    async = async || true;

    var xhr = new XMLHttpRequest;
    xhr.open(method, uri, async);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    if (typeof parameters == 'FormData') {
        xhr.setRequestHeader("Content-type", "multipart/form-data");
    } else if (typeof parameters == 'string') {
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    } else {}

    xhr.addEventListener("load", function(event) {
        callback(event, callback);
    });

    xhr.send(parameters);
}

var help = {
    generic: function(what){
        console.log("This will show help with this text: " + what);
        alert(what);
    },
    slug: function(){
        help.generic("El identificador del movimiento, NO puede contener espacios, mayúsculas ni tildes, las palabras se separan por guiones. Por ejemplo: \"doble-backflip\".");
    },
    category: function(){
        help.generic("Elije la categoría que corresponda para este movimiento");
    },
    name: function(){
        help.generic("El nombre del movimiento, puede contener espacios, mayúsculas y tildes. Por ejemplo: \"Doble backflip\".");
    },
    name_variants: function(){
        help.generic("Las variantes del nombre separadas por comas (no dejes espacio detrás de la coma). Por ejemplo: \"Primera variación,Variante segunda,Tercer sinónimo\".");
    },
    equals: function(){
        help.generic("Los movimientos equivalentes de otras disciplinas (por ejemplo, el backflip aparece en street stunts y en tricking)");
    },
    tags: function(){
        help.generic("Las etiquetas separadas por comas. Por ejemplo: \"Carpado,Plancha\". Es importante que leas la página de ayuda antes de editar este campo.");
    },
    history: function(){
        help.generic("La historia del movimiento. Sigue las guías de la página de ayuda para redactarla correctamente.");
    },
    technique_description_text: function(){
        help.generic("La breve explicación técnica que luego servirá de guión para el vídeo explicativo (además de mostrarse también en formato texto). Sigue las guías de la página de ayuda para redactarla correctamente.");
    },
}