
// function newRecipe(){
//     let xhttp = new XMLHttpRequest();

//     xhttp.onload = function() {
//         if (this.status == 200) {
//             document.getElementById("recipe").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "templates/components/navbar.html.twig",true);
//     xhttp.send();
// }

function FetchUnaprovedMeals(){
    const numberOfUnapprovedMeals = document.querySelector('.numberOfUnapprovedMeals');
    fetch('/admin/mealDashboard/ajax/newRecipe', {
        method: 'GET', // or 'POST' depending on your needs
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Handle the response, in this case, log the length
        numberOfUnapprovedMeals.innerText = data.length;
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}
