<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
        $website_title='Наши контакты';
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
            
        <h4>Обратная связь</h4>
        <form action="" method="post">
          <label for="username">Ваше имя</label>
          <input type="text" name="username" id="username" class="form-control">

          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">

          <label for="mess">Сообщение</label>
          <textarea name="mess" id="mess" rows="10" class="form-control"></textarea>

          <div class="alert alert-danger mt-2" id="errorBlock"></div>

          <button type="button" id="mess_send" class="btn btn-success mt-3">
            Отправить сообщение
          </button>
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
  $('#mess_send').click( function(){
    var name = $('#username').val();
      var email = $('#email').val();
      var mess = $('#mess').val();
  

      $.ajax({
        url: 'ajax/mail.php',
        type: 'POST',
        cache: false,
        data: {'username' : name, 'email' : email, 'mess' : mess},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово') {
            $('#reg_user').text('Все готово');
            $('#errorBlock').hide();
            //location.href = 'auth.php';
            $('#username').val("");
            $('#email').val("");
            $('#mess').val("");

          } else {
            $('#errorBlock').show();
            $('#errorBlock').html(data);
          }
        }
      });


  });
</script>

</body>
</html>