## 請簡單解釋什麼是 Single Page Application
* 單頁應用：是一種網路應用程式或網站的模型，它通過動態重寫當前頁面來與用戶互動，而非傳統的從伺服器重新載入整個新頁面。這種方法避免了頁面之間切換打斷用戶體驗，使應用程式更像一個桌面應用程式。經典例子：當你使用 Gmail 的時候，完全沒有換頁，全部的動作都是在「同一個頁面」上發生的。

[參考來源](https://blog.techbridge.cc/2017/09/16/frontend-backend-mvc/)

## SPA 的優缺點為何
* 優點：當你在使用音樂網站時，可以同時聽歌，又可以同時邊看看網站上其他的資料，例如：歌手介紹、專輯介紹。可以增進使用者體驗，讓使用者覺得做更順暢。
* 缺點：需要仰賴前端下載大量 JavaScript 檔案，隨後才計算、渲染畫面，造成第一畫面需要較長的反應時間，在性能較差的行動裝置更是如此。且爬蟲只能看到 JavaScript 的空殼 HTML，所以搜尋引擎無法抓到任何資料。


[參考來源](https://blog.techbridge.cc/2017/09/16/frontend-backend-mvc/)
[參考來源](https://medium.com/schaoss-blog/%E5%89%8D%E7%AB%AF%E4%B8%89%E5%8D%81-18-fe-%E7%82%BA%E4%BB%80%E9%BA%BC%E7%B6%B2%E7%AB%99%E8%A6%81%E5%81%9A%E6%88%90-spa-ssr-%E7%9A%84%E5%84%AA%E9%BB%9E%E6%98%AF%E4%BB%80%E9%BA%BC-c926145078a4)

## 這週這種後端負責提供只輸出資料的 API，前端一律都用 Ajax 串接的寫法，跟之前透過 PHP 直接輸出內容的留言板有什麼不同？
* Server-side render
   - 把資料拿出來
   - 把資料跟 HTML 結合（UI）在一起
   - 回傳 HTML
   - browser render: 留言板
   - 在 server-side 就把資料跟 UI 綁在一起，所以，browser 看到什麼，就是什麼
   - 一拿到 response 就有資料，也就是說搜尋引擎可以正常抓到資料。
 ---
* Client-side render
  -  API => 把資料拿出來/ 變成某種格式(JSON)/ 回傳 
  -  API 純資料，不會有跟介面相關的任何東西
  -  後端只負責回傳資料，前端負責用 JavaScript render，代表 browser 看到的 HTML 會是空的。當載入 HTML後，才執行 JavaScript，而 JavaScript 再去後端拿資料，拿完資料在用 JavaScript 動態產生內容上去。
  -  一拿到 response 就是空的，需要執行完 JavaScript 後，才有資料。而空的 HTML，會讓搜尋引擎拿不到資料。
--- 