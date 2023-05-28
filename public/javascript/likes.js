const like_btn = document.querySelector("#likes");
like_btn.addEventListener("click", like);
const like_icon = document.querySelector("#likes img");

fetch("/is_liked/" + article)
    .then((res) => {
        return res.json();
    })
    .then(isliked);

function isliked(json) {
    let alreadyliked = json["likes"];

    if (alreadyliked) {
        like_icon.src = "/img/full_star.png";
        like_btn.classList.add("liked");
    } else {
        like_icon.src = "/img/star.png";
        like_btn.classList.remove("liked");
    }
}

function like(event) {
    fetch("/is_liked/" + article)
        .then((res) => {
            return res.json();
        })
        .then((json) => {
            let alreadyliked = json["likes"];

            if (!alreadyliked) {
                fetch("/like/" + article)
                    .then((res) => {
                        return res.json();
                    })
                    .then(onJson);
            } else {
                fetch("/like/" + article)
                    .then((res) => {
                        return res.json();
                    })
                    .then(onRemove);
            }
        });
}

function onJson(json) {
    if (json["success"]) {
        like_icon.src = "/img/full_star.png";
        like_btn.classList.add("liked");

        document.querySelector("#num_like").innerHTML = json["num"];
    }
}

function onRemove(json) {
    if (json["success"]) {
        like_icon.src = "/img/star.png";
        like_btn.classList.remove("liked");

        document.querySelector("#num_like").innerHTML = json["num"];
    }
}
