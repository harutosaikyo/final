<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517375-final';
const USER = 'LAA1517375';
const PASS = 'Pass0703';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>楽曲更新edit</title>
</head>
<body>
<table>
    <tr>
        <th>楽曲番号</th>
        <th>楽曲名</th>
        <th>アーティスト名</th>
    </tr>
    <?php
    $pdo = new PDO($connect, USER, PASS);

    // music_idがPOSTされたかどうかを確認
    if(isset($_POST['music_id'])) {
        $musicId = $_POST['music_id'];

        // SQLインジェクション対策のためにプレースホルダを使用
        $sql = $pdo->prepare('SELECT * FROM music WHERE music_id = ?');
        $sql->execute([$musicId]);

        foreach ($sql as $row) {
            echo '<tr>';
            echo '<form action="edit-output.php" method="post">';
            echo '<td>';
            echo '<input type="text" name="music_id" value="' . $row['music_id'] . '">';
            echo '</td>';
            echo '<td>';
            echo '<input type="text" name="music_name" value="' . $row['music_name'] . '">';
            echo '</td>';
            echo '<td>';
            echo '<input type="text" name="artist_name" value="' . $row['artist_name'] . '">';
            echo '</td>';
            echo '<td><input type="submit" value="更新"></td>';
            echo '</form>';
            echo '</tr>';
            echo "\n";
        }
    } else {
        echo '<tr><td colspan="4">データがありません</td></tr>';
    }
    ?>
</table>
<button onclick="location.href='index.php'">トップへ戻る</button>
</body>
</html>
