function solve(lines) {
  const str = lines[0];
  if (str === str.split('').reverse().join('')) {
    console.log('True');
  }
  console.log('False');
}

solve(['ac']);
