const follow_btn = document.querySelector("#follow");
follow_btn.addEventListener("click", follow);
const follow_icon = document.querySelector("#follow img");

fetch("/follows/" + user)
    .then((res) => {
        return res.json();
    })
    .then(isFollowed);

function isFollowed(json) {
    let alreadyFollowed = json["follows"];

    if (alreadyFollowed) {
        follow_icon.src = "/img/full_following.png";
        follow_btn.classList.add("followed");
    } else {
        follow_icon.src = "/img/following.png";
        follow_btn.classList.remove("followed");
    }
}

function follow(event) {
    fetch("/follows/" + user)
        .then((res) => {
            return res.json();
        })
        .then((json) => {
            let alreadyFollowed = json["follows"];

            if (!alreadyFollowed) {
                fetch("/add_follow/" + user)
                    .then((res) => {
                        return res.json();
                    })
                    .then(onJson);
            } else {
                fetch("/remove_follow/" + user)
                    .then((res) => {
                        return res.json();
                    })
                    .then(onRemove);
            }
        });
}

function onJson(json) {
    if (json["success"]) {
        follow_icon.src = "/img/full_following.png";
        follow_btn.classList.add("followed");

        document.querySelector("#num_follow").innerHTML = json["num"];
    }
}

function onRemove(json) {
    if (json["success"]) {
        follow_icon.src = "/img/following.png";
        follow_btn.classList.remove("followed");

        document.querySelector("#num_follow").innerHTML = json["num"];
    }
}
