### Event Loop

console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)

1. 執行 console.log(1) => 印出 1
2. setTimeout 表示延遲某段時間後，才執行「一次」指定的程式碼，因此，先被丟到佇列（Queue）等待
3. 執行 console.log(3) => 印出 3
4. 同第二步驟，先被丟到佇列（Queue）等待
5. 執行 console.log(5) => 印出 5
6. 被丟到佇列的，等待堆疊(Stack)清空後，將佇列的程式碼，移到堆疊，執行 console.log(2) => 印出 2
7. 同第六步驟，執行 console.log(4) => 印出 4


