const container = document.querySelector("#msbo");
const body = document.querySelector("body");

container.onclick = function () {
    body.classList.toggle("msb-x");
}

setTimeout(function(){
    document.body.className="";
},500);

$('.name-file').each(function() {
    var h2 = $(this);
    var text = h2.text();
    var replacement = text.substr(text.indexOf('_') + 1);
    h2.text(replacement);
});
