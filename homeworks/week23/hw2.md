## 為什麼我們需要 Redux？

管理狀態一直是開發上的難題之一，尤其在前端那麼多狀態共存的情況下，怎麼優雅地管理狀態就是一大問題，到底管理狀態難在哪？

- 狀態容易被意外地改變，導致不好預測。
- 狀態可能被多個元件共享，如果想要在不同元件間共享狀態就要層層傳遞 prop。
- 在元件內撰寫改變狀態的邏輯，很容易讓元件變得臃腫肥大。
- 如果要做非同步的行為，像是 call API，read file 等等，再搭配改變狀態的邏輯，全部寫在元件當中會相當不容易管理。
- 在狀態改變時，我們希望通知所有監聽此狀態的元件或邏輯。
- 當你按下 View 按鈕，你可能會改到不同 Model 的資料。因此，當你想知道 Model 改變的來源是哪一個 View，是很難去追蹤到的。State 變得過於複雜。這也就是為什麼需要 Redux 來管理狀態。

[資料參考](https://ithelp.ithome.com.tw/articles/10224391)

## Redux 是什麼？可以簡介一下 Redux 的各個元件跟資料流嗎？

- Redux 是一套狀態管理方式，也就是管理資料, 畫面, UI 之間的對應關係。
- Action：描述實際發生什麼事的一般物件。從你的應用程式傳遞資料到你的 store 的資訊 payload。它們是 store 唯一的資訊來源，你藉由 store.dispatch() 來把它們傳遞到 store。
- Reducer：根據 action 更新 state
  - 設計 State 的形狀：在 Redux 中，所有的應用程式 state 被儲存為一個單一物件，在撰寫任何程式碼之前先思考它的形狀。
  - 處理 Action：現在我們已經決定 state 物件要長什麼樣子。而 Reducer 是一個 pure function，它接收先前的 state 和一個 action，然後回傳下一個 state。讓 Reducer 保持 pure 非常重要。你永遠不應該在 Reducer 裡面做這事：
    - 改變它的參數
    - 執行有 side effect 的動作，像是呼叫 API 和 routing 轉換
    - 呼叫不是 pure 的 function，像是 Date.now() 或者是 Math.random()
- Store：把它們結合在一起的物件
  - 掌管應用程式的狀態
  - 允許藉由 getState() 獲取 state
  - 允許藉由 dispatch(action) 來更新 state
  - 藉由 subscribe(listener) 註冊 listener
  - 藉由 subscribe(listener) 回傳的 function 處理撤銷 listener
- 資料流：Redux 架構圍繞著嚴格的單向資料流。這意味著應用程式中的全部資料都遵照一樣的生命週期模式，讓應用程式的邏輯更容易預測與了解。它鼓勵資料正規化，這樣你就不會落得同份資料的多個獨立複製都互相不知道彼此的下場。
  - 任何 Redux 應用程式中資料聲明週期都遵照這 4 個步驟：
    - 呼叫 store.dispatch(action)。
    - Redux store 呼叫你給它的 reducer function。store 會傳遞兩個參數到 reducer，現在的 state tree 和 action。
    - root reducer 可以把多個 reducer 的 output 合併成一個單一的 state tree。要如何建構 root reducer 完全取決於你。Redux 附帶一個 combineReducers() helper function，用於把 root reducer 「拆分」成數個獨立 function，個別管理 state tree 的一個分支。
    - Redux store 儲存 root reducer 回傳的完整 state tree。現在，UI 可以被更新來反應新的 state。

[參考資料](https://chentsulin.github.io/redux/docs/basics/Actions.html)

## 該怎麼把 React 跟 Redux 串起來？

- React 跟 Redux 是沒有關係的，Redux 支援 react, angular, jQuery 甚至 JavaScript。
- react-redux 能夠使你的 React 元件，從 Redux store 中很方便的讀取資料，並且向 store 中分發 actions 更新資料。
- React-Redux 中兩個最重要的成員
  - Provider 使整個 app 都能夠獲取到 store 中的資料
    - 包在元件的最外層，使所有的子元件都可以拿到 state
    - 接收 store 作為 props，通過 context 往下傳遞，這樣 react 中任何元件都可以通過 context 獲取到 store
    - 解決了 container components 可能存在很深的層級，防止一層一層去傳遞 state
  - Connect 這個方法能夠使元件跟 store 來進行關聯
    - Provider 內部元件如果想要使用到 state 中的資料，就必須要 connect 進行一層包裹封裝
    - connect 就是方便元件能夠獲取到 store 中的 state

[參考資料](https://www.mdeditor.tw/pl/pENO/zh-tw)
