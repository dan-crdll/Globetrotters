const image = document.querySelector("#prof_img");

fetch("/api/get_usplash_image").then(onRes).then(onJson);

function onRes(res) {
  return res.json();
}

function onJson(json) {
  image.style.backgroundImage = 'url("' + json["link"] + '")';
  console.log(json['link']);
}
