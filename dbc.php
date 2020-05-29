<?php

    // 1.configをつくってDB接続値を定義
    // 2.htmlspecialcharsについて（セキュリティ）
    // 3.削除機能をつくる

    // 1.staticを使ってみる
    // 2.アクセス修飾子をつける
    // 3.コンストラクタを理解する
    // 4.継承を使ってみる

    // namespace BLog\Dbc;

    //詳細画面を表示する流れ
    //1.一覧画面からブログのidを送る
    //GETリクエストでidをURLにつけて送る

    //2.詳細ページでidを受け取る
    //PHPの$_GETでidを取得

    //3.idをもとにデータベースから記事を
    //SELECT文でプレースホルダーを使う

    //関数一つに一つの機能のみを持たせる
    //1.データベース接続
    //2.データを取得する
    //3.カテゴリー名を表示
require_once('env.php');

Class Dbc
{
    protected $table_name;

    //1.データベース接続
    //引数：なし
    //返り値：接続結果を返す
    protected function dbConnect(){     //このファイルでも使い、他のファイルでも使っている。
        $host = DB_HOST;
        $dbname = DB_NAME;       
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        } catch(PDOException $e){
            echo '接続失敗'. $e->getMessage();
            exit();
        };

        return $dbh;
    }

    //2.データを取得する
    //引数:なし
    //返り値：取得したデータ
    public function getAll(){    //他のファイルでも使ってる
        $dbh = $this->dbConnect();
        // 1SQLの準備
        $sql = "SELECT * FROM $this->table_name";
        // 2SQLの実行
        $stmt= $dbh->query($sql);
        // 3SQLの結果を受け取る
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;
        $dbh = null;
    }




    // 引数：$id
    // 返り値：$result
    public function getById($id){
        if(empty($id)){
            exit('IDが不正です');
        }

        $dbh = $this->dbConnect();

        //SQL準備
        $stmt=$dbh->prepare("SELECT*FROM $this->table_name where id = :id");
        $stmt->bindValue(':id',(int)$id,PDO::PARAM_INT);  //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )

        //SQL実行
        $stmt->execute();
        //結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //今回は一つのみ
        // var_dump($result)

        if(!$result){
            exit('ブログがありません。');
        }

        return $result;
    }

        public function delete($id){
            if(empty($id)){
                exit('IDが不正です');
            }
    
            $dbh = $this->dbConnect();
    
            //SQL準備
            $stmt=$dbh->prepare("DELETE FROM $this->table_name where id = :id");
            $stmt->bindValue(':id',(int)$id,PDO::PARAM_INT);  //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
    
            //SQL実行
            $stmt->execute();
            echo 'ブログを削除しました!';   

        }

}

?>
