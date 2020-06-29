function capitalize(str) {
  for (var i = 0; i < str.length; i++){
    let code = str.charCodeAt(0)
    let string = ''
    if (code >= 'A' &&  code <= 'Z') {
      str[0] = String.fromCharCode(code - 32)
      return string += str[i]
    } else if (code >= 'a' && code <= 'z') {
      str[0] = String.fromCharCode(code + 32)
      return string += str[i]
    }else {
      return str
    }
  }
}

console.log(capitalize('hello'));
