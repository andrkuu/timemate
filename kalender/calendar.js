let d = new Date();
let aasta = d.getFullYear();
let kuu = d.getMonth();

let kuuContainer = document.querySelector("#kuu");
let aastaContainer = document.querySelector("#aasta");

let months = [
    "jaanuar",
    "veebruar",
    "märts",
    "aprill",
    "mai",
    "juuni",
    "juuli",
    "august",
    "september",
    "oktoober",
    "november",
    "detsember"
];

kuuContainer.innerHTML = months[kuu];
aastaContainer.innerHTML = aasta;