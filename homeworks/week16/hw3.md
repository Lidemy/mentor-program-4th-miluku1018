### Hoisting
```
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```
輸出 undefined 5 6 20 1 10 100

1. 呼叫 fn，進入函式
2. fn function 一開始尚未定義 a ，第一個 a ＝ undefined
3. 接著 var a = 5，目前 a = 5，第二個 a = 5
4. 接著 a++ ，目前 a = 6
5. var a 只是宣告，沒有給值
6. 呼叫 fn2，進入函式
7. 由於 fn2 沒有宣告 a，往上一層找，第三個 a = 6
8. a = 20， 由於 fn2 沒有宣告 a，就往上一層找，fn 的 a = 20
9. 跳出 fn2 函式
10. 第四個 a = 20，因為第 8 步驟改變了 a 的值
11. 跳出 fn 函式
12. 第五個 a = 1， 因為，global a = 1
13. a = 10，改變 global a = 10
14. 因此，第六個 a = 10
15. 在 fn2 函式，由於沒有宣告 b 變數，因此，b 為全域變數，所以 b = 100
