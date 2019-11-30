<footer class="footer">
  <div class="container">
    <span class="text-muted">Все права защищены</span>
  </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  // При нажатии на кнопку отправить происходит добавлении записи в таблицу БД
  // Все происходит в формате Ajax запроса
  $('#send_to_chat').click(function () {
    var message = $('#chat_message').val();

    $.ajax({
      url: '/ajax/chat_message.php',
      type: 'POST',
      cache: false,
      data: {'message' : message},
      dataType: 'html',
      success: function(data) {
        // Очищаем поле от текста что ввел пользователь
        $('#chat_message').val("");
      }
    });
  });

  // Устанавливаем интервал, который вызывает ajax запрос каждые 3 секунды
  // Через ajax запрос мы получаем все сообщения и добавляем их постоянно в блок с сообщениями
  setInterval(function() {
    $.ajax({
      url: '/ajax/get_messages.php',
      type: 'POST',
      cache: false,
      dataType: 'html',
      success: function(data) {
        // В data мы получаем весь HTML чтобы сразу установить его в блок
        $(".allMessages").html(data);
      }
    });
  }, 2000);
</script>


<!-- Скрываем элементы -->
<script>

  $(".alert-info").click(function(){
    $(this).hide();
  });

</script>

