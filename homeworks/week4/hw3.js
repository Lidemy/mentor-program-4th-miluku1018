const request = require('request');

const process = require('process');

const args = process.argv;
const name = args[2];


request(`https://restcountries.eu/rest/v2/name/${name}`,
  (error, response, body) => {
    if (error) {
      console.log('抓取失敗', error);
      return;
    }
    const json = JSON.parse(body);
    for (let i = 0; i < json.length; i += 1) {
      console.log('======');
      console.log(`國家： ${json[i].name}`);
      console.log(`首都： ${json[i].capital}`);
      console.log(`貨幣： ${json[i].currencies[0].code}`);
      console.log(`國碼： ${json[i].callingCodes[0]}`);
    }
  });
