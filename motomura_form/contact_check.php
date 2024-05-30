<?php








try {
    if ($_POST) {
        // 各POSTデータに対してエスケープ処理を行う
        $companyName = htmlspecialchars($_POST["companyName"], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $inquiryType = htmlspecialchars($_POST["inquiryType"], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
        echo "
        <form action='contact.php' method='POST'>
        <div>
            <label for='companyName'>会社名：</label>
            <p><input type='text' id='companyName' name='companyName' readonly value='{$companyName}'></p>
        </div>
        <div>
            <label for='name'>お名前：</label>
            <p><input type='text' id='name' name='name' readonly value='{$name}'></p>
        </div>
        <div>
            <label for='email'>メールアドレス：</label>
            <p><input type='text' id='email' name='email' readonly value='{$email}'></p>
        </div>
        <div>
            <label for='inquiryType'>お問い合わせ種別:</label>
            <p><input type='text' id='inquiryType' name='inquiryType' readonly value='{$inquiryType}'></p>
        </div>
        <div>
            <label for='message'>お問い合わせ内容</label>
            <p><input type='text' id='message' name='message' readonly value='{$message}'></p>
        </div>
        <p>この内容で登録する</p>
        <button type='submit'>はい</button>
        </form>";
    } else {
        throw new Exception("HTMLからのPOST送信受信に失敗しました");
    }
} catch (Exception $e) {
    echo "エラーが発生しました: ". $e->getMessage();
}

?>
