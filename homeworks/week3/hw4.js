function solve(lines) {
  const num = lines.join('').split('').reverse();
  if (num.join('') === lines) {
    return 'True';
  }
  return 'False';
}

solve(['abbbba']);
