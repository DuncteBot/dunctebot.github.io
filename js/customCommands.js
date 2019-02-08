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

function initModal() {
    window.storedCommands = {};
    window.modal = M.Modal.init(document.querySelectorAll('.modal'))[0];
}

function initEitor() {
    const jagTagCompleter = {
        getCompletions: function (editor, session, pos, prefix, callback) {

            const firstChar = session.getTokenAt(pos.row, pos.column - 1).value;

            callback(null, wordList.map((word) => {
                return {
                    caption: word,
                    value: firstChar === "{" ? word.substr(1) : word,
                    meta: "JagTag"
                };
            }));

        }
    };

    ace.require("ace/ext/language_tools");
    window.editor = ace.edit("editor", {
        theme: "ace/theme/monokai",
        mode: "ace/mode/perl",
        maxLines: 18,
        minLines: 10,
        wrap: false,
        autoScrollEditorIntoView: true,
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
    });

    editor.completers = [jagTagCompleter];

    editor.getSession().on('change', () => {
        _("chars").innerHTML = editor.getSession().getValue().length;
    });
}

function loadCommands() {
    fetch(`${apiPrefix}/customcommands/${guildId}`, {
        credentials: "same-origin"
    })
        .then((response) => response.json())
        .then((json) => {

            const div = _("commands");

            if (json.status === "error") {

                div.innerHTML = `<h1 class="center">Session not valid</h1>
                              <h5 class="center">Please refresh your browser</h5>`;

                return;
            }

            if (json.commands.length < 0) {

                div.innerHTML = `<h1 class="center">No commands here</h1>`;

                return;
            }

            div.innerHTML = "";

            for (const command of json.commands) {
                storedCommands[command.name] = command;

                div.innerHTML += `
                    <li class="collection-item">
                        <h6 class="left">${command.name}</h6>

                        <div class="right">
                            <a href="#" onclick="showCommand('${command.name}'); return false;"
                                class="waves-effect waves-light btn valign-wrapper"><i class="left material-icons">create</i> Edit</a>
                            <a href="#" onclick="deleteCommand('${command.name}'); return false;" 
                                class="waves-effect waves-light red btn valign-wrapper"><i class="left material-icons">delete</i> Delete</a>
                        </div>

                        <div class="clearfix"></div>
                    </li>`;
            }

        })
        .catch(
            () => _("commands").innerHTML = "Your session has expired, please refresh your browser"
        );
}

function showCommand(name) {

    const command = storedCommands[name];

    showModal(name, command.message, `saveEdit("${name}")`, command.autoresponse);
}

function deleteCommand(name) {

    const conf = confirm("Are you sure that you want to delete this command?");

    if (!conf) {
        return;
    }

    toast(`Deleting "${name}"!`);

    fetch(`${apiPrefix}/customcommands/${guildId}`, {
        method: "DELETE",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            name
        })

    })
        .then((response) => response.json())
        .then((json) => {

            if (json.status === "success") {
                toast("Deleted!");
                modal.close();
                _("chars").innerHTML = 0;
                setTimeout(() => window.location.reload(), 500);
                return
            }

            toast(`Could not save: ${json.message}`);
        })
        .catch((e) => {
            toast(`Could not save: ${e}`);
        });
}

function clearEditor() {
    _("chars").innerHTML = 0;
    editor.setValue("");
    modal.close();
}

function saveEdit(name) {
    toast("Saving...");

    const command = storedCommands[name];
    command.message = editor.getValue();
    command.autoresponse = _("autoresponse").checked;

    fetch(`${apiPrefix}/customcommands/${guildId}`, {
        method: "PATCH",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(command)
    })
        .then((response) => response.json())
        .then((json) => {

            if (json.status === "success") {
                toast("Saved!");
                modal.close();
                _("chars").innerHTML = 0;
                return
            }

            toast(`Could not save: ${json.message}`);
        })
        .catch((e) => {
            toast(`Could not save: ${e}`);
        });
}

function showModal(invoke, message, method, autoresponse) {
    editor.setValue(message);
    _("commandName").value = invoke;
    _("autoresponse").checked = autoresponse;

    _("saveBtn").setAttribute("onclick", `${method}; return false;`);

    modal.open();
    editor.resize();
    editor.clearSelection();
    _("chars").innerHTML = message.length;
}

function prepareCreateNew() {
    _("chars").innerHTML = 0;
    showModal("", "", "createNew()", false);
}

function createNew() {
    let name = _("commandName").value;
    name = name.replace(/\s+/g, '');

    if (name === "") {
        toast("Please give a name");
        return
    }

    if (name.length > 25) {
        toast("Name must be less than 25 characters");
        return
    }

    const action = editor.getValue();

    if (action === "") {
        toast("Message cannot be empty");
        return
    }

    if (action.length > 4000) {
        toast("Message cannot greater than 4000 characters");
        return
    }

    const command = {
        name: name,
        message: action,
        guildId: guildId,
        autoresponse: _("autoresponse").checked,
    };

    storedCommands[name] = command;

    toast("Adding command....");

    fetch(`${apiPrefix}/customcommands/${guildId}`, {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(command)
    })
        .then((response) => response.json())
        .then((json) => {

            if (json.status === "success") {
                toast("Command added");
                setTimeout(() => window.location.reload(), 500);
                modal.close();
                _("chars").innerHTML = 0;
                return
            }

            toast(`Could not save: ${json.message}`);
        })
        .catch((e) => {
            toast(`Could not save: ${e}`);
        });
}

function toast(message) {
    M.toast({
        html: message,
    });
}
