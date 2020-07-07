function solve(lines) {
  const num = lines.join('').split('').reverse();
  if (num.join('') === lines.join('')) {
    return 'True';
  }
  return 'False';
}

solve(['abbbba']);
