<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once 'mysql_connect.php';
    $sql = 'SELECT * FROM `articles` WHERE `id`= :id';
    //$id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);
    
    $article=$query->FETCH(PDO::FETCH_OBJ);

    $website_title=$article->title;;
    require 'blocks/head.php';
?>

</head>
<body>

<!-- my header & top menu -->
<?php require 'blocks/header.php';?>

<!-- my content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">

        <div class="jumbotron">
            <h1><?=$article->title?></h1>
            <p><b>Автор статьи:</b> <mark><?=$article->avtor?></mark></p>
            <?php
               $timezone  = +3; //(GMT -5:00) EST (U.S. & Canada)   
            ?>
            <p><b>Дата публикации:</b> <i><?=gmdate("d/m/Y H:i:s", $article->date + 3600*($timezone+date("I")))?></i></p>
          

            <p>
                <?=$article->intro?>
                <br><br>
                <?=$article->text?>
            </p>
        </div>

        <!-- Коментарии -->
        <h3 class="mt-5">Коментарии</h3>
        <?php
            $uservalue="";
            $userreadonly="";
            if (isset($_COOKIE['login'])){
                $userreadonly="readonly";
                $uservalue=$_COOKIE['login'];
            }
            else {
                $uservalue="";
                $userreadonly="autofocus";
            }



        ?>


        <form action="news.php?id=<?=$_GET['id']?>" method="post">
          <label for="username">Ваше имя</label>
          <input type="text" name="username" id="username" value="<?=$uservalue?>" class="form-control" <?=$userreadonly?>>

          <label for="mess">Сообщение</label>
          <textarea name="mess" id="mess" rows="5" class="form-control"></textarea>

          <!-- <div class="alert alert-danger mt-2" id="errorBlock"></div> -->

          <button type="submit" id="mess_send" class="btn btn-success mt-5 mb-5">
            Добавить коментарий
          </button>
        </form>

        <?php
            if (isset($_POST['username']) && $_POST['username']!='' && $_POST['mess']!=''){
                $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
                $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

                $sql = 'INSERT INTO comments(name, mess, article_id) VALUES(?, ?, ?)';
                $query = $pdo->prepare($sql);
                $query->execute([$username, $mess, $_GET['id']]);

                // unset post data
               unset($_POST);
            //    $_POST['username']="";
            //    $_POST['mess']="";

            }

            $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
            $query = $pdo->prepare($sql);
            $query->execute(['id'=>$_GET['id']]);
            $comments = $query->fetchall(PDO::FETCH_OBJ);

            foreach ($comments as $comment) {
                echo "<div class='alert alert-info'>
                <h4>$comment->name</h4>
                <p>$comment->mess</p>
                </div>";
            }
        ?>

        </div>

        <!-- my right sidebar -->
        <?php require 'blocks/aside.php';?>
    
    </div>

</div>

<!-- my steacky footer -->
<?php require 'blocks/footer.php';?>

    
</body>
</html>