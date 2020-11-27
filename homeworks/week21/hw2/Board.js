import React from "react";
import Square from "./Square";
import styled from "styled-components";

const BoardRow = styled.div`
  margin: 30px auto;
  height: 475px;
  width: 475px;
  background-color: #eee;
  box-shadow: inset 0 -3px 3px 0 rgba(0, 0, 0, 0.2),
    inset 3px 0 3px 0 rgba(0, 0, 0, 0.2), inset -3px 0 3px 0 rgba(0, 0, 0, 0.2),
    inset 0 -3px 3px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0px #272a27;
  border-radius: 5px;
`;

const Row = styled.div``;

export default function Board({ squares, onClick }) {
  return (
    <BoardRow>
      {squares.map((row, yIndex) => (
        <Row key={yIndex}>
          {row.map((col, xIndex) => (
            <Square
              key={xIndex}
              value={col}
              onClick={() => onClick(xIndex, yIndex)}
            />
          ))}
        </Row>
      ))}
    </BoardRow>
  );
}
