<?php
include 'function.php';
header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
// session_start();
$pdo = getPdoInstance();

try {
    if ($_POST) {
        
        if (is_array($_POST['name_data']) && is_array($_POST['message_data']) && isset($_POST["memo_data"]) && is_array($_POST["memo_data"])) {
            $nameData = $_POST['name_data'];
            $messageData = $_POST['message_data'];
            $memoData = $_POST["memo_data"];

            foreach ($nameData as $index => $name) {
                // SQLクエリを準備
                $stmt = $pdo->prepare("UPDATE form SET message = :message,memo = :memo,updated_at = NOW() WHERE name = :name");
             
                $stmt->bindParam(':message', $messageData[$index], PDO::PARAM_STR);
                $stmt->bindParam(':memo', $memoData[$index], PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);

                $stmt->execute();

            }

            echo "更新完了しました。";
            echo "<a href="."contact.html".">トップページに戻る</a>";

        } else {
            throw new Exception("データが正しく送信されませんでした。");
        }
    } else {
        throw new Exception("受信できません");
    }
} catch (Exception $e) {
    echo "エラーが発生しました: ".$e->getMessage();
}
?>





