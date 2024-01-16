
<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1517375-final';
    const USER = 'LAA1517375';
    const PASS = 'Pass0703';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>楽曲登録output</title>
</head>
<body>
<button onclick="location.href='index.php'">トップへ戻る</button>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('insert into music(music_id, music_name, artist_name) values (?, ?, ?)');
    if (!preg_match('/^\d+$/',$_POST['music_id'])){
        echo '楽曲番号で整数を入力してください。';
    }elseif (empty($_POST['music_name'])){
        echo '楽曲名を入力してください。';
    }elseif (empty($_POST['artist_name'])){
        echo 'アーティスト名を入力してください。';
    }elseif ($sql->execute([ $_POST['music_id'], $_POST['music_name'], $_POST['artist_name']])){
        echo '<font color="red">追加に成功しました。</font>';
    } else{
        echo '<font color="red">追加に失敗しました。</font>';
    }
?>
    <br><hr><br>
    <table>
        <tr><th>楽曲番号</th><th>楽曲名</th><th>アーティスト名</th></tr>
<?php
    foreach ($pdo->query('select * from music') as $row){
        echo '<tr>';
        echo '<td>',$row['music_id'], '</td>';
        echo '<td>',$row['music_name'], '</td>';
        echo '<td>',$row['artist_name'], '</td>';
        echo '<tr>';
        echo "\n";
    }
?>
    </table>
    <form action="toroku-input.php" method="post">
        <button type="submit">追加画面へ戻る</button>
    </form>



</body>
</html>
    
