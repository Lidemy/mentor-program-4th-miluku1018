## 什麼是 DOM？
* DOM 就是將文件(Document)，變成物件(Object)，而 Document 如何讓 JavaScript 可以改到 HTML 的介面，就是透過 Document 的物件，可以拿到需要的節點/元素，針對節點/元素做改變。瀏覽器提供橋樑 DOM ，讓 JavaScript 可以改變畫面上的東西。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
* 事件傳遞機制的順序是先捕獲，再冒泡。但是，當事件傳遞到 target 本身，就沒有分捕獲跟冒泡。瀏覽器的事件傳遞過程，分成三個階段：
1. 捕獲階段（Capturing phase）：由 DOM 樹的最外層依序向內，過程中觸發個別元素的捕獲階段事件監聽。
2. 目標階段（Target phase）：到達事件目標，依照註冊順序觸發事件監聽。
3. 冒泡階段（Bubbling phase）：由事件目標依序向外，過程中觸發個別元素的冒泡階段事件監聽。

參考資料：https://medium.com/schaoss-blog/%E4%BB%80%E9%BA%BC%E6%8D%95%E7%8D%B2%E5%86%92%E6%B3%A1-%E4%BD%A0%E6%98%AF%E9%AD%9A%E5%97%8E-%E8%81%8A%E8%81%8A%E7%80%8F%E8%A6%BD%E5%99%A8-dom-%E7%9A%84%E4%BA%8B%E4%BB%B6%E5%82%B3%E9%81%9E-b44454690661
## 什麼是 event delegation，為什麼我們需要它？
* 過多重複的監聽器 — 10*10的按鈕 掛載一百個重複的click事件。如何將事件委派，由事件的冒泡機制，把子節點們的事件統一處理，達成減少監聽數目的方法。
* 或者說在同一個 div 底下，新增節點，導致沒有被監聽到，那就將事件監聽改由最外層來監聽，就可以解決新增節點沒有被監聽到的問題。


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
* event.preventDefault() 是在取消事件的預設行為，不影響事件傳遞。例如：以「超連結」為例，瀏覽器看到頁面上有超連結，只要偵測到超連結被點擊到，隨即會幫我做「導向連結」的動作，「導向連結」即是超連結的預設行為。如果我們在超連結元素上的 click 事件，使用了 event.preventDefault()，當我點擊超連結時，就不會進行導向連結的動作。
* event.stopPropagation() 方法可阻止當前事件繼續進行捕捉（capturing）及冒泡（bubbling）階段的傳遞。 假設現在有一個按鈕 btn，被包在一層 inner，而 inner 外層再一層 outer。開啟冒泡機制，當按下按鈕時，往上冒泡，btn 冒泡 -> inner 冒泡 -> outer 冒泡。如果在 btn 設定 event.stopPropagation()，當按下按鈕時，只會產生 btn 冒泡，事件就不會進行傳遞，也就是不會觸發 inner 冒泡 ＆ outer 冒泡。