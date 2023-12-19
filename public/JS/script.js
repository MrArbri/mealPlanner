function newRecipe(){
    let xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        if (this.status == 200) {
            document.getElementById("recipe").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "templates/components/navbar.html.twig",true);
    xhttp.send();
}