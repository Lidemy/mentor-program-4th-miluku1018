## 什麼是 Ajax？
* 非同步 JavaScript 及 XML（Asynchronous JavaScript and XML，AJAX） 並不能稱做是種「技術」，而是 2005 年時由 Jesse James Garrett 所發明的術語，描述一種使用數個既有技術的「新」方法。這些技術包括 HTML 或 XHTML、層疊樣式表、JavaScript、文件物件模型、XML、XSLT 以及最重要的 XMLHttpRequest 物件。
當這些技術被結合在 Ajax 模型中，Web 應用程式便能快速、即時更動介面及內容，不需要重新讀取整個網頁，讓程式更快回應使用者的操作。

參考來源：https://ithelp.ithome.com.tw/articles/10200409

## 用 Ajax 與我們用表單送出資料的差別在哪？
* 用表單送出資料：發 request 到 server，當 server 把 response 拿回來之後， 瀏覽器會直接 render response -> 新的頁面（也就是會換頁的意思）。跟 JavaScript 無關。
* 用 Ajax 傳送資料：透過 JavaScript 交換資料，不用換頁，非同步跟伺服器交換資料的技術。當 server 把 response 拿回來之後， 瀏覽器會把 response 給 JavaScript。
* 兩者的差異在於 會不會換頁。

## JSONP 是什麼？
* JSONP（JSON with Padding）是資料格式 JSON 的一種“使用模式”，可以讓網頁從別的網域要資料。不受同源政策限制。例如說<script>這個 Tag，我們不是常常引用 CDN 或是 Google Analytics 之類的第三方套件嗎？網址都是其他 Domain 的，但是卻能正常載入。 JSONP 就是利用<script>的這個特性來達成跨來源請求的。

參考來源：https://blog.techbridge.cc/2017/05/20/api-ajax-cors-and-jsonp/

## 要如何存取跨網域的 API？
1. 最標準、正確的解決方法是透過 W3C 規範 的「跨來源資源共用（Cross-Origin Resource Sharing，CORS）」，透過 伺服器在 HTTP Header 的設定，讓瀏覽器能取得不同來源的資源。伺服器端需要在回應的 Header 加上如 Access-Control-Allow-Origin、Access-Control-Request-Method、Access-Control-Request-Headers 等設定，限制伺服器能接受的來源、使用的方法、可攜帶的 Header 等等。
2. 或者使用 JSONP，也就是透過 HTML 中沒有跨域限制的標籤如 img、script 等，再藉由指定 callback 函式，將回應內容接回 JavaScript 中。

參考資料：https://medium.com/schaoss-blog/%E5%89%8D%E7%AB%AF%E4%B8%89%E5%8D%81-22-fe-%E7%82%BA%E4%BB%80%E9%BA%BC%E8%B7%A8%E5%9F%9F%E8%AB%8B%E6%B1%82%E6%9C%83%E7%94%A2%E7%94%9F%E9%8C%AF%E8%AA%A4-%E5%A6%82%E4%BD%95%E8%99%95%E7%90%86-a2145e141d51

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
* 第四週是使用 Node.js 透過電腦發 request 給 server，而 server 回傳 response 給電腦。但是，這週是透過瀏覽器發 request 到 server ，瀏覽器會限制你做某些事情，收到 request 會幫你加一些東西...瀏覽器版本＆ 額外資訊等。
* 當開發者透過 JavaScript 針對不同於當前位置的來源發送請求，這個請求的回應就會被瀏覽器攔截掉，不交給 JavaScript 處理。這邊的「不同來源」，指的是目標資源與當前網頁的網域（domain）、通訊協定（protocol）或通訊埠（port）只要有任一項不同，就算是不同來源。

參考來源：https://medium.com/schaoss-blog/%E5%89%8D%E7%AB%AF%E4%B8%89%E5%8D%81-22-fe-%E7%82%BA%E4%BB%80%E9%BA%BC%E8%B7%A8%E5%9F%9F%E8%AB%8B%E6%B1%82%E6%9C%83%E7%94%A2%E7%94%9F%E9%8C%AF%E8%AA%A4-%E5%A6%82%E4%BD%95%E8%99%95%E7%90%86-a2145e141d51
