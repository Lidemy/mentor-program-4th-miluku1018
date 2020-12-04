## 請列出 React 內建的所有 hook，並大概講解功能是什麼

- useState：讓 function component 擁有 state ，去管理內部的狀態。
  - 回傳一個 state 的值，以及更新 state 的 function。 在首次 render 時，回傳的 state 的值，會跟第一個參數（initialState）一樣。
  - setState function 是用來更新 state。它接收一個新的 state 並將 component 的重新 render 排進隊列。

```jsx
const [state, setState] = useState(initialState);

setState(newState);

在後續的重新 render，useState 回傳的第一個值必定會是最後更新的 state。
```

- useEffect：你要執行什麼事情的時候，通常都寫在 useEffect 或者 EventHandler，通常不會寫在其他地方，因為其他地方是 render 就會執行的，但是，你通常不會想每次都 render，而且通常都是等到 render 完才做什麼事，才不會阻礙 render 進行，導致效率變差。
  - 在預設情況下，effect 會在每一個完整 render 後執行，但你也可以選擇它們在某些值改變的時候才執行。
  - 清除一個 effect：清除 function 會在 component 從 UI 被移除前執行，來防止 memory leak。此外，如果 component render 數次，在執行下一個 effect 前，上一個 effect 就已經被清除。

```jsx
useEffect(() => {
  const subscription = props.source.subscribe();
  return () => {
    // clean up the subscription
    subscription.unsubscribe();
  };
});
```

- useLayoutEffect：與宣告 useEffect 本身相同，但它會在所有 DOM 改變後，同步調用。使用它來讀取 DOM layout 並同步重新 render。在瀏覽器執行繪製前，useLayoutEffect 內部的更新將被同步刷新。盡可能使用標準的 useEffect 來避免阻礙視覺上的更新。
  - useEffect 是在 Browser paint 後，useLayoutEffect 是在 Browser paint 前。
  - 使用 useLayoutEffect 就可以直接看到我們想要顯示的畫面，而不會出現初始畫面。
- useMemo：用一個 function 把想要的值，回傳回來。回傳一個 memoized 的值。傳遞第一個參數 function 及第二個參數 依賴 array。useMemo 只會在依賴改變時才重新計算 memoized 的值。這個最佳化可以避免在每次 render 都進行昂貴的計算。
  - 要謹記傳到 useMomo 的 function 會在 render 期間執行。不要做一些通常不會在 render 期間做的事情。例如：處理 side effect 屬於 useEffect，而不是 useMemo。

```jsx
const memoizeValue = useMemo() => ComputeExpensiveValue(a, b), [a, b])
```

- useCallback：背後就是用 useRef 來做的，useRef 在不同 render 之間，保留一樣的東西。
- useRef：useRef 回傳一個 mutable 的 ref object，.current 屬性被初始為傳入的參數（initialValue）。 回傳的 object 在 component 的生命週期將保持不變。

```jsx
const refContainer = useRef(initialValue);
```

- useContext：解決 prop drilling 問題。接收一個 context object (React.createContext 的回傳值) 並回傳該 context 目前的值。Context 目前的值是取決於由上層 component 距離最近的 <MyContext.Provider> 的 value prop。當 component 上層最近的 <MyContext.Provider> 更新時，該 hook 會觸發重新 render，並使用最近傳遞到 MyContext 的 context value 傳送到 MyContext provider。

```jsx
const value = useContext(MyContext);
```

## 請列出 class component 的所有 lifecycle 的 method，並大概解釋觸發的時機點

**常用 method**

- constructor：如果你沒有初始化 state 也不綁定方法的話，你的 React component 就不需要 constructor。一個 React component 的 constructor 會在其被 mount 之前被呼叫。
- 透過指定一個 this.state 物件來初始化內部 state
- 為 event handler 方法綁定 instance
- 不可在 constructor() 中呼叫 setSatate()。如果你的 component 需要使用內部 state，請在 constructor 中將其最初的 state 指定為 this.state
- render：class component 中唯一必要的方法。當 render 被呼叫時，它將會檢視 this.props 和 this.state 中的變化，並回傳以下類別之一：
- React element。通常是透過 JSX 建立的。例如，<div /> 和 <MyComponent /> 這兩個 React element 會告訴 React 要 render 一個 DOM node 和一個使用者定義的 component。
- Array 和 fragment。它們會從 render 中回傳數個 element。
- Portal。它們會讓你將 children render 到不同的 DOM subtree 中。
- String 和 number。這些 DOM 中將會被 render 為文字 node。
- Boolean 或 null。什麼都不 render。
- componentDidMount：在一個 component 被 mount （加入 DOM tree 中）後，componentDidMount() 會馬上被呼叫。需要 DOM node 的初始化應該寫在這個方法裡面。
- 如果你需要從端端終端點（remote endpoint）請求資料的話，此處非常適合進行實例化網路請求（network request）
- componentDidUpdate：會再更新後馬上被呼叫。這個方法並不會在初次 render 時被呼叫。此處也適合做網路請求，如果你有比較目前的 prop 和之前的 prop 的話（如果 prop 沒有改變的話，網路請求可能並非必要）
- 可以馬上在 componentDidUpdate() 呼叫 setState()，但注意這必須要被包圍在一個類似以下範例的條件語句內，否則你會進入一個無限迴圈。

```
componentDidUpdate(prevProps) {
// 常見用法（別忘了比較 prop）
	if (this.props.userID !== this.props.userID) {
	this.fetchData(this.props.userID)
	}
}
```

- componentWillUnmount：會在一個 component 被 unmount 和 destroy 後馬上被呼叫。你可以在這個方法內進行任何清理，像是取消計時器和網路請求或是移除任何在 componentDidMount() 內建立的 subscription。

**不常用 method**

- shouldComponentUpdate：React 的預設行為是每次改變 state，就會重新 render。其預設值為 true。如果回傳 false 的話，UNSAFE_componentWillUpdate(), render(), componentDidUpdate() 都不會被呼叫。
- static getDerivedStateFromProps：會在一個 component 被 render 前被呼叫，不管是在首次 mount 時或後續的更新時。它應該回傳一個 object 以更新 state，或回傳 null 以表示不需要更新任何 state。
- getSnapshotBeforeUpdate：會在最近一次 render 的 output 被提交給 DOM 時被呼叫。它讓你在 DOM 改變之前先從其中抓取一些資訊（例如滾動軸的位置）。這個生命週期方法回傳的值會被當作一個參數傳遞給 componentDidUpdate()。

**過時的 method**

- UNSAFE_componentWillMount：會在 mounting 發生前被呼叫。它會在 render() 前被呼叫，因此在這個方法內同步呼叫 setState() 並不會觸發額外的 render。不過，一般情況來說，建議使用 constructor() 來初始化 state。
- UNSAFE_componentWillReceiveProps：會在一個被 mount 的 component 接收新的 prop 前被呼叫。如果你需要在某個 prop 改變時更新 state 的話，你可以在這個裡面比較 this.props 和 nextProps，並使用 this.setState() 進行 state 轉移。
- UNSAFE_componentWillUpdate：會在 render 發生之前、當新的 prop 或 state 正在被接收時，被呼叫。為更新發生之前做準備個一個機會。此方法並不會在初次 render 時被呼叫。

## 請問 class component 與 function component 的差別是什麼？

- 語法：function compoent 語法更簡單，只需要傳入一個 props 參數，而 props 會一直是原本傳進來的那個，而不會跟著更新，閉包的概念。class component 要求先繼承 React.component ，然後，必須定義 render 方法。每次都可以拿到最新的 this.props，因為 this 隨時都在變化
- state 狀態：function component 可以是箭頭函式或者一般函式，無法使用 this.state 和 setState()，也就是無狀態元件，但是，useState 出現後，就可以有 state 了。如果一個元件需要用到狀態的時候，要使用 class component。
- 生命週期：function component 不具有生命週期，因為所有的生命週期函數都來自 React.Component，但是，useEffect 出現後，就有生命週期了。當一個元件需要生命週期，就使用 class component。

參考資料：[https://medium.com/@Lieutenant1992/react-functional-component-v-s-class-component-e46c6dc5a319](https://medium.com/@Lieutenant1992/react-functional-component-v-s-class-component-e46c6dc5a319)

## uncontrolled 跟 controlled component 差在哪邊？要用的時候通常都是如何使用？

React 有兩個不同的方案處理表格輸入。

表格輸入 element 的值是由 React 來控制，就被稱為 controlled component。當用戶輸入數據到 controlled component，就會觸發一個 event handler，並且用你的代碼決定輸入是否有效（通過重新 render 更新後的數值）。如果你不重新 render，表格 element 將保持不變。

一個 uncontrolled component 就像表格 element 一樣在 React 以外工作。當用戶輸入數據到一個表格列（input, dropdown 等）時，不需要 React 處理任何東西，更新的數據就會被反映出來。

大多數情況下，使用 controlled components

參考資料：[https://zh-hant.reactjs.org/docs/glossary.html](https://zh-hant.reactjs.org/docs/glossary.html)
