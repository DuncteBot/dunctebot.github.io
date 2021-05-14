// noinspection JSUnfilteredForInLoop

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

//commands.find(x => x.name === name || x.aliases.includes(name))
const input = document.getElementById('search_input');
const display = document.getElementById('display');

input.addEventListener('keyup', () => {
    if (!input.value) {
        display.innerHTML = buildCommandList(commandsRaw);
        return;
    }

    const toSearch = input.value.replace(prefix, '').toLowerCase();

    // first search in all commands
    let sorted = Object.entries(commandsRaw).map(([category, commands]) => {
        return [
            category,
            commands.filter((x) => {
                return x.name.includes(toSearch) || x.aliases.some(a => a.includes(toSearch));
            })
        ];
    });

    // then search in categories
    if (sorted.every(([_, commands]) => commands.length === 0)) {
        sorted = Object.entries(commandsRaw).filter(([category]) => category.includes(toSearch));
    }

    if (sorted.every(([_, commands]) => commands.length === 0)) {
        display.innerHTML = buildCommandList(null);
        return;
    }

    display.innerHTML = buildCommandList(Object.fromEntries(sorted));
});

const ucfirst = (string) => string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();

function buildCommandList(items) {
    if (!items) {
        return `
                <tr>
                    <td colspan="2">
                        <p class="center">No commands found</p>
                    </td>
                </tr>
            `;
    }

    let output = '';

    for (const category in items) {
        if (!items[category] || !items[category].length) {
            continue;
        }

        output += `<tr>
                      <th colspan="2" class="reset">
                        <h5><strong>${ucfirst(category)} Commands</strong></h5><hr/>
                      </th>
                    </tr>`;
        for (const command of items[category]) {
            output += `
                <tr id="${command.name}">
                    <td>${prefix}${command.name}</td>
                    <td>${command.help}</td>
                </tr>
            `;
        }
    }

    return output;
}
