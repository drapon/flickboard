<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>メール送信</title>
</head>
<body>
<p>ようこそ<?php echo $name;?>さん</p>
<p>flickboardへご登録いただきありがとうございます。<br>
現在は【仮登録】になります。下記のボタンをクリックして【本登録】を完了させてください。<br>
※下記リンクの有効期限は１週間です
</p>
<div>
	<a style="background-color:#50B6D4;color:#fff;padding:1.0em;text-align:center;" 
	href="http://www.flickboard.jp/login/activate/<?php echo $activate;?>">本登録する</a>
</div>
</body>
</html>