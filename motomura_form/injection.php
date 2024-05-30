

<?php
 
 
 
class TestSQL
{
 
        public $name;
        public $pass;
        public $id;
 
        public function __construct($name_, $pass_, $id_ = ''){
                $this->name  = (string)  $name_;
                $this->pass  = (string)  $pass_;
                $this->id    = (int)     $id_;
        }
 
 
        // エスケープ処理
        public function e($str, $charset = 'UTF-8') {
                $ret = htmlspecialchars($str, ENT_QUOTES, $charset);
                return $ret;
        }
 
 
        // データ接続関数
        public function getDb(){
                $dsn      = 'mysql:dbname=testdb;host=localhost';
                $user     = 'testdbuser';
                $password = 'xxxxx';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //静的プレースホルダ
 
                return $dbh;
        }
 
 
 
 
        // データ入力関数
        public function insert_table($name, $pass){
                
                
                
                
                
                
                

                try {
                        $sql = "INSERT INTO `victim_table` (`name`, `pass`) VALUES (?, ?)";
                        $db  = self::getDb();
                        $stt = $db->prepare($sql);
                        $stt->bindParam(1, $name, PDO::PARAM_STR); //バインド 型指定
                        $stt->bindParam(2, $pass, PDO::PARAM_STR); //バインド型指定
                        $stt->execute();
 
                        echo "</table>";
                        echo "</table>";
                        echo "</table>";
                        echo "</table>";
                        echo "</table>";
                
                        $db = NULL;
 
                 } catch (PDOException $e) {
                        die("DB接続エラー 管理者に連絡して下さい：{$e->getMessage()}");
                 }
        }
 
        // 一覧表示関数
        public function select_table() {
                try {
                                $sql = "SELECT id, name, date FROM `victim_table` ORDER BY `date` DESC ";
                                $db  = self::getDb();
                                $stt = $db->prepare($sql);
                                $stt->execute();
 
                                echo "<table border=1>";
                                echo "<th>ID</th><th>ユーザ名</th><th>登録日</th>";
                                while ($row = $stt->fetch(PDO::FETCH_ASSOC)){
 
                                        $row['id']   = self::e($row['id']);
                                        $row['name'] = self::e($row['name']);
                                        $row['date'] = self::e($row['date']);
 
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['date']}</td>";
                                        echo "</tr>";
                                }
                                $stt->closeCursor();
 
                                echo "</table>";
                        $db = NULL;
                        } catch (PDOException $e) {
                                die("DB接続エラー 管理者に連絡して下さい：{$e->getMessage()}");
                        }
        }
 
 
        // SQLインジェクション脆弱性 あり
        public function vulnerable_search_table($id, $pass) {
                try {
 
                                $db  = self::getDb();
                                $sql = "SELECT * FROM `victim_table` WHERE `id` = $id and `pass` = $pass ";
                                $stt = $db->query($sql);
 
                                while( $row = $stt->fetch(PDO::FETCH_ASSOC) )
                                {
 
                                        $row['id']   = self::e($row['id']);
                                        $row['name'] = self::e($row['name']);
                                        $row['pass'] = self::e($row['pass']);
                                        $row['date'] = self::e($row['date']);
 
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['pass']}</td>";
                                        echo "<td>{$row['date']}</td>";
                                        echo "</tr>";
                                }
                                $stt->closeCursor();
 
                                echo "</table>";
                        $db = NULL;
 
                        } catch (PDOException $e) {
                                die("DB接続エラー 管理者に連絡して下さい：{$e->getMessage()}");
                        }
        }
 
 
        // SQLインジェクション対策済み サーチ
        public function search_table($id, $pass) {
                try {
 
 
                                $db = self::getDb();
 
                                $sql = "SELECT id, name, pass, date FROM `victim_table` WHERE `id` = ? and `pass` = ?";
                                $stt = $db->prepare($sql);
                                $stt->setFetchMode(PDO::FETCH_NUM);
                                $stt->bindParam(1, $id, PDO::PARAM_INT); //バインド 型指定
                                $stt->bindParam(2, $pass, PDO::PARAM_STR); //バインド型指定
                                $stt->execute();
 
 
                                while( $row = $stt->fetch(PDO::FETCH_ASSOC) )
                                {
 
                                        $row['id']   = self::e($row['id']);
                                        $row['name'] = self::e($row['name']);
                                        $row['pass'] = self::e($row['pass']);
                                        $row['date'] = self::e($row['date']);
 
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['pass']}</td>";
                                        echo "<td>{$row['date']}</td>";
                                        echo "</tr>";
                                }
                                $stt->closeCursor();
 
                                echo "</table>";
                        $db = NULL;
                        } catch (PDOException $e) {
                                die("DB接続エラー 管理者に連絡して下さい：{$e->getMessage()}");
                        }
        }
 
 
 
}
?>
 
<?php
 
// 値の判定と初期化
$_POST['name']       = ( isset($_POST['name']) )        ? (string)   $_POST['name']       : '';
$_POST['pass']       = ( isset($_POST['pass']) )        ? (string)   $_POST['pass']       : '';
$_POST['id']         = ( isset($_POST['id']) )          ? (int)      $_POST['id']         : '';
$_POST['insertFlag'] = ( isset($_POST['insertFlag']) )  ? (boolean)  $_POST['insertFlag'] : '';
$_POST['searchFlag'] = ( isset($_POST['searchFlag']) )  ? (boolean)  $_POST['searchFlag'] : '';
$_POST['secureFlag'] = ( isset($_POST['secureFlag']) )  ? (boolean)  $_POST['secureFlag'] : '';
 
 
// SQLインジェクションの検証をはじめるよ！
$attackObj = new TestSQL($_POST['name'], $_POST['pass'], $_POST['id']);
 
?>
 
 
 
 
 
 
 
<h2>新規登録</h2>
<table>
        <form action="" method="post">
                <tr><td>ユーザ名<input type="text" name="name" value=""></td></tr>
                <tr><td>パスワード<input type="text" name="pass" value=""></td></tr>
                <input type="hidden" name="insertFlag" value="true">
                <tr><td><input type="submit"></td></tr>
        </form>
</table>
 
 
<hr/>
<hr/>
 
<?php
 
        if( $_POST['insertFlag'] === true ){
                $attackObj->insert_table($_POST['name'], $_POST['pass']);
                $name = $attackObj->e($_POST['name']);
                echo "<span style=\"color : red; \">{$name}を新規登録しました！</span>";
        }
?>
 
 
 
<?php
        echo "<h2>ユーザ一覧</h2>";
        $attackObj->select_table();
?>
 
 
<hr/>
 
 
<h2>情報確認</h2>
<p>IDとパスワードを入力することで情報を確認出来ます。</p>
<table>
        <form action="" method="post">
                <tr><td>あなたのID<input type="text" name="id" value=""></td></tr>
                <tr><td>あなたのパスワード<input type="text" name="pass" value=""></td></tr>
                <tr><td>(?OωO?)<ｾｷｭｱ関数ｦ宣ス<input type="checkbox" name="secureFlag" value="true"></td></tr>
                <tr><td>&nbsp;</td></tr>
                <input type="hidden" name="searchFlag" value="true">
                <tr><td><div align="center"><input type="submit" value="送信"></div></td></tr>
                <tr><td>&nbsp;</td></tr>
        </form>
</table>
 
 
 
<?php
if( $_POST['searchFlag'] === true )
{
 
echo  <<< EOM
<h3>結果</h3>
<table border=1>
<th>ID</th><th>ユーザ名</th><th>パスワード</th><th>登録日</th>
EOM;
 
        if($_POST['secureFlag'] == true)
        {
                $attackObj->search_table($_POST['id'], $_POST['pass']); //対策済み関数
                echo "<h3><span style=\"color : green; \">対策済み関数</span>で検索しました！</h3>";
 
        }
        elseif($_POST['secureFlag'] == false)
        {
                $attackObj->vulnerable_search_table($_POST['id'], $_POST['pass']);
                echo "<h3><span style=\"color : red; \">脆弱性あり関数</span>で検索しました...。</h3>";
        }
 
}