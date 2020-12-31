import React, { useState } from "react";
import styled from "styled-components";
import { newPost } from "../../redux/reducers/postReducer";
import { useDispatch } from "react-redux";
import { useHistory } from "react-router-dom";

const ErrorMessage = styled.div`
  color: red;
`;
const Form = styled.div`
  text-align: center;
  margin-top: 30px;
`;
const Input = styled.input`
  width: 400px;
  height: 30px;
  border: 1px solid #f09fac;
  border-radius: 3px;
`;

const Textarea = styled.textarea`
  margin: 10px 0;
  border: 1px solid #f09fac;
  border-radius: 3px;
`;

const Button = styled.button`
  background-color: pink;
  border: 1px solid transparent;
  border-radius: 5px;
  width: 300px;
  height: 35px;
  cursor: pointer;
  :hover {
    background-color: #000000de;
    border: 1px solid transparent;
    border-radius: 5px;
    color: #ec8c9b;
  }
`;

export default function NewPostPage() {
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");
  const [errorMessage, setErrorMessage] = useState();
  const history = useHistory();
  const dispatch = useDispatch();

  const handleSubmit = () => {
    dispatch(newPost(title, content)).then((newPostResponse) => {
      if (newPostResponse && newPostResponse.id) {
        history.push("/posts/" + newPostResponse.id);
      }
    });
  };

  return (
    <Form>
      {errorMessage && <ErrorMessage>{errorMessage}</ErrorMessage>}
      <div>
        標題: <Input value={title} onChange={(e) => setTitle(e.target.value)} />
      </div>
      <div>
        <Textarea
          cols="55"
          rows="20"
          value={content}
          onChange={(e) => setContent(e.target.value)}
        />
      </div>
      <Button onClick={handleSubmit}>送出</Button>
    </Form>
  );
}
