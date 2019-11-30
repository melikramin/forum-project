<?php
    if (!isset($_COOKIE['login'])){
      header('location: /auth.php');
    exit();
    }
  ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
        $website_title='Добавить статьи';
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
            
        <h4>Добавить статью</h4>
        <form action="" method="post">
          <label for="title">Заголовок:</label>
          <input type="text" name="title" id="title" class="form-control">

          <label for="intro">Интро статьи:</label>
          <textarea name="intro" id="intro" class="form-control"></textarea>

          <label for="text">Текст статьи:</label>
          <textarea name="text" id="text" rows="10" class="form-control"></textarea>

          <div class="alert alert-danger mt-2" id="errorBlock"></div>

          <button type="button" id="article_send" class="btn btn-success mt-5">Добавить</button>
          <p id="add_alert"></p>
        </form>
            

        </div>

        <!-- my right sidebar -->
        <?php require 'blocks/aside.php';?>
    
    </div>

</div>

<!-- my steacky footer -->
<?php require 'blocks/footer.php';?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script>
  $('#article_send').click( function(){
      var title = $('#title').val();
      var intro = $('#intro').val();
      var text = $('#text').val();
     

      $.ajax({
        url: 'ajax/add_article.php',
        type: 'POST',
        cache: false,
        data: {'title' : title, 'intro' : intro, 'text' : text},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово') {
            $('#article_send').text('Добавить');
            $('#add_alert').text('Добавлено в базу');
            $('#errorBlock').hide();
            $('#title').val('');
            $('#intro').val('');
            $('#text').val('');
            //location.href = 'auth.php';
          } else {
            $('#errorBlock').show();
            $('#errorBlock').text(data);
          }
        }
      });


  });
</script>

</body>
</html>