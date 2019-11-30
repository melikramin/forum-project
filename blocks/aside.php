<aside class="col-md-4">
  <div class="p-3 mb-3 bg-warning rounded">
    <h4><b>Интересные факты</b></h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iste quas possimus consequuntur, laborum, mollitia nemo, alias tempora quasi sunt aperiam animi at. Architecto totam, ullam repudiandae voluptatum, sit sed.</p>
  </div>
  <div class="p-3 mb-3">
    <img class="img-thumbnail" src="https://itproger.com/img/courses/1534230100.jpg">
  </div>

  <style>
    .allMessages {
      max-height: 300px;
      overflow: none;
      margin-bottom: 20px;
    }
  </style>

  <div class="p-3 mb-3">
    <div class="allMessages">
      <?php
        // Выводим все записи из БД и помещаем кажду из них в качестве блока
        require_once 'mysql_connect.php';

        $sql = 'SELECT * FROM `chat` ORDER BY `id` DESC LIMIT 3';
        $query = $pdo->prepare($sql);
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        // Если сообщений ноль, то выводим сообщение что записей еще нет
        if(count($messages) == 0)
          echo '<div class="alert alert-warning">Пока сообщений еще нет</div>';
        else {
          foreach($messages as $el)
            echo '<div class="alert alert-info">'.$el['message'].'</div>';
        }
      ?>
    </div>
    <form action="" method="post">
      <input type="text" id="chat_message" placeholder="Сообщение" class="form-control"><br>
      <button type="button" class="btn btn-success" id="send_to_chat">Отправить</button>
    </form>
  </div>
</aside>
