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

function submitForm(token) {

    let userId = _("user_id").value;
    let guildId = _("guild_id").value;

    _("btn").disabled = true;
    _("btn").classList.add("disabled");
    _("msg").innerHTML = "Checking ids.....";

    fetch(`${apiPrefix}/checkUserAndGuild`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `user_id=${userId}&guild_id=${guildId}`
    })
        .then((blob) => blob.json())
        .then((json) => {
            reset("");

            if (json.code !== 200) {
                _("confirm").innerHTML = `ERROR: <b>${getMessage(json.message)}</b>`;
                return;
            }

            _("confirm").innerHTML = `
                    <div class="row">
                    <div class="col s12 m6">
                        <div class="card small indigo">
                            <div class="card-content white-text">
                                <span class="card-title">Confirm your selection</span>
                                <p>To make sure that the patron perks get added to the correct user and server,
                                    please confirm your input</p>
                                <br>

                                <p>User: <i>${json.user.formatted}</i></p>
                                <p>Server: <i>${json.guild.name}</i></p>
                                <br>

                                <p>If this is not correct please change the ids in the form and press submit again.</p>
                            </div>
                            <div class="card-action ">
                                <a href="#" class="btn green white-text text-lighten-4" onclick="_('patrons').submit(); return false;">This is correct</a>
                            </div>
                        </div>
                    </div>
                </div>
                    `;
        })
        .catch((e) => {
            reset(e.message);
            console.log(e);
            console.error(e)
        });
}

function reset(message) {
    window.scrollTo(0, 0);
    _("btn").disabled = false;
    _("btn").classList.remove("disabled");
    _("msg").innerHTML = message;
}
