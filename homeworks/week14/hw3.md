## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
- 網域名稱系統（英語：Domain Name System，縮寫：DNS）是網際網路的一項服務。它作為將域名和IP位址相互對映的一個分散式資料庫，能夠使人更方便地存取網際網路。例如：[查詢領域名稱 www.twnic.net.tw](http://xn--www-q33er8og52a4i3amc1au1z.twnic.net.tw/)，可對映到位址 210.17.9.228 反過來，也可以經由位址 210.17.9.228 查詢，對映到領域名稱 [www.twnic.net.tw](http://www.twnic.net.tw/) 當您連上一個網址，在URL打上﹕www.twnic.net.tw 的時候，可以說就是使用了DNS的服務了。DNS的作用就是『 讓人類較容易記憶的主機名稱(英文字母)，轉譯成為電腦所熟悉的 IP 位址！』，而免除了強記號碼的痛苦。
- Google Public DNS 是 Google 面對大眾推出的一個公共免費域名解析服務。而 Google 表示推出免費 DNS 服務的主要目的就是為了
    - 改進網路瀏覽速度，上網速度比較快
    - 提升網路安全，也就是用 Google Public DNS 比較安全
    - 直接取得 DNS 查詢結果，也就是查詢比較快，因為已經快取了，不會轉上去查上層 DNS 的紀錄
- 對 Google 來說，大家都使用他們家服務，就可以收集到廣泛的資料，用於商業目的。

參考資料：[https://zh.wikipedia.org/wiki/Google_Public_DNS](https://zh.wikipedia.org/wiki/Google_Public_DNS)
參考資料：http://dns-learning.twnic.net.tw/dns/01whatDNS.html

## 什麼是資料庫的 lock？為什麼我們需要 lock？
- 因為多筆交易在資料的讀取與寫入的時候，彼此會相互影響，因此為了交易的 concurrency 與 isolation ，資料的讀取或是寫入的時候就會被做一個記號，這個記號用來告知該資料正在被讀取或是寫入的狀態，其他交易根據這個記號來決定是否要等待到該紀錄狀態結束或是直接讀取該資料，而該”記號”就是所謂的 Locks。
- 利用交易對於要存取的資料先進行鎖定，以避免交易之間彼此產生衝突，達到交易的「並行控制」。

參考資料：https://www.qa-knowhow.com/?p=383

## NoSQL 跟 SQL 的差別在哪裡？
- NoSQL: 分散式非關聯式資料庫/NoSQL資料庫用來代表那些無法提供SQL語言查詢的資料庫系統，一個資料表。NoSQL databases 是以類似 JSON, 欄位與數值成對(JSON-like, field-value pair) 的 document 去儲存資料，所以，沒有 Schema。MongoDB, CouchDB, Redis and Apache Cassandra 等非關聯式資料庫。
    - 不支援 JOIN
    - 通常用來存一些結構不固定的資料（log 之類的）
- SQL: 關聯式模型將資料標準化，成為由列和欄組成的表格。結構描述嚴格定義表格、列、欄、索引、表格之間的關係，以及其他資料庫元素。此類資料庫強化資料庫表格間的參考完整性。Oracle、DB2、SQL Server、MySQL 和 PostgreSQL 等關聯式資料庫。

參考來源：[https://aws.amazon.com/tw/nosql/](https://aws.amazon.com/tw/nosql/)
參考來源：[https://www.kshuang.xyz/doku.php/database:sql_vs_nosql](https://www.kshuang.xyz/doku.php/database:sql_vs_nosql)

## 資料庫的 ACID 是什麼？
ACID，是指資料庫管理系統（DBMS）在寫入或更新資料的過程中，為保證事務（transaction）是正確可靠的，所必須具備的四個特性：原子性（atomicity，或稱不可分割性）、一致性（consistency）、隔離性（isolation，又稱獨立性）、持久性（durability）。

事務(Transaction)，是我們關係型資料庫中非常重要的一個概念，它要符合ACID特性。是由一組SQL語句組成的一個程式執行單元(Unit)，該執行單元要麼成功 Commit ,要麼失敗 Rollback。
    - **Atomicity(原子性)：**指事務是一個不可再分割的工作單元，事務中的操作要麼都發生，要麼都不發生。 通俗的說：我們有一堆的事情，它要麼全做，要麼全都不做，不能只做一半。比如我們的銀行轉賬。我把錢轉給你，把我的錢扣掉，然後把你的錢加上去。不能只做一半，只把我的錢扣掉，你的錢沒有加上去。
    - **Consistency(一致性)：**指事務開始之前和事務結束以後，資料庫的完整性約束沒有被破壞。 通俗的說：我和你的錢加起來一共是2000，那麼不管我和你之間如何轉賬，轉幾次賬，事務結束後我們的錢相加起來應該還得是2000，這就是事務的一致性。
    - **Isolation(隔離性)：**指多個事務併發訪問時，事務之間是隔離的，一個事務不應該影響其它事務執行效果。 通俗的說：多個使用者併發訪問操作同一張表時，資料庫為每一個使用者開啟的事務，不能被其他事務的操作所干擾，多個併發事務之間要相互隔離。
    - **Durability(永續性)：**指事務所對資料庫所作的更改便持久的儲存在資料庫之中，並不會被回滾。 通俗的說：比如我將事務做完之後，這個結果是能持久下去的並能一直存下去。不管斷電還是其他情況。

- NoSQL 資料庫通常透過鬆綁部分關聯式資料庫的 ACID 屬性來取捨，以達到能夠橫向擴展的更彈性化資料模型。這使得 NoSQL 資料庫成為橫向擴展超過單執行個體上限的高吞吐量、低延遲使用案例的最佳選擇。

參考來源：[https://iter01.com/114604.html](https://iter01.com/114604.html)
參考來源：[https://aws.amazon.com/tw/nosql/](https://aws.amazon.com/tw/nosql/)