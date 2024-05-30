<?php

function getPdoInstance() {

    $dsn = 'mysql:dbname=form;host=localhost';
    $user = 'chatplus';
    $password = '0810';

    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die('Connection failed: '. $e->getMessage());
    }
}

function sessionControl() {
    $name=$_SESSION["id"];
    $secretInfo=$_SESSION['secret_info'];


    try{
        if(isset($name)&&isset($secretInfo)){
                echo "ようこそ、".$_SESSION["id"]."さん！";
                print('session_id()は '.session_id().' です。<br>');
                echo "ようこそ、".$secretInfo."さん！";
                echo("<br/>");
            }else{
                header('Location:login.php');
                exit;} // 32バイトのランダムデータを生成して文字列に変換
        }catch (Exception $e) {
            echo "エラーが発生しました: ".$e->getMessage();
        }
}

// 以降の処理...
?>
