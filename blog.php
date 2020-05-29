<?php
require_once('dbc.php');

Class Blog extends Dbc
{
    protected $table_name = 'blog';
    //3.カテゴリー名を表示
    //引数：数字
    //返り値：カテゴリーの文字列
    public function setCategoryName($category){
        if($category === '1'){
            return '日常';
        }else if($category === '2'){
            return 'プログラミング';
        }else{
            return 'その他';
        }
    }
    public function blogCreate($blogs){
        $sql = "INSERT INTO
            $this->table_name(title,content,category,publish_status)
        VALUES
            (:title,:content,:category,:publish_status)";  //:title：タイトルの中身

        $dbh = $this->dbConnect();
        $dbh->beginTransaction(); //必ず開始する前に
        try{
            $stmt=$dbh->prepare($sql); //値が固定で無いSQLを使う場合には、queryメソッドではなくprepareメソッドを使うのが基本
            $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
            $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
            $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_STR);
            $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_STR);
            $stmt->execute();
            $dbh->commit();  //実行が終わった後に
            echo 'ブログを投稿しました！';
        }catch(PDOException $e){
            $dbh->rollBack();  //エラーが起こった時に
            exit($e);
        }
    }

    public function blogUpdate($blogs){
        $sql = "UPDATE $this->table_name SET       
                    title = :title,content = :content,category = :category,publish_status = :publish_status
                WHERE
                    id = :id";  //:title：タイトルの中身

    $dbh = $this->dbConnect();
    $dbh->beginTransaction(); //必ず開始する前に
    try{
        $stmt=$dbh->prepare($sql); //値が固定で無いSQLを使う場合には、queryメソッドではなくprepareメソッドを使うのが基本
        $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
        $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
        $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_STR);
        $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_STR);
        $stmt->bindValue(':id',$blogs['id'],PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit();  //実行が終わった後に
        echo 'ブログを更新しました！';
    }catch(PDOException $e){
        $dbh->rollBack();  //エラーが起こった時に
        exit($e);
    }
    }

    // ブログのバリデーション
    public function blogValidate($blogs){
        if(empty($blogs['title'])){
            exit('タイトルを入力してください');
        }
    
        if(mb_strlen($blogs['title'])>191){  //mb_strlen — 文字列の長さを得る
            exit('タイトルは191文字以下にしてください');
        }
    
        if(empty($blogs['content'])){
            exit('本文を入力してください');
        }
    
        if(empty($blogs['category'])){
            exit('カテゴリーは必須です');
        }
    
        if(empty($blogs['publish_status'])){
            exit('公開ステータスは必須です');
        }
    }
}

?>