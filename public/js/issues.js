/*
 *      Copyright 2017 Duncan "duncte123" Sterken
 *
 *      Licensed under the Apache License, Version 2.0 (the "License");
 *      you may not use this file except in compliance with the License.
 *      You may obtain a copy of the License at
 *
 *          http://www.apache.org/licenses/LICENSE-2.0
 *
 *      Unless required by applicable law or agreed to in writing, software
 *      distributed under the License is distributed on an "AS IS" BASIS,
 *      WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *      See the License for the specific language governing permissions and
 *      limitations under the License.
 */

function addCommand() {
    const timeID = (new Date()).getTime();
    const item = document.createElement('div');

    item.id = `cmd-${timeID}`;
    item.innerHTML = `
    <button class="btn red" onclick="delCMD('cmd-${timeID}'); return false;">X</button>
    <div class="input-field inline">
        <input name="command" type="text" placeholder="db!help drake" pattern="db![a-z0-9 ]+" class="validate" required>
        <span class="helper-text" data-error="Invalid command (should start with db!)" data-success=""></span>
    </div>`;

    id("commandsContainer").appendChild(item);
}

function delCMD(btnId) {
    const item = id(btnId);
    item.parentNode.removeChild(item);
}

function genJson() {
    const output = id("output");
    const modal = M.Modal.init(id("modal1"));
    const cmds = Array.from(document.querySelectorAll("input[name='command']")).map(x => x.value);
    const data = {
        description: id("description").value,
        detailedReport: id("detailedReport").value,
        lastCommands: cmds,
        inv: `https://discord.gg/${id("inv").value}`
    };

    output.innerHTML = JSON.stringify(data);

    hljs.highlightBlock(output);
    modal.open();
}
