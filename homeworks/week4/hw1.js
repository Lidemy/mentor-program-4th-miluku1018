const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (body) => {
    const json = JSON.parse(body);
    console.log(json);
  });
