<!DOCTYPE html>
 <html>
 <head>
    <meta charset='utf-8'>
    <title>楽曲登録input</title>
 </head>
 <body>
    <p>楽曲を追加します。</p>
    <form action="toroku-output.php" method="post">
        楽曲番号<input type="text" name="music_id"><br>
        楽曲名<input type="text" name="music_name"><br>
        アーティスト名<input type="text" name="artist_name"><br>
        <button type="submit">追加</button>
    </form>
    
 </body>
 </html>