/*
 *      Copyright 2017-2020 Duncan "duncte123" Sterken
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

//commands.find(x => x.name === name || x.aliases.includes(name))
const input = document.getElementById('search_input');
const display = document.getElementById('display');

input.addEventListener('keyup', () => {
    let sorted = commandsRaw.sort((a, b) => a.name.localeCompare(b.name));

    if (input.value) {
        const toSearch = input.value.replace(prefix, '').toLowerCase();

        sorted = sorted.filter(x => x.name.includes(toSearch) || x.aliases.some(a => a.includes(toSearch)));
    }

    display.innerHTML = buildCommandList(sorted);
});

function buildCommandList(items) {

    if (!items.length) {
        return `
                <tr>
                    <td colspan="2">
                        <p class="center">No commands found</p>
                    </td>
                </tr>
            `;
    }

    let output = '';

    for (let command of items) {
        output += `
                <tr id="${command.name}">
                    <td>${prefix}${command.name}</td>
                    <td>${command.help}</td>
                </tr>
            `;
    }

    return output;
}
