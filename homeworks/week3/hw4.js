function solve(lines) {
  const num = lines.split('').reverse();
  if (num.join('') === lines) {
    return 'True';
  }
  return 'false';
}

solve('aba');
