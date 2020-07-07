function solve(lines) {
  const num = lines.join('').split('').reverse();
  if (num.join('') === lines.join('')) {
    console.log('True');
  }
  console.log('False');
}

solve(['abc']);
