<?php
try {
    $db_name = 'gs_db5'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM gs_an_table;');
$status = $stmt->execute();

$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result['title'];
        $view .= '</a>';
        $view .= '</li>';
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>投稿リスト</title>
    </head>
    <body>
        <h1>投稿リスト</h1>
        <ul>
            <?= $view ?>
        </ul>
    </body>
</html>
