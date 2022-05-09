<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Socket io app</title>
    </head>
    <body>
        <ul class="chat">
        @foreach ($messages as $message)
            <li>
                <b>{{ $message->author }}</b>
                <p>{{ $message->content }}</p>
            </li>
        @endforeach
        </ul>
        <hr>
        <form action="/chat/message" method="POST">
            <input type="text" name="author">
            <br>
            <br>
            {{ csrf_field() }}
            <textarea name="content" style="width:100%;height:50px"></textarea>
            <input type="submit" value="Отправить">
        </form>

        <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.2.0/socket.io.min.js" integrity="sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj" crossorigin="anonymous"></script>

        <script>
        const socket = io(':6001', { transports: ['websocket'] });

            function appendMessage(data) {
                $('.chat').append(
                    $('<li/>').append(
                        $('<b/>').text(data.author),
                        $('<p/>').text(data.content),
                    )
                );
            }

            $('form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '/chat/message',
                    data : $('form').serialize(),
                });
                $('input[name="author"]').val('');
                $('textarea[name="content"]').val('');
            });

            socket.on('laravel_database_chat:message', function(data) {
                appendMessage(data);
                console.log(data);
            });

        </script>
    </body>
</html>
