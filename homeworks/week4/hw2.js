const request = require('request');

const process = require('process');

const args = process.argv;
const action = args[2];

function listBooks() {
  request('https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (body) => {
      const json = JSON.parse(body);
      console.log(json);
    });
}

switch (action) {
  case 'list':
    listBooks();
    break;
  default:
    console.log('Available commands: list, read, delete, create and update');
}
