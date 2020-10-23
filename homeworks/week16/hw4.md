```
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ?? 
obj2.hello() // ?? 
hello() // ?? 
```
輸出 2 2 undefined

1. obj.inner.hello() = obj.inner.hello.call(obj.inner)，obj.inner.value 的值等於 2，call 的第一個參數為 hello 前面的東西，也就是 obj.inner
2. obj2.hello() =  obj.inner.hello() = obj.inner.hello.call(obj.inner)，同第一題，答案是 2
3. hello() = hello.call(undefined)，答案是 undefined，因為 hello 前面沒有東西，所以，call 的參數只能放 undefined

