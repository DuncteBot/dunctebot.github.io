function makeSuggestion(capToken) {

    _("quotesForm").style.display = "none";
    _("message").style.display = "block";
    _("message").innerHTML = "<h1>Sending.....</h1>";

    const name = _("name").value;
    const sug = _("sug").value;
    const desc = _("textarea1").value;

    const data = JSON.stringify({
        name: name,
        sug: sug,
        desc: desc,
        "g-recaptcha-response": capToken
    });

    fetch(`${apiPrefix}/suggest`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: data
    })
        .then((response) => response.json())
        .then((json) => {
            if (json.status === "success") {
                _("message").innerHTML = `<h1>Thanks for submitting, you can view your suggestion 
                                <a target="_blank" href="${json.trello_url}">here</a></h1>`;

                return;
            }

            _("quotesForm").style.display = "block";
            _("message").innerHTML = "<h1>" + getMessage(json.message) + "</h1>";
        })
        .catch((e) => {
            _("quotesForm").style.display = "block";
            _("message").innerHTML = "An unknown error occurred";
        });

}
