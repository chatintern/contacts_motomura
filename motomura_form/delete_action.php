
<?php

include 'function.php';
header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
$pdo = getPdoInstance();


// session_start();

try{
    if($_POST){

    $update_data = $_POST['data'];

    foreach ($update_data as $element) {
        $stmt = $pdo->prepare("SELECT * FROM form WHERE name = :name");
        $stmt->bindParam(':name', $element, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($result!== false) {
            $deleteStmt = $pdo->prepare("DELETE FROM form WHERE name = :name");
            $deleteStmt->bindParam(':name', $element, PDO::PARAM_STR);
            $deleteStmt->execute();



            echo "
            <p>削除しました:</p>
            <p>会社名: ". htmlspecialchars($result["company_name"], ENT_QUOTES, 'UTF-8'). "</p>
            <p>お名前: ".htmlspecialchars($result["name"], ENT_QUOTES, 'UTF-8')."</p>
            <p>メールアドレス: ". htmlspecialchars($result["email"], ENT_QUOTES, 'UTF-8'). "</p>
            <p>お問い合わせ種別: ". htmlspecialchars($result["inquiryType"], ENT_QUOTES, 'UTF-8'). "</p>
            <p>お問い合わせ内容: ". htmlspecialchars($result["message"], ENT_QUOTES, 'UTF-8'). "</p>
            <p>登録日時: ". htmlspecialchars($result["updated_at"], ENT_QUOTES, 'UTF-8'). "</p>
            <p>メモ: ". htmlspecialchars($result["memo"], ENT_QUOTES, 'UTF-8'). "</p>
            <hr> <!-- 分割線 -->";
            


            
        }else {
            throw new Exception("データが見つかりませんでした");}
    }
    echo "<a href="."contact.html".">トップページに戻る</a>";
    }else {
        throw new Exception("HTMLからのPOST送信受信に失敗しました");}
}catch (Exception $e) {
    echo "エラーが発生しました: ". $e->getMessage();
}

?>
