function capitalize(str) {
  let code = str[0].charCodeAt(0)
  let string = ''
  if (code >= 'a'.charCodeAt(0) && code <= 'z'.charCodeAt(0)) {
    str1 = String.fromCharCode(code - 32)
    for (var i = 1; i < str.length; i++){
      string += str[i]
    }
    return str1 + string
  }else {
    return str
  }
}

console.log(capitalize(',hello'));
console.log(capitalize('nick'));
console.log(capitalize('Nick'));
