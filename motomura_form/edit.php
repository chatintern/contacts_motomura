<?php


include 'function.php';

header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
$pdo = getPdoInstance();

session_start();
sessionControl();
// $name = isset($_SESSION['id'])? htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'UTF-8') : null;

// if ($name === null) {

//     header('Location: login.html');
//     exit;
// } else {

//     echo "ようこそ、". htmlspecialchars($name, ENT_QUOTES, 'UTF-8'). "さん！<br/>";
// }
$sql = "SELECT * FROM form";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <title>Form Example</title>
</head>
<body>
<form action="update.php" method="post">
<?php foreach ($result as $row) :?>
    <input type="checkbox" name="data[]" value="<?php echo htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8');?>">
    <p>会社名: <?php echo htmlspecialchars($row["company_name"], ENT_QUOTES, 'UTF-8');?></p>
    <p>お名前: <?php echo htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8');?></p>
    <p>メールアドレス: <?php echo htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8');?></p>
    <p>お問い合わせ種別: <?php echo htmlspecialchars($row["inquiryType"], ENT_QUOTES, 'UTF-8');?></p>
    <p>お問い合わせ内容: <?php echo htmlspecialchars($row["message"], ENT_QUOTES, 'UTF-8');?></p>
    <p>登録日時: <?php echo htmlspecialchars($row["updated_at"], ENT_QUOTES, 'UTF-8');?></p>
    <p>メモ: <?php echo htmlspecialchars($row["memo"], ENT_QUOTES, 'UTF-8');?></p>

    <hr> <!-- 分割線 -->
<?php endforeach;?>
<input type="submit" value="編集する">
</form>
</body>
</html>



