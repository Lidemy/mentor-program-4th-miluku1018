const request = require('request');

const process = require('process');

const args = process.argv;
const action = args[2];
const params = args[3];

function listBooks() {
  request('https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (error, response, body) => {
      if (error) {
        console.log('抓取失敗', error);
        return;
      }
      const json = JSON.parse(body);
      console.log(json);
    });
}

function getBook(id) {
  request(`https://lidemy-book-store.herokuapp.com/books/${id}`,
    (error, response, body) => {
      if (error) {
        console.log('抓取失敗', error);
        return;
      }
      const json = JSON.parse(body);
      console.log(json);
    });
}

function deleteBook(id) {
  request(`https://lidemy-book-store.herokuapp.com/books/${id}`,
    (error) => {
      if (error) {
        console.log('刪除失敗', error);
        return;
      }
      console.log('刪除成功');
    });
}

function createBook(name) {
  request.post(
    {
      url: 'https://lidemy-book-store.herokuapp.com/books',
      form: {
        name,
      },
    },
    (error) => {
      if (error) {
        console.log('新增失敗', error);
        return;
      }
      console.log('新增成功');
    },
  );
}

function updateBook(id, name) {
  request.patch(
    {
      url: `https://lidemy-book-store.herokuapp.com/books/${id}`,
      form: {
        name,
      },
    },
    (error, response, body) => {
      if (error) {
        console.log('更新失敗', error);
        return;
      }
      console.log(body);
    },
  );
}


if (action === 'list') {
  listBooks();
} else if (action === 'read') {
  getBook(params);
} else if (action === 'delete') {
  deleteBook(params);
} else if (action === 'create') {
  createBook(params);
} else if (action === 'update') {
  updateBook(params, args[4]);
}
