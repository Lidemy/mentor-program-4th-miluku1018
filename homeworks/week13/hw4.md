## Webpack 是做什麼用的？可以不用它嗎？
* Webpack 是 JavaScript 的模組建置工具，運行在 Node.js 上，它可以將零散的 JavaScript 檔案用各式工具優化並打包起來，加快網頁的載入時間。Webpack 也並不限於用在 JavaScript 上，舉凡網頁有用到的靜態資源(如JS、CSS、圖片檔等)，甚至是HTML網頁，Webpack 都有辦法打包，也可以說是前端打包工具。

* 透過解析模組之間的相依關係，可以
  - 把專案中 js、css、和其他靜態 assets 打包到同一個檔案中
  - 將不同頁面／模組的程式碼分離（code splitting)
  - 透過 loader system，轉換／編譯 Sass、Babel、TypeScript 甚至圖片等不同檔案 （多數情況下能取代 Gulp、Grunt 等工具）
  - 運用不同的 Plugins，組合出適合自己的 Webpack 流程與設定。

* 如果不使用 Webpack 的話，會有以下問題：
1. 第一個問題，瀏覽器支援度。其實這個問題說大不大說小不小，端看貴公司有沒有要支援 IE，因為各大瀏覽器都有支援 import 與 export，可是 IE 沒有。
2. 第二個問題，我想要使用 npm 上面其他人寫的套件的話怎麼辦？這個問題其實是相當麻煩的，因為在開發時通常都會用到其他人寫好的模組，若是沒辦法很方便地去支援引入這些模組，會造成很多不便利。
就是因為瀏覽器原生的模組機制會碰到許多問題（相容性、無法兼容 npm 等等），所以我們才需要一個額外的工具，如： webpack。

參考資料：[https://weihanglo.tw/posts/2017/fed-toolchain/#自動化工具-打包工具](https://weihanglo.tw/posts/2017/fed-toolchain/#%E8%87%AA%E5%8B%95%E5%8C%96%E5%B7%A5%E5%85%B7-%E6%89%93%E5%8C%85%E5%B7%A5%E5%85%B7)
參考資料：[https://blog.huli.tw/2020/01/21/webpack-newbie-tutorial/](https://blog.huli.tw/2020/01/21/webpack-newbie-tutorial/)

## gulp 跟 webpack 有什麼不一樣？
### gulp
- task manager，管理任務工具，可以用在更多元的地方，只是我們主要用來做資源的轉換。
- 自動化和優化你的工作流，它是一個自動化你開發工作中，痛苦又耗時任務的工具包。
- 每一個任務內容可以自訂，例如：babel task/ scss task/ rename task/ minify task。
- 本身無法做 bundle，但有 webpack plugin 可以用來打包。

### webpack
- module bundler 模組打包工具， 它可以將許多鬆散的模組按照依賴和規則打包成符合生產環境部署的前端資源。還可以將按需載入的模組進行程式碼分割，等到實際需要的時候再非同步載入。
- 打包資源前，先由 loader 將 資源載入 webpack，例如：JavaScript 先經過 babel loader 編譯後，再包入 webpack。
- webpack 有一些 task 是做不到的，例如：校正時間。

## CSS Selector 權重的計算方式為何？
- 權重指的是 css 的優先權，而在相同權重情況下，後寫的 css 可以覆蓋先寫的 css，而越詳細的越贏，權重越高，也就優先生效。
- !important > inlinestyle > id > class > tag ：最左邊的權重最高，最右邊的權重最低。
- 簡單介紹權重：
1.  * -米字，很常用到的全站預設值，為 0-0-0-0，所以只要權重超過就可以覆蓋過它的預設。
2. element**:** 所有的 Element 的權重都是 0-0-0-1，例如：div, p, ul, ol, li, em, header, footer, article。
3. class: 每一個 class 的權重都是 0-0-1-0。
4. id: 每一個 id 的權重都是 0-1-0-0。
5. inline style attribute 就是寫在 html 行內的 style，inline style attribute 的權重為 1-0-0-0 。
6. !important 的權重非常高，可以蓋過所有的權重，沒事不要亂用。

參考資料：[https://ithelp.ithome.com.tw/articles/10196454](https://ithelp.ithome.com.tw/articles/10196454)
