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
    <title>楽曲更新output</title>
</head>
<body>
<?php
$pdo = new PDO($connect, USER, PASS);

// music_idがPOSTされたかどうかを確認
if (isset($_POST['music_id'])) {
    $musicId = $_POST['music_id'];

    // SQLインジェクション対策のためにプレースホルダを使用
    $sql = $pdo->prepare('SELECT * FROM music WHERE music_id = ?');
    $sql->execute([$musicId]);

    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo '<table>';
        echo '<tr><th>楽曲番号</th><th>楽曲名</th><th>アーティスト名</th></tr>';
        echo '<tr>';
        echo '<td>', $row['music_id'], '</td>';
        echo '<td>', $row['music_name'], '</td>';
        echo '<td>', $row['artist_name'], '</td>';
        echo '</tr>';
        echo '</table>';
        
        echo '<hr>';
        
        if (empty($_POST['music_name'])) {
            echo '楽曲名を入力してください。';
        } elseif (empty($_POST['artist_name'])) {
            echo 'アーティスト名を入力してください。';
        } else {
            // SQL文を準備
            $updateSql = $pdo->prepare('UPDATE music SET music_name = ?, artist_name = ? WHERE music_id = ?');

            // SQLを実行
            if ($updateSql->execute([htmlspecialchars($_POST['music_name']), $_POST['artist_name'], $musicId])) {
                echo '更新に成功しました。';
            } else {
                echo '更新に失敗しました。';
            }
        }
    } else {
        echo 'データがありません。';
    }
} else {
    echo 'データがありません。';
}

// 他の処理や表示を追加する場合はここに記述する

?>

<button onclick="location.href='index.php'">トップに戻る</button>

</body>
</html>
