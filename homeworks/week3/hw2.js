function digitsCount(num) {
  let result = 0;
  let num1 = num;
  while (num1 !== 0) {
    num1 = Math.floor(num1 / 10);
    result += 1;
  }
  return result;
}

function isNarcissistic(n) {
  let m = n;
  const digits = digitsCount(m);
  let sum = 0;
  while (m !== 0) {
    const num = m % 10;
    sum += num ** digits;
    m = Math.floor(m / 10);
  }
  return sum === n;
}

function solve(lines) {
  const temp = lines[0].split(' ');
  const n = Number(temp[0]);
  const m = Number(temp[1]);
  for (let i = n; i <= m; i += 1) {
    if (isNarcissistic(i)) {
      console.log(i);
    }
  }
}

solve(['5 200']);
