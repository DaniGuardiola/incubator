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
    name: function(){
        help.generic("El nombre del movimiento, puede contener espacios, mayúsculas y tildes. Por ejemplo: \"Doble backflip\".");
    },
    slug: function(){
        help.generic("El id del movimiento, NO puede contener espacios, mayúsculas ni tildes, las palabras se separan por guiones. Por ejemplo: \"doble-backflip\".");
    }
}