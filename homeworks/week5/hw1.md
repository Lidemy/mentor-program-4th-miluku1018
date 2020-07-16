## 前四週心得與解題心得
* 第一週心得： 第一週果真是暖身週，基本上 Git 指令都蠻熟悉的，等於是在複習的概念。當然也學到了一些網路知識，像是 request & response

* 第二週心得： 第二週開始學到以前最恐懼的 JavaScript，這一週經過老師講解，了解一行一行程式碼的運行，學會手動寫出一行一行程式碼的運行，學會 return vs console.log，學會從虛擬碼到程式碼，學會使用 debugger 來看程式碼走向，讓我瞬間解開以前的死結。

* 第三週心得：第三週比較崩潰的是對於 LIOJ 操作上的不熟悉，所以，也花了蠻多時間了解的。多虧好心的同學幫我解惑，也認識了一個很強的同學，後來的課業，也都是問同學就可以了，因為他進度比我還前面哈哈。 這一週學到的是瘋狂解題，強化 JavaScript 基礎技能，先不要使用高階函數，因為在還沒學會走之前，不要想急著跑～這一週的幫助真的很大，但是，自己也要持續解題，跟複習，才能繼續進步。解題最重要的是先搞清楚題目要什麼，然後，一步一步由小寫到大，延伸出去，這也是從老師身上學到的，千萬不要一開始就想著我可以怎樣解出來，一步一步慢慢解開。舉例來說：聖誕樹，先要能印出聖誕樹上面的葉子，再加上空白，可以產生題目需要的樣子，再來要能印出葉子下的樹枝，這樣一步一步拆解。說實話，解題還是蠻開心的～有成就感。

* 第四週心得： 第四週的作業真的是這幾週難度最高的一週，API 跟 Node.js 都是我很不熟悉的，因此，靠自己摸索，花了很多時間才寫完作業。說實話，之前在五倍有學過使用 Postman，我只知道是拿來抓資料的，也不懂為什麼要這樣做，就是整個人都在狀況外～可能當時腦袋裝豆腐哈哈，完全狀況外～所以，還是很感謝胡立老師的出現，拯救了我～誒？好像變成感恩大會～哈哈。回歸正題，串 API 讓我覺得與現實世界有接上軌道的感覺，知道自己可以拿來做哪些事情。老師補充的額外影片，也是讓我更了解爬蟲的意義是什麼～以前總覺得大家都會爬蟲，好像很厲害，沒想到我現在也會爬蟲惹～

* Lidemy HTTP Challenge 解題心得：
一開始看到有 10 道題目，心中有股莫名的恐懼感，想說是不是會解到天荒地老，海枯石爛...等，為了不要讓自己有太多藉口，於是，甩開逃避心態，開始進行寫題目，寫著寫著～跟著老師的提示走哈哈＋谷歌大神，基本上都可以解出來，有時候是自己沒有「看清」題目內容，然後，鬼打牆寫不出來。對我來說卡住的地方是「中文要轉碼」＆「base64碼」，都是反覆看題目＋問問谷歌，才終於解開。心得就是不要自己嚇自己，一步一步慢慢做，只要跟著 API 文件規則走，就會寫出來的。最終，寫完的時候，有種破關的開心感，寫作業反而是一種享受，這大概是生平第一次有這種感覺～

* 以下是 Lidemy HTTP Challenge 解題程式碼
const request = require('request')

const process = require('process');
const { connect } = require('http2');


// 第一關：輸入名字
request(
  'https://lidemy-http-challenge.herokuapp.com/lv1?token={GOGOGO}&name=nevaeh',
  function (error, response, body) {
    console.log(body)
  }
)

// 第二關：找到對的書
request(
  'https://lidemy-http-challenge.herokuapp.com/lv2?token={HellOWOrld}&id=56',
  function (error, response, body) {
    console.log(body)
  }
)

// 第三關：新增書本後，提供 id
request(
  'https://lidemy-http-challenge.herokuapp.com/lv3?token={5566NO1}&id=1989',
  function (error, response, body) {
    console.log(body)
  }
)

// 新增書本
request.post(
  {
    url: 'https://lidemy-http-challenge.herokuapp.com/api/books',
    form: {
      name: '大腦喜歡這樣學', 
      ISBN: '9789863594475'
    }
  },
  function (error, response, body) {
    console.log(error, body)
    console.log(response.statusCode)
  }
)

// 第四關：找有「世界」名字的書本，作者：村上春樹

request(
  'https://lidemy-http-challenge.herokuapp.com/lv4?token={LEarnHOWtoLeArn}&id=79',
  function (error, response, body) {
    console.log(body)
  }
)
const string = encodeURI('世界')
request(
  `https://lidemy-http-challenge.herokuapp.com/api/books?q=${string}`,
  function (error, response, body) {
    console.log(error, body)
  }
)

// 第五關：刪掉 id:23 書本
request(
  'https://lidemy-http-challenge.herokuapp.com/lv5?token={HarukiMurakami}',
  function (error, response, body) {
    console.log(body)
  }
)

request.delete(
  'https://lidemy-http-challenge.herokuapp.com/api/books/23',
  function (error, response, body) {
    console.log(error, body)
    console.log(response.statusCode)
  }
)

// 第六關：登入系統
request(
  'https://lidemy-http-challenge.herokuapp.com/lv6?token={CHICKENCUTLET}&email=lib@lidemy.com',
  function (error, response, body) {
    console.log(body)
  }
)

const options = {
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/me',
  headers: {
    "Authorization": "Basic YWRtaW46YWRtaW4xMjM=",
  }
};

function callback(error, response, body) {
  console.log(error, body)
}

request(options, callback);

// 第七關： 刪除 id: 89 的書本

request(
  'https://lidemy-http-challenge.herokuapp.com/lv7?token={SECurityIsImPORTant}&hint=1',
  function (error, response, body) {
    console.log(body)
  }
)

const options = {
  method: 'DELETE',
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/books/89',
  headers: {
    "Authorization": "Basic YWRtaW46YWRtaW4xMjM=",
  }
};

function callback(error, response, body) {
  console.log(error, body)
}

request(options, callback);

// 第八關： 更新 ISBN 最後一碼
request(
  'https://lidemy-http-challenge.herokuapp.com/lv8?token={HsifnAerok}',
  function (error, response, body) {
    console.log(body)
  }
)

// 找出書名有 「我」這個字的書
const options = {
  url: `https://lidemy-http-challenge.herokuapp.com/api/v2/books?q=${encodeURI('我')}`,
  headers: {
    "Authorization": "Basic YWRtaW46YWRtaW4xMjM=",
  }
};

function callback(error, response, body) {
  console.log(error, body)
}

request(options, callback);

// 更新 ISBN 最後一碼
const options = {
  method: 'PATCH',
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/books/72',
  headers: {
    "Authorization": "Basic YWRtaW46YWRtaW4xMjM=",
  },
  form: {
    name: '日日好日：茶道教我的幸福15味【電影書腰版】',
    ISBN: '9981835423'
  } 
};

function callback(error, response, body) {
  console.log(error, body)
}

request(options, callback);

// 第九關：
request(
  'https://lidemy-http-challenge.herokuapp.com/lv9?token={NeuN}&version=1A4938Jl7',
  function (error, response, body) {
    console.log(body)
  }
)

// 獲取系統資訊
const options = {
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/sys_info',
  headers: {
    "Authorization": "Basic YWRtaW46YWRtaW4xMjM=",
    "X-Library-Number": 20,
    "User-Agent": "Mozilla/4.0 (compatible; U; MSIE 6.0; Windows NT 5.1)"
  }
};

function callback(error, response, body) {
  console.log(error, body)
}

request(options, callback);


request(
  'https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}',
  function (error, response, body) {
    console.log(body)
  }
)

request(
  'https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}&num=9613',
  function (error, response, body) {
    console.log(body)
  }
)
