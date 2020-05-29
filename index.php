<?php
require_once('blog.php');

//取得したデータを表示している
// use Blog\Dbc;

// 1.編集ボタンクリックでIDを送る
// 2.IDを受け取り内容を表示
// 3.編集データとIDを渡す
// 4.IDから探してDBを更新する

$blog = new Blog();
$blogData = $blog->getAll();
function h($s){
    return htmlspecialchars($s, ENT_QUOTES,"UTF-8"); // htmlspecialchars( 変換対象, 変換パターン, 文字コード ),
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>
<body>
    <h2>ブログ一覧</h2>
    <p><a href="/PHP-2/form.html">新規作成</a></p>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
        </tr>
        <?php foreach($blogData as $column): ?>      
        <tr>
            <td><?php echo h($column['title']) ?></td>
            <td><?php echo h($blog->setCategoryName($column['category'])) ?></td>
            <td><?php echo h($column['post_at']) ?></td>
            <td><a href="/PHP-2/detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
            <td><a href="/PHP-2/update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
            <td><a href="/PHP-2/blog_delete.php?id=<?php echo $column['id'] ?>">削除</a></td>
        </tr>
        <?php endforeach; ?>
        <!-- 
            foreach($array as $element): 
                //
            endforeach; 
        -->
    </table> 
</body>
</html>