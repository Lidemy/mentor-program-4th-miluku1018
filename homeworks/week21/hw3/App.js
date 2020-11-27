import React from "react";
import Forms from "./Forms";
import styled from "styled-components";

const Page = styled.div``;
const Footer = styled.div`
  width: 100%;
  color: #999999;
  background-color: black;
  padding: 30px 0;
  text-align: center;
  border-top: 1px solid #fad312;
  position: fixed;
  bottom: 0;
`;

export default function App() {
  return (
    <Page>
      <Forms />;<Footer>© 2020 © Copyright. All rights Reserved.</Footer>
    </Page>
  );
}
