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
// https://stackoverflow.com/questions/6321763/fastest-way-to-search-string-in-javascript
const searchDebounced =  _.debounce(() => {
    let sorted = window.searchData;

    if (input.value) {
        const toSearch = input.value.toLowerCase();

        sorted = sorted.filter(x => x.name.toLowerCase().includes(toSearch) || x.website.toLowerCase().includes(toSearch));
    }

    display.innerHTML = buildRadioList(sorted);
},250);

input.addEventListener('input', () => {
    searchDebounced();
});

function buildRadioList(items) {

    if (!items.length) {
        return `
                <tr>
                    <td colspan="2">
                        <p class="center">No radio streams found</p>
                    </td>
                </tr>
            `;
    }

    return items.map(stream => `
        <tr>
            <td>${stream.name}</td>
            <td><a href="${stream.website}" target="_blank">${new URL(stream.website).host}</a></td>
        </tr>
    `).join('');
}
