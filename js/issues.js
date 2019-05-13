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

function addCommand() {
    const id = (new Date()).getTime();
    const item = document.createElement('div');

    item.id = `cmd-${id}`;
    item.innerHTML = `
    <button class="btn red" onclick="delCMD('cmd-${id}'); return false;">X</button>
    <div class="input-field inline">
        <input name="command" type="text" placeholder="db!help drake" pattern="db![a-z0-9 ]+" class="validate" required>
        <span class="helper-text" data-error="Invalid command" data-success=""></span>
    </div>`;


    _("commandsContainer").appendChild(item);
}

function delCMD(id) {
    const item = _(id);
    item.parentNode.removeChild(item);
}

function genJson() {
    const output = _("output");
    const modal = M.Modal.init(_("modal1"));
    const cmds = Array.from(document.querySelectorAll("input[name='command']")).map(x => x.value);
    const data = {
        description: _("description").value,
        detailedReport: _("detailedReport").value,
        lastCommands: cmds,
        inv: `https://discord.gg/${_("inv").value}`
    };

    output.innerHTML = JSON.stringify(data);

    hljs.highlightBlock(output);
    modal.open();
}
