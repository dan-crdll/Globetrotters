const sandwich = document.querySelector("#sandwich_btn");
var isOpen = false;

sandwich.addEventListener("click", onOpenMenu);

function onOpenMenu(event) {
  console.log('ciao');
  if (isOpen) {
    document.querySelector("#sandwich_container").classList.add('hidden');
  } else {
    document.querySelector("#sandwich_container").classList.remove('hidden');
  }
  isOpen = !isOpen;
}
