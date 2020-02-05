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

function _(el) {
    return document.getElementById(el);
}

document.addEventListener("DOMContentLoaded", () => {
    M.Sidenav.init(document.querySelectorAll(".sidenav"));
});

function getMessage(m) {

    switch (m) {
        case "missing_input":
            return "Please fill in all fields";
        case "no_user":
            return "The specified user id did not resolve any users.";
        case "captcha_failed":
            return "Could not verify human check, try again later";
        case "no_guild":
            return "The specified server id did not resolve any servers.";
        default:
            return m;
    }
}

