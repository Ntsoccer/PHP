<?php
    //変数
    const ID=1;
    $title="PHPテスト";
    $content='PHPテストです';
    $post_at='2020/05/26';
    $tag = 'プログラミング';
    $status=true; //公開 //非公開 false

    //ブログ2
    const ID2=2;
    $title2="PHPテスト2";
    $content2='PHPテストです2';
    $post_at2='2020/05/26';
    $tag2 = 'プログラミング2';
    $status2=true; //公開 //非公開 false



    //定数
    // const ID=1;

    // echo ID."<br>";
    // echo $title . "<br>";
    // echo $content. "<br>";
    // echo $post_at. "<br>";
    // print_r($tag). "<br>";

    //データ型
    // var_dump(ID);

    //""と''の違い
    // echo"<br>";
    // echo "タイトル：$title";
    // echo"<br>";
    // echo 'タイトル：$title';
    //''の方が処理速度が速い

   // 二つの記事データを配列に入れて、ループ処理で表示する：前半
   //ブログ1
    
    $blog1 = array(
        'id' => ID,
        'title' => $title,
        'content' => $content,
        'post_at' => $post_at,   
        'tag' => $tag,
        'status' => $status
    );

    //配列の取り出し方
    //配列の中から添字orキーを指定する
    // echo $blog1['id'];

    //[]を使うと
    //ブログ2
    $blog2 = [
        'id2' => ID2,
        'title2' => $title2,
        'content2' => $content2,
        'post_at2' => $post_at2,
        'tag' => $tag2,
        'status2' => $status2
    ];
    
    // echo '<pre>';
    // var_dump($blog2);
    // echo '</pre>';

    //多次元配列
    //配列の中に配列
    $blogs=[$blog1,$blog2];
    // echo '<pre>';
    // var_dump($blogs);
    // echo '</pre>';

    //ループ処理
    //foreachの練習
    //1バリューのみ出力
    foreach($blog1 as $blog){
        echo '<pre>';
        echo $blog;   //print_r()、var_dump() および var_export() は、オブジェクトの protected および private のプロパティも表示します。 静的なクラスメンバーは表示されません。
        echo '</pre>';
    }

    //2 キーとバリューの出力
    foreach($blog2 as $key => $value){
        echo '<pre>';
        echo $key.'='.$value;
        echo '</pre>';
    }

    //多次元配列blogsを展開するには？
    foreach($blogs as $blog){
        foreach($blog as $value){
            echo '<pre>'; 
            echo $value;
            echo '</pre>';
        }
    }




?>