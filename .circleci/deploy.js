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

const ftpDeploy = new (require('ftp-deploy'))();

const config = {
    user: process.env.FTPUSERNAME,
    password: process.env.FTPPASS,
    host: process.env.FTPHOST,
    port: 21,
    localRoot: `${__dirname}/../_site/`,
    remoteRoot: '/dunctebot.com/',
    include: ['*', '.*'],
    debug: true,
};

ftpDeploy.on('uploading', (data) => console.log(data));
ftpDeploy.on('uploaded', (data) => console.log(data));
ftpDeploy.on('log', (data) => console.log(data));
ftpDeploy.on('upload-error', (data) => {
    console.log(data);

    process.exit(2);
});

ftpDeploy.deploy(config, (err) => {
    if (err) {
        console.log(err);
        process.exit(1);
    } else {
        console.log('finished');
    }
});
