export default function calculateWinner(squares, x, y) {
  if (x === null || y === null) return;
  const pinkOrWhite = squares[y][x];
  let winner;
  const sum = (pinkOrWhite, x, y, directionX, directionY) => {
    let chessInRow = 0;
    let nextX = x;
    let nextY = y;

    while (chessInRow < 5) {
      nextX += directionX;
      nextY += directionY;
      if (
        nextX < 0 ||
        nextX >= 19 ||
        nextY < 0 ||
        nextY >= 19 ||
        squares[nextY][nextX] !== pinkOrWhite
      )
        break;
      chessInRow++;
    }
    return chessInRow;
  };

  if (
    sum(pinkOrWhite, x, y, 1, 0) + sum(pinkOrWhite, x, y, -1, 0) >= 4 ||
    sum(pinkOrWhite, x, y, 0, 1) + sum(pinkOrWhite, x, y, 0, -1) >= 4 ||
    sum(pinkOrWhite, x, y, 1, 1) + sum(pinkOrWhite, x, y, -1, -1) >= 4 ||
    sum(pinkOrWhite, x, y, -1, 1) + sum(pinkOrWhite, x, y, 1, -1) >= 4
  ) {
    winner = pinkOrWhite;
  }
  return winner;
}
