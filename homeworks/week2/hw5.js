function join(arr, concatStr) {
  let str = ''
  for (var i = 0; i < arr.length; i++) {
    str = str + arr[i] + concatStr
  }
  return str
}

function repeat(str, times) {
  let result = ''
  for (var i = 1; i <= times; i++) {
    result += str
  }
  return result
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
