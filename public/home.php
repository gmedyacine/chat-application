<h1>Bienvenue sur votre application de chat</h1>
<a href="/?p=chat.logout">Déconnection</a>

<h2>Liste des utilisateurs connectés</h2>
<ul id="users"></ul>

<h2>Messages</h2>
<ul id="messages"></ul>

<form method="post">
    <textarea rows="4" name="content"></textarea>
    <br/>
    <input type="submit" name="Envoyer">
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    refresh();

    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/?p=chat.refresh",
                success: function (data) {
                    $("#messages").empty();
                    for (message in data) {
                        $("#messages").append('<li><strong>' + data[message].user + '</strong> <i>[' + data[message].createdAt + ']</i> :' + data[message].content + '</li>');
                    }
                }
            });

        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/?p=chat.checkConnection",
                success: function (data) {
                    $("#users").empty();
                    for (message in data) {
                        $("#users").append('<li>' + data[message] + '</li>');
                    }
                }
            });
    }
</script>