

<?php
header('Content-Type: text/html; charset=utf-8');
header("X-Frame-Options: SAMEORIGIN");
include 'function.php';
$pdo = getPdoInstance();



  session_start([
      // 'cookie_lifetime' => 100,
  ]);

  sessionControl();
  // $name=$_SESSION["id"];
  



  // if(isset($name)){
  //           echo "ようこそ、".$name."さん！";
  //           echo("<br/>");
  //         }else{
  //           header('Location:login.html');
  //           exit;}

  $sql = "SELECT * FROM form";
  $stmt = $pdo->prepare($sql);
  $stmt -> execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $row) {

    echo "
 
        <p>会社名: ". htmlspecialchars($row["company_name"], ENT_QUOTES, 'UTF-8'). "</p>
        <p>お名前: ".htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')."</p>
        <p>メールアドレス: ". htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8'). "</p>
        <p>お問い合わせ種別: ". htmlspecialchars($row["inquiryType"], ENT_QUOTES, 'UTF-8'). "</p>
        <p>お問い合わせ内容: ". htmlspecialchars($row["message"], ENT_QUOTES, 'UTF-8'). "</p>
        <p>登録日時: ". htmlspecialchars($row["updated_at"], ENT_QUOTES, 'UTF-8'). "</p>
        <p>メモ: ". htmlspecialchars($row["memo"], ENT_QUOTES, 'UTF-8'). "</p>
        <hr> <!-- 分割線 -->";
    
  }
  


?>


      













        