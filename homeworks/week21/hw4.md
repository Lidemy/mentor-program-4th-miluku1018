## 為什麼我們需要 React？可以不用嗎？

React 是一套 JavaScript Library，專門用來寫 User Interfaces(UI) 用的，也就是 MVC 的 View 部分。是否要使用 React，主要是依照專案大小的需求而定，是可以不一定要用 React 的，你也可以用 jQuery。

**React 核心概念**

1. Component-Based：React 最小的單位就是 component，在 React 中所有的東西或介面都是由元件所組成。
2. Declarative UI / JSX：React 使用宣告式(declarative)的方法來描述 UI，你負責宣告描述當資料（data）在哪些不同的狀態下，介面應該分別長什麼樣子，而當資料發生變動時，React 會自動化協調畫面的更新。另外，提供 JSX 語法，是一種跟 HTML 相似的語法，用來讓你方便地寫 UI 元件。
3. 單向資料流(Unidirectional data flow)：React 的資料架構設計概念是採「單向資料流」，資料的流向只能從父元件傳入子元件（top-down），而資料改變時會牽動 UI 自動改變，每當 React 偵測到 props 或 state 有更新時，就會自動重繪整個 UI 元件。這是 React 一個核心的概念，畫面的改變是由改變資料來驅動，React 元件的狀態，就像一個有限狀態機，所以可以確定一個元件在某個資料狀態下的畫面一定會是長什麼樣子(predictable);而不像傳統妳直接寫 JavaScript（或像是用 jQuery）來分別維護資料和畫面的一致性，當介面很複雜時，很容易造成資料和畫面不同步，也容易有 bug。
4. Virtual Dom：一般網頁開發中，更新 DOM 是最耗費瀏覽器資源的動作之一，每當有大量的 DOM 操作時，非常容易造成效能的瓶頸，所以 React 引進了一套出名的機制及功能- Virtual Dom。React 在記憶體中自己維護一個跟 DOM 一樣的樹結構（in-memory data structure cache），每當資料（props/state）有更新時，React 首先會去用自己的一套 diff 演算法去算出哪些 DOM 元素有改變需要做更新， 接著才會實際去操作真實的 DOM，簡單的說 Virtual DOM 目的是最小化 DOM 操作，以便達到效能的最佳化。

參考資料：https://www.fooish.com/reactjs/

## React 的思考模式跟以前的思考模式有什麼不一樣？

以前的思考模式是我要怎麼操作到那個元素，就是操作 DOM 上的節點，而 React 的思考模式，是只要管資料，就會自動把 UI render 出來，也就是說我只要操作到那個元素的資料，UI 就會跟著改變。

## state 跟 props 的差別在哪裡？

React 元件彼此之間的溝通，只能透過從父元件將資料傳進去子元件的方式來做資料的傳遞，也就是透過 props，而 props 是唯讀的(immutable values)，這表示你不能改動 props 傳進來的資料，不可變的。

有時候元件的資料不一定是從父元件傳進來的，例如可能是來自於自身介面中因使用者互動過程產生的資料，像是填寫表單，這時則是使用 React 所謂的 State，元件可以透過更新自身維護的 state 資料來改變元件的狀態，而 state 也可以用來當作 props 的內容傳給子元件。也就是說 state 是元件自己管理資料，控制自己的狀態，可變的。

參考資料：https://www.fooish.com/reactjs/
