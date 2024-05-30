
<?php
include 'function.php';

header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
/*
session_start();
$dsn = 'mysql:dbname=staff;host=localhost';
$user = 'motomura';
$password = '06100314Ag';
$a = "a";

$pdo = new PDO($dsn, $user, $password);

*/
session_start();

try{  
    session_id(bin2hex(random_bytes(16)));

    $pdo = getPdoInstance();

    $hiddenInfo=$_POST["hiddenInfo"];
    if ($hiddenInfo === 'chatplus') {
        




        if(isset($_POST['id']) && isset($_POST['password'])) {

            $id = $_POST['id'];
            $password = $_POST['password'];
    
    
            $maxLengths = [
                "id" => 50,
                "password" => 50,
            ];
            
            foreach ($maxLengths as $key => $maxLen) {
                if (strlen($GLOBALS[$key])) { // グローバルスコープでキーを参照
                    if (strlen($GLOBALS[$key]) > $maxLen) {
                        throw new Exception("{$GLOBALS[$key]}入力値が長すぎます。最大{$maxLen}文字までです");
                    }
                }
            };
            $sql = 'SELECT * FROM logininfo WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch();
    
    
            if($user && $password==$user['password']) {
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id'];
                $secretInfo = bin2hex(random_bytes(32)); // 32バイトのランダムデータを生成
                $_SESSION['secret_info'] = $secretInfo;
                echo 'ログイン成功';
                header('Location:contact.html');
            } else {
                throw new Exception("ログイン失敗");
                // echo "<a href="."contact.html".">トップページに戻る</a>";
            
            }
    }
        

    } else {throw new Exception("ログイン失敗");
        
    }

    


    }catch (Exception $e) {
    echo "エラーが発生しました: ".$e->getMessage();
    echo "<a href="."contact.html".">トップページに戻る</a>";
}
?>

