import React from "react";
import ReactDOM from "react-dom";
import Game from "./Game";
import { createGlobalStyle } from "styled-components";

const GlobalStyle = createGlobalStyle`
  body {
    background-color: #e7a5af;
  }
`;

ReactDOM.render(
  <React.Fragment>
    <GlobalStyle />
    <Game />
  </React.Fragment>,
  document.getElementById("root")
);
