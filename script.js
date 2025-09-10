function calculerProduit() {
    // Récupérer les valeurs des champs
    let n1 = document.getElementById("n1").value;
    let n2 = document.getElementById("n2").value;

    // Convertir en nombres
    n1 = parseFloat(n1);
    n2 = parseFloat(n2);

    // Calcul du produit
    let produit = n1 * n2;

    // Affichage
    document.getElementById("res").textContent =
    "Le produit de " + n1 + " et " + n2 + " est : " + produit;
}
function wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
async function ex2()  {
    
    for (let i = 5; i <= 15; i++) {
        document.getElementById("ex2").innerHTML = i ;
        await wait(500);
    }
}

function ex3() {
    let n = document.getElementById("ex3num").value;
    n = parseFloat(n);

    string = "";
    if (n > 0) {
        string = "Positif"; 
    } else if (n < 0) {
        string = "Negatif";
    } else {
        string = "Zero";
    }
    document.getElementById("ex3").innerHTML = string;
}

async function ex4() {
    let n = 10;
    let d = document.getElementById("ex4");
    while(n > 0){
        d.textContent = n;
        n --;
        await new Promise(requestAnimationFrame);
        d.classList.add("ex4");
        await wait(1000);
        d.classList.remove("ex4");
        await new Promise(requestAnimationFrame);
    }
}

function ex5() {
    let n1 = document.getElementById("5n1").value;
    let n2 = document.getElementById("5n2").value;
    let n3 = document.getElementById("5n3").value;

    n1 = parseFloat(n1);
    n2 = parseFloat(n2);
    n3 = parseFloat(n3);

    document.getElementById("ex5").innerHTML = (n1 + n2 + n3) / 3;
}
document.addEventListener("DOMContentLoaded", ex10);
function ex10() {
    let marque = document.getElementById("marque");
    let modele = document.getElementById("modele");
    switch (marque.value){
        case "Ford":
            modele.add(new Option("F-150", "F-150"));
            modele.add(new Option("Model T", "Model T"));
            modele.add(new Option("Mustang", "Mustang"));
            break;
        case "Dodge":
            modele.add(new Option("Ram 1500","Ram 1500"));
            modele.add(new Option( "Grand Caravan", "Grand Caravan"));
            modele.add(new Option("Charger", "Charger"));
            break;
        case "Chevrolet":
            modele.add(new Option("Silverado", "Silverado"));
            modele.add(new Option( "Impala", "Impala"));
            modele.add(new Option( "Corvette", "Corvette"));
            break;
        default:
            break
    }
    
}