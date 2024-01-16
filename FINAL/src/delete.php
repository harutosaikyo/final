<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517375-final';
const USER = 'LAA1517375';
const PASS = 'Pass0703';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>楽曲削除</title>
</head>
<body>

<?php
$pdo = new PDO($connect, USER, PASS);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['music_id'])) {
    $music_id = $_POST['music_id'];
    $sql = $pdo->prepare('DELETE FROM music WHERE music_id = ?');
    if ($sql->execute([$music_id])) {
        echo '削除に成功しました。';
    } else {
        echo '削除に失敗しました。';
    }
}

echo '<br><hr><br>';
?>

<table>
    <tr>
        <th>楽曲番号</th>
        <th>楽曲名</th>
        <th>アーティスト名</th>
    </tr>

<?php
$stmt = $pdo->query('SELECT * FROM music');

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>', $row['music_id'], '</td>';
    echo '<td>', $row['music_name'], '</td>';
    echo '<td>', $row['artist_name'], '</td>';
    echo '</tr>';
    echo "\n";
}
?> 
</table>

<form action="index.php" method="post">
    <button type="submit">トップへ戻る</button>
</form>

</body>
</html>
