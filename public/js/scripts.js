function disable() {
    document.getElementsByClassName("#button-prevent-multiple-submits").disabled = true;
    document.getElementById("spinner").style.display='inline-block';
    document.getElementById("btex").innerText='Cargando';
}