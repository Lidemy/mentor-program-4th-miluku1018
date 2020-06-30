function join(arr, concatStr) {
  let str = ''
  for (var i = 0; i < arr.length - 1; i++) {
    str = str + arr[i] + concatStr
  }
  return str + arr[arr.length-1]
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
console.log(join(["a", "b", "c"], "!"))
console.log(join(["a", 1, "b", 2, "c", 3], ','))

