/*
 *    Copyright 2017-2019 Duncan "duncte123" Sterken
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */

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
