<?php
include 'function.php';
header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
$pdo = getPdoInstance();

try {
    if ($_POST) {
        $update_data = $_POST['data'];
        $results = []; // 結果を格納する配列を初期化

        foreach ($update_data as $element) {
            $stmt = $pdo->prepare("SELECT * FROM form WHERE name = :name");
            $stmt->bindParam(':name', $element, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $results[] = $result; // 検索結果を$results配列に追加
            }
        }

        // 結果を表示
        if (!empty($results)) {
            echo "<form action=update_action.php method=post>";
            foreach ($results as $row) {
                // メールアドレスの形式チェック
                
                
                echo "
                 <p>会社名: ". htmlspecialchars($row["company_name"], ENT_QUOTES, 'UTF-8'). "</p>
                 <p>お名前: <input type='text' name='name_data[]' readonly value='".htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')."'></p>
                 <p>メールアドレス: ". htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8'). "</p>
                 <p>お問い合わせ種別: ". htmlspecialchars($row["inquiryType"], ENT_QUOTES, 'UTF-8'). "</p>
                 <p>
                     <label>お問い合わせ内容:</label> 
                     <input type=text  name=message_data[] value='". htmlspecialchars($row["message"], ENT_QUOTES, 'UTF-8'). "'>
                 </p>

                 <label>メモ</label>
                              <input name=memo_data[]>
                 <hr>"; // 分割線
            }
            echo "<input type=submit value=送信>";
            echo "</form>";
        } else {
            throw new Exception("データが見つかりませんでした");
        }
    } else {
        throw new Exception("HTMLからのPOST送信受信に失敗しました");
    }
} catch (Exception $e) {
    echo "エラーが発生しました: ".$e->getMessage();
}
?>



