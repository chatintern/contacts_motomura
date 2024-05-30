

<?php
include 'function.php';
header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
$pdo = getPdoInstance();

try {
    if ($_POST) {
        // 各POSTデータに対してエスケープ処理を行う
        $companyName = htmlspecialchars($_POST["companyName"], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $inquiryType = htmlspecialchars($_POST["inquiryType"], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');




        // メールアドレスの形式チェック
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("無効なメールアドレス形式です");
        }
        
        // 各入力値の最大長チェック
        // $maxLengths = [
        //     "companyName" => 1000,
        //     "name" => 1000,
        //     "email" => 1000,
            

        // ];
        
        // foreach ($maxLengths as $key => $maxLen) {
        //     if (strlen($GLOBALS[$key])) { // グローバルスコープでキーを参照
        //         if (strlen($GLOBALS[$key]) > $maxLen) {
        //             throw new Exception("{$GLOBALS[$key]}入力値が長すぎます。最大{$maxLen}文字までです");
        //         }
        //     }
        // };

        $sql = "INSERT INTO form (company_name,name,email,inquiryType,message,updated_at) VALUES (:company_name, :name,:email,:inquiryType,:message,NOW())";
        $stmt = $pdo->prepare($sql);

        $params = array(
            ':company_name' => $companyName,
            ':name' => $name,
            ':email' => $email,
            ':inquiryType' => $inquiryType,
            ':message' => $message
        );

        $stmt->execute($params);
        echo 'ユーザーが正常に登録されました。';
        echo "<a href=\"contact.html\">トップページに戻る</a>";
    } else {
        throw new Exception("HTMLからのPOST送信受信に失敗しました");
    }
} catch (Exception $e) {
    echo "エラーが発生しました: ". $e->getMessage();
}
?>




