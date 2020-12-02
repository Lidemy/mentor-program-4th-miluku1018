import React, { useState } from "react";
import styled from "styled-components";

const Form = styled.form`
  width: 645px;
  background-color: #fff;
  box-shadow: 1.8px 2.4px 5px 0 rgba(0, 0, 0, 0.3);
  margin: 110px auto 50px;
  border-top: 8px solid #fad312;
  padding: 50px 0 35px 42px;
  position: relative;
`;
const Desc = styled.div`
  h1 {
    margin: 0px;
    font-size: 36px;
  }
  .form-desc {
    margin: 20px 0;
  }
  .form-desc p,
  p {
    margin: 10px 0;
    font-size: 14px;
  }
  .form-desc .not-null {
    color: #e74149;
    font-size: 16px;
    margin: 20px 0 50px;
  }
`;
const Label = styled.label`
  display: block;
  margin-bottom: 20px;
  font-size: 20px;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const Input = styled.input`
  width: 300px;
  height: 25px;
`;
const Name = styled.div`
  margin: 50px 0;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const Email = styled.div`
  margin: 50px 0;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const Phone = styled.div`
  margin: 50px 0;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const Category = styled.div`
  margin: 50px 0;
  .categories-title::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
  .category {
    display: flex;
  }
  #on-bed,
  #on-phone {
    margin-right: 10px;
    height: 20px;
    width: 18px;
  }
`;
const Activity = styled.div`
  margin: 50px 0;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const Suggestion = styled.div`
  margin: 50px 0;
  .not-null::after {
    content: "*";
    color: #e74149;
    margin-left: 5px;
  }
`;
const WarnMessage = styled.div`
  color: red;
  font-size: 18px;
`;
const SubmitButton = styled.button`
  width: 92px;
  height: 40px;
  background-color: #fad312;
  border-radius: 3px;
  border: 1px solid #fad312;
  cursor: pointer;
`;

export default function Forms() {
  const [formList, setFormList] = useState({
    nickName: "",
    emailAddress: "",
    cellPhone: "",
    category: "",
    howToKnow: "",
    other: "",
    notNull: false,
  });

  const handleInputChange = (e) => {
    const name = e.target.name;
    const value = e.target.value;
    setFormList({
      ...formList,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (
      !formList["nickName"] ||
      !formList["emailAddress"] ||
      !formList["cellPhone"] ||
      !formList["category"] ||
      !formList["howToKnow"]
    ) {
      setFormList({
        ...formList,
        notNull: true,
      });
      console.log("空白");
      return;
    }
    console.log("成功");
    setFormList({
      ...formList,
      notNull: false,
    });
    // 物件轉陣列
    const formListContent = Object.entries(formList)
      .filter((item) => item[0] !== "notNull")
      .map((value) => `${value[0]}: ${value[1]}`);
    const alertFormListContent = formListContent.reduce(
      (acc, cur) => `${acc}\n${cur}`
    );
    alert(alertFormListContent);
  };
  return (
    <Form onSubmit={handleSubmit}>
      <Desc>
        <h1>新拖延運動報名表單</h1>
        <div className="form-desc">
          <p>活動日期：2020/12/10 ~ 2020/12/11</p>
          <p>活動地點：台北市大安區新生南路二段1號</p>
          <p className="not-null">* 必填</p>
        </div>
      </Desc>
      <Name>
        <Label htmlFor="name" className="not-null">
          暱稱
        </Label>
        <Input
          type="text"
          id="name"
          name="nickName"
          placeholder="您的回答"
          value={formList["nickName"]}
          onChange={handleInputChange}
        />
        {!formList["notNull"] ||
          (!formList["nickName"] && <WarnMessage>此欄位必填</WarnMessage>)}
      </Name>
      <Email>
        <Label htmlFor="email" className="not-null">
          電子郵件
        </Label>
        <Input
          type="email"
          id="email"
          name="emailAddress"
          placeholder="您的電子郵件"
          value={formList["emailAddress"]}
          onChange={handleInputChange}
        />
        {!formList["notNull"] ||
          (!formList["emailAddress"] && <WarnMessage>此欄位必填</WarnMessage>)}
      </Email>
      <Phone>
        <Label htmlFor="phone" className="not-null">
          手機號碼
        </Label>
        <Input
          type="tel"
          id="phone"
          name="cellPhone"
          placeholder="您的手機號碼"
          value={formList["cellPhone"]}
          onChange={handleInputChange}
        />
        {!formList["notNull"] ||
          (!formList["cellPhone"] && <WarnMessage>此欄位必填</WarnMessage>)}
      </Phone>
      <Category>
        <p className="categories-title">報名類型</p>
        <div className="category">
          <Input
            type="radio"
            id="on-bed"
            name="category"
            value="躺在床上用想像力實作"
          />
          <Label htmlFor="on-bed" className="on-the-bed">
            躺在床上用想像力實作
          </Label>
        </div>
        <div className="category">
          <Input
            type="radio"
            id="on-phone"
            name="category"
            value="趴在地上滑手機找現成的"
            onChange={handleInputChange}
          />
          <Label htmlFor="on-phone" className="on-the-phone">
            趴在地上滑手機找現成的
          </Label>
        </div>
        {!formList["notNull"] ||
          (!formList["category"] && <WarnMessage>此欄位必選</WarnMessage>)}
      </Category>
      <Activity>
        <Label htmlFor="activity" className="not-null">
          怎麼知道這個活動的？
        </Label>
        <Input
          type="text"
          id="activity"
          name="howToKnow"
          placeholder="您的回答"
          value={formList["howToKnow"]}
          onChange={handleInputChange}
        />
        {!formList["notNull"] ||
          (!formList["howToKnow"] && <WarnMessage>此欄位必選</WarnMessage>)}
      </Activity>
      <Suggestion>
        <Label htmlFor="other" className="other-comments">
          其他
        </Label>
        <p>對活動的一些建議</p>
        <Input
          type="text"
          id="other"
          name="other"
          placeholder="您的回答"
          value={formList["other"]}
          onChange={handleInputChange}
        />
      </Suggestion>
      <SubmitButton>提交</SubmitButton>
      <p>請勿透過表單送出您的密碼。</p>
    </Form>
  );
}
