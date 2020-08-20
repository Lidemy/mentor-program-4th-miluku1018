## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
* 加密 Encryption：如果駭客知道你用什麼演算法，就有機會破解加密，導致密碼外洩。加密可以解密，不安全。一對一的關係，一組加密對應一組密碼。
* 雜湊 Hash：雜湊密碼無法還原，密碼經過雜湊就看不到原本的密碼，就算被駭入資料庫，也看不到真正的密碼。多對一的關係，有機率兩個密碼對應到同一組雜湊文字，叫做碰撞。

## `include`、`require`、`include_once`、`require_once` 的差別
* 使用 include 語句可以告訴 PHP 提取特定檔案，並在入全部內容。
* 每次使用 include 語句時，都會重新將請求的檔案匯入，即使這個檔案已經被匯入過。而 include_once 語句可以避免重複引入。
* 使用 include 和 include_once 語句的淺在問題是：PHP 只會試圖匯入被請求匯入的檔案，即使該檔案沒有被找到，程式依舊會執行。當我們絕對需要匯入一個檔案時，使用 require 或者 require_once。而 require_once 可以避免重複引入。

資料來源：https://codertw.com/%E7%A8%8B%E5%BC%8F%E8%AA%9E%E8%A8%80/213553/

## 請說明 SQL Injection 的攻擊原理以及防範方法
* 在輸入的字串中夾帶 SQL 指令，在設計不良的程式當中忽略了字元檢查，那麼這些夾帶進去的惡意指令，就會被資料庫伺服器誤認為是正常的 SQL 指令而執行，因此，遭到破壞或者入侵。

* 在 PHP 可以使用 prepared statement，防範 SQL injection。

##  請說明 XSS 的攻擊原理以及防範方法
* 跨網站指令碼攻擊，可以在別人的網站插入 JavaScript 語法，可以引導別人的網站到釣魚網站，例如：location.href=“xxxx” 轉址到釣魚網站。或者可以使用 window.cookie，取得別人的 session id，可以把別人的身份偷走。
* 解決方式：php htmlspecialchars，把特殊文字轉為 HTML實體，解析為純文字格式。

## 請說明 CSRF 的攻擊原理以及防範方法
* 用戶登錄原網站，瀏覽器會紀錄 Cookies，如果用戶未登出或 Cookies 並未過期（用戶關閉瀏覽不代表網站已登出或 Cookies 會立即過期）。在這期間，如果用戶造訪其他危險網站，點擊了攻擊者的連結，便會向原網站發出某個功能請求，原網站的伺服器接收後會被誤會以為是用戶合法操作。

* 使用者的防範方法：CSRF 攻擊之所以能成立，是因為使用者在被攻擊的網頁是處於已經登入的狀態，所以才能做出一些行為，因此，離開網站前，記得要先登出，就可以避免 CSRF。

* Server 的防範方法：
1. 檢查 Referer: request 的 header 裡面會帶一個欄位叫做 referer，代表這個 request 是從哪個地方過來的，可以檢查這個欄位看是不是合法的 domain，不是的話直接 reject 掉即可。
2. 加上圖形驗證碼或簡訊驗證碼：就像網路銀行轉帳時，都會要求你收簡訊驗證碼，多了這一道檢查就可以確保不會被 CSRF 攻擊。
3. 加上 CSRF token: 要防止 CSRF 攻擊，只要確保有些資訊「只有使用者知道」即可。在 form 加一個隱藏欄位叫做 csrftoken，這裡面的值由 server 隨機產生，並且存在 server 的 session 中。當送出表單時，server 比對表單中的 csrftoken 與自己 session 裡面存的是不是一樣的，是的話，就代表是本人發出的 request。
4. Double Submit Cookie: 由 server 產生一組隨機的 token 並且加在 form 上面，同時，也讓 client side 設定一個名叫 csrftoken 的 cookie，值也是同一組 token。當使用者送出表單時， server 比對 cookie 內的 csrftoken 與 form 裡面的 csrftoken，檢查是否有值並且相等，就知道是不是使用者發出的。

參考資料：https://blog.techbridge.cc/2017/02/25/csrf-introduction/
參考資料：https://medium.com/@bigboys.me/%E7%B0%A1%E8%BF%B0-csrf-%E6%94%BB%E6%93%8A%E6%98%AF%E4%BB%80%E9%BA%BC-78bb95d8ca7d