<?php
// POSTデータ確認
$No = $_POST['No'];
$name = $_POST['name'];
$pass = $_POST['pass'];

// DB接続
// 各種項目設定
$dbn ='mysql:dbname=menberlist_database01;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行
$sql = 'INSERT INTO menber_list (id, No , name , pass) VALUES (NULL, :No, :name, :pass)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':No', $No, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理

header('Location:top_input.php');
exit();

?>

<!-- var_dump($sql);
exit(); -->