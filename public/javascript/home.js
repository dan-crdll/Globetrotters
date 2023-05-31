const search_form = document.forms["search_form"];
search_form.addEventListener("submit", onSearch);

var hourglass = document.querySelector("#hourglass img");
var articlesFound = false;
fetch("api/most_popular")
    .then((res) => {
        return res.json();
    })
    .then(onPopular)
    .then(() => {
        hourglass.classList.remove("hidden");
        fetch("api/get_tweets")
            .then((res) => {
                return res.json();
            })
            .then(onTweets);
    });

function onSearch(event) {
    event.preventDefault();

    let q = search_form["search_bar"].value;
    let place = q;
    q = q.replace(" ", "");

    if (q !== "") {
        document.querySelector("#section-subtitle").innerHTML =
            'Ultimi tweet di viaggi con l\'hashtag <span class="hashtag">#' +
            q +
            "</span> e articoli di altri globetrotters se disponibili";
        document.querySelector("#section-title").innerHTML = place;

        fetch("api/search_alike/" + q)
            .then((res) => {
                return res.json();
            })
            .then(onAlike)
            .then(() => {
                hourglass.classList.remove("hidden");
                fetch("api/get_tweets/" + q)
                    .then((res) => {
                        return res.json();
                    })
                    .then(onTweets);
            });
    } else {
        document.querySelector("#section-subtitle").innerHTML =
            'Ultimi tweet dell\'account <span class="hashtag">Trip Advisor</span> e articoli più popolari';
        document.querySelector("#section-title").innerHTML =
            "Lasciati ispirare";

        fetch("api/most_popular")
            .then((res) => {
                return res.json();
            })
            .then(onPopular)
            .then(() => {
                hourglass.classList.remove("hidden");
                fetch("api/get_tweets")
                    .then((res) => {
                        return res.json();
                    })
                    .then(onTweets);
            });
    }
}

function onTweets(tweets) {
    if (tweets["num"] === 0) {
        if (!articlesFound)
            document.querySelector("#article-list").innerHTML =
                "Non è stato trovato alcun risultato";
    } else
        for (let t of tweets) {
            let content = t.content;
            let photo = t.photo;

            let article = document.createElement("div");
            article.addEventListener('click', onModalView);

            article.classList.add("tweet");
            article.classList.add("article");

            let image = document.createElement("div");
            image.classList.add("image_article");
            image.style.backgroundImage = "url('" + photo + "')";

            let title = document.createElement("div");
            title.classList.add("article_content");
            title.innerHTML = content;

            article.appendChild(image);
            article.appendChild(title);

            document.querySelector("#article-list").appendChild(article);
        }

    hourglass.classList.add("hidden");
}

function onPopular(json) {
    console.log(json);
    document.querySelector("#most_popular").innerHTML = "";
    document.querySelector("#article-list").innerHTML = "";
    let num = 3;

    if (json["num"] === 0) {
        return;
    }

    document.querySelector("#most_popular").style.display = "flex";

    if (json.length < 3) {
        num = json["articles"].length;
    }

    for (let i = 0; i < num; i++) {
        let content =
            json["articles"][i]["TITLE"].length > 60
                ? json["articles"][i]["TITLE"].slice(0, 59) + "..."
                : json["articles"][i]["TITLE"];
        let photo = json["articles"][i]["IMAGE_URL"];
        let id = json["articles"][i]["ID"];

        let article = document.createElement("a");
        article.classList.add("article");
        article.href = "/article/" + id;

        let image = document.createElement("div");
        image.classList.add("image_article");
        image.style.backgroundImage = "url('" + photo + "')";

        let title = document.createElement("div");
        title.classList.add("article_title");
        title.innerHTML = content;

        article.appendChild(image);
        article.appendChild(title);

        document.querySelector("#most_popular").appendChild(article);
    }
    return;
}

function onAlike(json) {
    document.querySelector("#most_popular").innerHTML = "";
    document.querySelector("#most_popular").style.display = "none";
    document.querySelector("#article-list").innerHTML = "";
    if (json["num"] === 0) {
      articlesFound = false;
        return;
    }

    articlesFound = true;
    for (let j of json["articles"]) {
        let content =
            j["TITLE"].length > 60
                ? j["TITLE"].slice(0, 59) + "..."
                : j["TITLE"];
        let photo = j["IMAGE_URL"];
        let id = j["ID"];

        let article = document.createElement("a");
        article.classList.add("article");
        article.href = "/article/" + id;

        let image = document.createElement("div");
        image.classList.add("image_article");
        image.style.backgroundImage = "url('" + photo + "')";

        let title = document.createElement("div");
        title.classList.add("article_title");
        title.innerHTML = content;

        article.appendChild(image);
        article.appendChild(title);

        document.querySelector("#article-list").appendChild(article);
    }
    return;
}

function onModalView(event) {
    const modale = document.querySelector('#modal_view');
    const list_modale = document.querySelector('#modal_view .page');
    list_modale.appendChild(event.target);
    modale.classList.remove('hidden');
    modale.addEventListener('click', onCloseModale);
}

function onCloseModale(event) {
    const last = document.querySelector('#modal_view .page').lastChild;
    document.querySelector('#modal_view .page').removeChild(last);
    document.querySelector('#modal_view').classList.add('hidden');
}