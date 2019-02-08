/*
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org>
 *
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
