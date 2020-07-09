function compare(a, b, k) {
  let x = a;
  let y = b;
  if (a === b) return 'DRAW';
  if (k === '-1') {
    const temp = x;
    x = y;
    y = temp;
  }
  const lengthA = x.length;
  const lengthB = y.length;

  if (lengthA !== lengthB) {
    return lengthA > lengthB ? 'A' : 'B';
  }
  return x > y ? 'A' : 'B';
}

function solve(lines) {
  const m = Number(lines[0]);
  for (let i = 1; i <= m; i += 1) {
    const [a, b, k] = lines[i].split(' ');
    console.log(compare(a, b, k));
  }
}

solve(['3', '1 2 1', '1 2 -1', '2 2 1']);
