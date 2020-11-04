## 十六到二十週心得

* Week 16 JavaScript 核心與物件導向
這一週進入進階的 JavaScript 想必許多人都跟我一樣痛苦，影片看完，仍然是似懂非懂的感覺，就像事件傳遞機制一樣，又陷入萬惡輪迴之中，影片不斷地重複看著，文章也是不斷地重複看著，心裡仍然是茫茫然的。

Event Loop： JavaScript 的執行時期（Runtime）一次只能做一件事，但瀏覽器提供了更多不同的 API 讓我們使用，進而讓我們可以透過 Event Loop 搭配非同步的方式同時處理多個事項。Event Loop 的作用是去監控堆疊（Call Stack）和工作佇列（Task Queue），當堆疊中沒有執行項目的時候，便把佇列中的內容拉到堆疊中去執行。

接下來作用域和提升，也是面試很愛的考題，會出一道題目，然後，說出印出的順序是什麼。這個我以前也是完全瞎猜，一直搞不懂，大概就是不懂裝懂的概念，運氣好猜對，運氣不好就全錯。現在就明白需要一行一行看程式碼。
- Scope 作用域，基本單位是 function，只有 function 可以產生一個新的作用域。離開作用域，就無法被看見。在 ES6，let & const 只要有 { } 就可以產生新的作用域。
- hoisting 提升順序是以 function 為優先，再來是 arguments，最後是 var。同名的函式，後面會蓋掉前面。


- Closure（閉包）： 如果錯誤的使用全域變數，程式很容易出現一些魔名其妙的 bug，透過閉包讓 function 能夠有 private 變數，讓變數保留在該函式中而不會被外在環境干擾。
- Prototype : function 的 prototype 屬性一開始是空物件，透過 function constructor 所建立的物件會繼承該 function 中 prototype 的內容。
- this：
    - 如果在 global environment 建立函式並呼叫 this ，this = global object，在瀏覽器環境下，this = Window 物件。
    - 如果在物件裡面建立函式，this 就會指到包含這個方法的物件。如果不知道 this 指稱什麼，就 console.log 出來看看。

參考資料：https://www.notion.so/Huli-90259603453d4d94b611b5bcc2e0d701#f06c1d5426174ffca3012af002560139
參考資料：https://pjchender.blogspot.com/2017/05/javascript-closure.html
參考資料：https://pjchender.blogspot.com/2016/06/javascriptfunction-constructorprototype.html
參考資料：https://pjchender.blogspot.com/2016/03/javascriptthisbug.html

* Week 17 現代後端開發
以前沒有思考過為何要使用框架，就只是認為因為老師這樣教，市場主流，就只想到快速開發這項優點，或者是科技與時代的進步，現在有智慧型手機，也就不會想用以前的智障型手機，但是，沒有思考過，更深入的問題。這大概就是不要保持著本來就是這樣的想法，要勇於跳脫現有思維，多思考為什麼。

1. 高效率：使用框架的好處就是可以快速開發出一個網站，特別像是新創公司，時間與資源皆有限，無法慢慢地開發。有了框架，我們可以專注在系統的核心邏輯。
2. 高安全性：市場上受歡迎的框架，經過多年的測試與考驗，保證了各種情況的穩定性與安全性。
3. 高穩定性：框架能夠把負責不同工作的模組切開，又能夠再適時的時候整合在一起使用，不容易造成牽一髮動全身的情況。
4. 高協同性：在框架的前提下，大家分工合作知道怎麼把不同的模組整合在一起，團隊的協調性簡單許多。在招募人才方面比較容易，上班後可以馬上上手，不需要花太多時間培訓。

### ORM
ORM 就是將關聯式資料庫的內容映射為物件，讓工程師可以用操作物件的方式對資料庫進行操作，而不直接使用 SQL 語法對資料庫進行操作。
- 優點：
    - 安全性：因為不直接使用 SQL 語法，可以避免 SQL inection 攻擊。
    - 簡化性：加速開發，減少撰寫重複性 SQL 語法。
    - 通用性：方便轉移資料庫，因為 ORM 是在程式語言和資料庫之間，就算換了資料庫，也不需要改寫程式碼。
- 缺點：
    - 效能較差，需要把程式語言轉譯成 SQL 語法。
    - 複雜查詢維護性低，程式語言無法支援較複雜的查詢。

###  N+1 problem
假設一個用戶有 10 筆訂單，第 1 次查詢某個使用者擁有訂單數量後，接著產生 10 次查詢訂單的語法，也就是 N + 1 次。如此會產生效能的問題，可以使用 join 連結 table ，一次查詢就撈出所有資料。這應該屬於後端面試容易被問到的問題？？不知道前端面試會不會有此問題。

### 部署 Node.js 應用程式到 heroku
Heroku 部署應該是目前為主我個人最愛的方式，有點像是懶人部署法，就是不需要過多的設定，即可以部署成功。但是，過程中，也是會出現許多奇奇怪怪的問題，可能是經驗不足的關係，導致出現許多問題，因而打不開網頁。也還好這些問題，都可以透過網路找到答案。人都有一種惰性，當我學會一項部署，就會逃避學習新的部署～～為什麼不是充滿好奇心去學更多不同種的部署呢？！！！真是糟糕呀！！！我每次都想著，我要是跟老師一樣對於程式語言充滿無限的興趣，大概也就可以快快樂樂學程式惹，所以說心魔大部分來自於自己的內心，而不是別人～～～畢竟責怪別人比較容易，責備自己比較困難一點。哈哈哈有時候好難抉擇啊～多說要多愛自己一點，過了頭就變成太縱容自己了！


參考資料：https://medium.com/vito-hsu/%E7%82%BA%E4%BB%80%E9%BA%BC%E5%AF%AB%E7%B3%BB%E7%B5%B1%E8%A6%81%E4%BD%BF%E7%94%A8%E6%A1%86%E6%9E%B6-framework-48a6bbcb923b

* Week 18
時間因素，跳過此週～

* Week 19 淺談產品開發與工作流程
目前尚無法完全理解影片與文章的內容，就只能先記在腦海中，有個印象，畢竟將來工作的團隊，使用的開發方式，可能不太一樣，也許可以當作找工作的一種參考依據，前提是有公司可以選的話，哈哈如果只有被選的份，就只能乖乖地上班，累績經驗，先別想太多了！

### 工程師怎麼知道要做什麼事情？ 主要是第 2 & 4 點
1. stakeholder 利益相關者提出需求
2. PM 開始撰寫 spec
3. 畫 wireframe
4. 交給 designer 產生 mockup
5. 交給工程師開工

### 軟體開發方法論
- Waterfall 瀑布流 : 單一方向，只能往下走，不能往回走，缺乏彈性。時程需要花一年。
Requirement -> Design -> Implementation -> Verification -> Maintenance

- 敏捷宣言 12 原則
1. 我們最優先的任務，是透過及早並持續地交付有價值的軟體來滿足客戶需求。(Our highest priority is to satisfy the customer through early and continuous delivery of valuable software.)
2. 竭誠歡迎改變需求，甚至已處開發後期亦然。敏捷流程掌控變更，以維護客戶的競爭優勢。(Welcome changing requirements, even late in development. Agile processes harness change for the customer’s competitive advantage.)
3. 經常交付可用的軟體，頻率可以從數週到數個月，以較短時間間隔為佳。(Deliver working software frequently, from a couple of weeks to a couple of months, with a preference to the shorter timescale.)
4. 業務人員與開發者必須在專案全程中天天一起工作。(Business people and developers must work together daily throughout the project.)
5. 以積極的個人來建構專案，給予他們所需的環境與支援，並信任他們可以完成工作。(Build projects around motivated individuals. Give them the environment and support they need, and trust them to get the job done.)
6. 面對面的溝通是傳遞資訊給開發團隊及團隊成員之間效率最高且效果最佳的方法。(The most efficient and effective method of conveying information to and within a development team is face-to-face conversation.)
7. 可用的軟體是最主要的進度量測方法。(Working software is the primary measure of progress.)
8. 敏捷程序提倡可持續的開發。贊助者、開發者及使用者應當能不斷地維持穩定的步調。(Agile processes promote sustainable development. The sponsors, developers, and users should be able to maintain a constant pace indefinitely.)
9. 持續追求優越的技術與優良的設計，以強化敏捷性。(Continuous attention to technical excellence and good design enhances agility.)
10. 精簡──或最大化未完成工作量之技藝──是不可或缺的。(Simplicity — the art of maximizing the amount of work not done — is essential.)
11. 最佳的架構、需求與設計皆來自於能自我組織的團隊。(The best architectures, requirements, and designs emerge from self-organizing teams.)
12. 團隊定期自省如何更有效率，並據之適當地調整與修正自己的行為。(At regular intervals, the team reflects on how to become more effective, then tunes and adjusts its behavior accordingly.)

- Agile 敏捷：講求迭代，快速循環，一個圓圈，很像是把瀑布流切小的感覺。「Kanban 看板」＆「Scrum」 兩種實作。
    - Kanban 看板：跟 Trello 同一套概念，通常分為三個區塊，to-do/ doing/ done，比較沒有時程的概念，隨時可以插單。
    - Scrum：跟看板不同的是，短衝 (Sprint) 定義上 1-4 週，實務上，1-2 週，固定一個頻率來進行，如果設定兩週，就以兩週為一個頻率來進行，而且做出來的功能是可以讓使用者使用的程度。通常不給插單，要遵守開發週期完成。
      -  三個角色：
          - Product Owner：決定產品最終走向的人，決定要開發什麼。通常是 Product Manager(PM)。
          - Scrum Master：幫助大家跑 Scrum 開發的人。通常是 PM 兼任此角色，比較有制度的公司，才會單獨有此角色。
          - Team：工程師們。
      - 流程：
          - Product Backlog：一堆想開發的功能，這個產品所有的功能，擔當者 PM。
          - Sprint Planning Meeting：短衝規劃會議，根據 PO 選好的開發功能，工程師討論可以做多少功能，擔當者：工程師。
          - Sprint Backlog：這個 Sprint 要做的功能，與 Product Backlog 不同。
          - Sprint 開發週期，通常為 1-2 週為 1 個循環
              - 週一到週五每天早上有 Daily Scrum，每天的站立會議，報告昨天的進度，今天預計的進度，以及遇到的問題等等，通常不建議主管參加站立會議，因為這樣會變成大家跟主管報告進度，建議讓團隊自行同步工作內容。
              - 週一到週五之間，會挑一個時間，舉辦 Product Backlog Refinement 產品代辦清單精煉會議，把代辦項目的細節定義清楚。
              - 週五，Sprint Review 檢視會議，參與者為所有利害關係人，展示開發的功能，讓大家實際體驗與使用，並且取得回饋，從而決定下一個 Sprint 要做哪些東西。
              - 最後，Srpint Retrospective 自省會議，檢討這週哪裡做得不夠好，如何提升工作效率與開發效率，也是一樣不建議主管參加自省會議，而是團隊討論完，最後向主管報告哪些需要改善的。
              - 時間盒（Timebox）： Scrum 的架構下，所有的活動都是有時間限制的，假設 Scrum 中，1 週的 Sprint，會議時間為不超過一個小時，如果開發週期為 2 週，會議時間就變為 2 個小時，以此類推。

