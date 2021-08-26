//Le carroussel des Stars

//les variables utiles

let currentPhoto = 0; //la photo est en position 0 du tableau

//photo c'est le tableau des photos 4 images mais 0 1 2 3
let photos = document.querySelectorAll(".diaporama img");

let timer;

timer = setInterval(goToNextPhoto, 5000);

//je crée la fonction

function goToNextPhoto() {
  photos[currentPhoto].classList.remove("visible");
  //cacher la photo qui est affichée actuellement (enlevant la classe visible)

  currentPhoto++;
  if (currentPhoto > photos.length - 1) {
    currentPhoto = 0;
  }

  //Est-ce que grandeur du tableau photo est plus petit que -1 alors mon tableau est = à 0
  photos[currentPhoto].classList.add("visible");
}
