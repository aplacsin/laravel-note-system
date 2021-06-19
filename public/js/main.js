const container = document.querySelector("#msbo");
const body = document.querySelector("body");

container.onclick = function () {
    body.classList.toggle("msb-x");
}

setTimeout(function(){
    document.body.className="";
},500);
