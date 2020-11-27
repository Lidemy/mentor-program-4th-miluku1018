import React from "react";
import styled from "styled-components";

const Button = styled.div`
  display: table;
  float: left;
  margin: 0;
  width: 25px;
  height: 25px;
  background: linear-gradient(
      to bottom,
      transparent 48%,
      #999 48%,
      #999 52%,
      transparent 52%
    ),
    linear-gradient(
      to right,
      transparent 48%,
      #999 48%,
      #999 52%,
      transparent 52%
    );
  cursor: pointer;
  &:hover {
    background: radial-gradient(
      circle closest-side at center,
      #ffc93c,
      rgba(0, 0, 0, 0)
    );
  }
  &:active {
    transform: scale(0.98, 0.98);
  }
`;
const Pink = styled.div`
  content: "";
  background-color: #ffb0be;
  width: 20px;
  height: 20px;
  border: 0;
  margin: 2px auto 0;
  border-radius: 50%;
  justify-content: center;
  box-shadow: inset 0 -2px 2px rgba(0, 0, 0, 0.2),
    inset 2px 0 2px rgba(0, 0, 0, 0.2), inset -2px 0 2px rgba(0, 0, 0, 0.2),
    inset 0 -2px 2px rgba(0, 0, 0, 0.2), 0 2px 2px 0px #272a27;
`;

const White = styled.div`
  content: "";
  background-color: #fcfcfc;
  width: 20px;
  height: 20px;
  border: 0;
  margin: 2px auto 0;
  border-radius: 50%;
  box-shadow: inset 0 -2px 2px 0 rgba(0, 0, 0, 0.2),
    inset 2px 0 2px 0 rgba(0, 0, 0, 0.2), inset -2px 0 2px 0 rgba(0, 0, 0, 0.2),
    inset 0 -2px 2px 0 rgba(0, 0, 0, 0.2), 0 2px 2px 0px #272a27;
`;
export default function Square({ value, onClick }) {
  let button;
  if (value) {
    if (value === "pink") {
      button = <Pink />;
    } else {
      button = <White />;
    }
  }
  return <Button onClick={onClick}>{button}</Button>;
}
