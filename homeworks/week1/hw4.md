## 跟你朋友介紹 Git

* Git 基本概念： Git 是一個版本控制系統，一次可以儲存好多個修改後的檔案，可以歸類在同一次儲存狀態，作為更新歷史記錄保存起來。因此可以把編輯過的檔案復原到以前的狀態，也可以顯示編輯過內容的差異。

* Git 基礎使用：
1. git init：在新專案內，使用 git init 初始化，讓 git 可以在這個目錄進行版本控制。
2. git add：當檔案為已完成狀態，使用 git add .，可以一次將所有新檔案都加入版本控制，表示這批檔案是同一次的時間點儲存的。
3. git commit：接著使用 git commit -m "新增第二版笑話"

* GitHub 簡介：GitHub 是透過 Git 進行版本控制的軟體原始碼代管服務平台，同時也提供社群功能，允許用戶追蹤其他用戶、組織、軟體庫的動態，對軟體代碼的改動和bug提出評論等。

* 操作說明
4. git status：「nothing to commit」有出現這段文字，代表現在沒有東西要做 git commit，代表可以推到 GitHub。
5. git push：git push -u origin master ，把 master 這個分支的內容，推向 origin 這個位置。
* master：本地分支名。
* origin master：origin 表示遠端，master 表示分支名，接在 origin 之後表示是遠端分支名。
* -u，表示要設定 upstream 的意思，把 origin 設定為本地 master 分支的 upstream，當下回執行 git push 指令而不加任何參數的時候，它就會猜你是要推往 origin 這個遠端節點，並且把 master 這個分支推上去。
6. git pull：git pull origin master 
* master：本地分支名。
* origin master：origin 表示遠端，master 表示分支名，接在 origin 之後表示是遠端分支名。

