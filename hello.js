const fsPromises = require('fs').promises;

const data = [];
async function readCsv() {
    const content = await fsPromises.readFile('./hello-world.csv');
    data.push(content);

    return Buffer.concat(data).toString();
}

(async () => {
    let hello = await readCsv();
    hello = hello.replace(/,/g, '');
    console.log(hello);
})();
