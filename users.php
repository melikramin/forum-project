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
    $website_title = "Список пользователей";
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        
        <h4>Список пользователей</h4>

             <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Login</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php
                require_once 'mysql_connect.php';
                $query = $pdo->query('SELECT * FROM `users` ORDER BY `ID`');
                while($row = $query->fetch(PDO::FETCH_OBJ)) {
                  echo '<tr>
                          <td>' . $row->name . '</td>
                          <td>' . $row->email . '</td>
                          <td>' . $row->login . '</td>
                          <td>' . '<button class="delete">Delete</button>' . '</td>
                        </tr>';
                }
              ?>
      </tbody>

    </table>


        
      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>

  <?php require 'blocks/footer.php'; ?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <script>

        $('.delete').click(function() {
        
            var clickID = $(this).closest('tr').find('td').eq(2).text();
           // alert(clickID);

             var username = clickID;

             $.ajax({
                url: 'ajax/delete.php',
                type: 'POST',
                cache: false,
                data: {'username' : username},
                dataType: 'html',
                success: function(data) {
                    document.location.reload(true);
                }
            });
      
        });

    
    </script>

  <script>

    $('#auth_user').click(function () {
      var login = $('#login').val();
      var pass = $('#pass').val();

      $.ajax({
        url: 'ajax/auth.php',
        type: 'POST',
        cache: false,
        data: {'login' : login, 'pass' : pass},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово') {
            $('#auth_user').text('Готово');
            $('#errorBlock').hide();
            document.location.reload(true);
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
