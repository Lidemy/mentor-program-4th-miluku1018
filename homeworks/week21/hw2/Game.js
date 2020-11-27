import React, { useState } from "react";
import Board from "./Board";
import styled from "styled-components";
import calculateWinner from "./calculateWinner";

const Games = styled.div`
  width: 600px;
  margin: 0 auto;
  text-align: center;
`;
const Title = styled.h1`
  color: darkgreen;
`;
const Winner = styled.div`
  margin: 5px;
`;
const WinnerName = styled.div`
  font-size: 40px;
  color: #ffffff;
`;
const Button = styled.button`
  display: block;
  margin-left: 10px;
  background-color: saddlebrown;
  border-radius: 5px;
  border: 1px solid transparent;
  color: #ffffff;
  margin: 15px auto;
  padding: 5px 10px;
  cursor: pointer;
`;
const Next = styled.div`
  color: #433e3e;
  font-size: 20px;
`;

const Info = ({ pinkOrWhite, winner }) => (
  <div>
    <Title>簡易五子棋</Title>
    {winner && (
      <Winner>
        <Button onClick={() => window.location.reload()}>再玩一次</Button>
        <WinnerName>贏家：{winner === "pink" ? "粉紅棋" : "白棋"}</WinnerName>
      </Winner>
    )}
    <Next>{pinkOrWhite === "pink" ? "粉紅棋" : "白棋"}</Next>
  </div>
);

export default function Game() {
  const [board, setBoard] = useState(Array(19).fill(Array(19).fill(null)));
  const [stepPlayed, setStepPlayed] = useState(0);
  const [pinkIsNext, setPinkIsNext] = useState(true);
  const [currentX, setCurrentX] = useState(null);
  const [currentY, setCurrentY] = useState(null);
  const pinkOrWhite = pinkIsNext ? "pink" : "white";
  const winner = calculateWinner(board, currentX, currentY);

  const handleClickMove = (xIndex, yIndex) => {
    setCurrentX(xIndex);
    setCurrentY(yIndex);
    const squares = [...board];

    if (winner || squares[yIndex][xIndex]) {
      return;
    }
    setBoard(
      squares.map((row, currentY) => {
        if (currentY !== yIndex) {
          return row;
        }
        return row.map((col, currentX) => {
          if (currentX !== xIndex) {
            return col;
          }
          return pinkOrWhite;
        });
      })
    );
    setStepPlayed(stepPlayed + 1);
    setPinkIsNext(!pinkIsNext);
  };

  return (
    <Games>
      <Info pinkOrWhite={pinkOrWhite} winner={winner} />
      <Board squares={board} onClick={handleClickMove} />
    </Games>
  );
}
