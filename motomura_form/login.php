<?php
    header('Content-Type: text/html; charset=utf-8');
    header("X-Frame-Options: SAMEORIGIN");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>login</title>
</head>
<body>
<h2>Login</h2>
<form action="/userinfo.php" method="post" name="login_form">
	<table>
		<tr class="">
			<p class="form_caution">全項目が必須入力です。</p>
		</tr>
		<tr class="">
			<th><label for="id">ID</label></th>
			<td><input type="text" name="id" required></td>
		</tr>
		<tr class="">
			<th><label for="password">Password</label></th>
			<td><input type="password" name="password" required></td>
			<input type="hidden" name="hiddenInfo" value="chatplus">
			
		</tr>
        
	</table>
    <button type="submit">送信</button>


</form>




</body>
</html>

