const request = require('request');

const options = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    Accept: 'application/vnd.twitchtv.v5+json',
    'Client-ID': '7kj0upo2ypl1ysel4cbolp537m6iow',
  },
};

function callback(error, response, body) {
  if (!error && response.statusCode === 200) {
    const info = JSON.parse(body);
    for (let i = 0; i < info.top.length; i += 1) {
      console.log(`${info.top[i].viewers} ${info.top[i].game.name}`);
    }
  }
}

request(options, callback);
