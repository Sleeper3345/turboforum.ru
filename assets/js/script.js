function validFormPost(f) {
    var textarea = document.getElementById('com_text').value;
    if (textarea == '') {
        alert('Заполните поле комментария!');
    }
    else {
        f.submit();
    }
}

function checkPass(f) {
    var pass = md5(document.getElementById('pass').value);
    var nick = document.getElementById('login').value;
    $.ajax({
            type: "POST",
            url: "../action/check_password",
            data: {"nick": nick, "pass": pass},
            cache: false,
            success: function(response){
                var result = $.parseJSON(response);
                if (result == "false") {
                    alert('Неверный логин или пароль!');
                }
                else {
                    $('#pass').val(pass);
                    f.submit();
                }
            }
});
}

function send_mess(f) {
    var message = document.getElementById('mess').value;
    var user_to = parseGetParams();
    $.ajax({
            type: "POST",
            url: "../action/send_message",
            data: {"message": message, "to": user_to['to']},
            cache: false,
            success: function() {
                $('#mess').val('');
            }
    }
    );
}

function parseGetParams() {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for(var i=0; i<__GET.length; i++) {
        var getVar = __GET[i].split("=");
        $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
    }
    return $_GET;
}

function getMessages() {
    $('#chat_body').scrollTop(999999);
    var user_to = parseGetParams();
    setInterval(function() {
        var all_ids = document.getElementsByClassName('message');
        var last_id = all_ids.item(all_ids.length - 1).valueOf().dataset.id;
        $.ajax({
                type: "POST",
                url: "../action/get_last_messages",
                data: {"to": user_to['to'], "last_id": last_id},
                cache: false,
                success: function(response) {
                    var new_messages = $.parseJSON(response);
                    var i = 0;
                    if (JSON.stringify(new_messages).length > 2) {
                        while (new_messages[i] == null) {
                            i++;
                        }
                        while (new_messages[i] != null) {
                            $('#chat_body').append('<span ' + 'data-id="' + new_messages[i]['id'] + '"' + 'class="message"' + '>' + '[' + new_messages[i]['data'] + '] ' + '<a href="profile/' + new_messages[i]['user_nick'] + '"' + 'target="_blank"' + '>' + new_messages[i]['user_nick'] + '</a>: ' + new_messages[i]['text']);
                            i++;
                            $('#chat_body').scrollTop(999999);
                        }
                    }
                }
            }
        );
    }, 500);
}

function enterText() {
    var field = $('#mess').val();
    if (field != '') {
        $('#send_but').removeClass('dis');
        document.getElementById('send_but').disabled = false;
    }
    else {
        $('#send_but').addClass('dis');
        document.getElementById('send_but').disabled = true;
    }
}

function addCommentMinus(comment_id, user_id) {
    var comment = comment_id;
    var user = user_id;
    var rating = $('#com_rating_'+comment_id).html();
    $.ajax({
            type: "POST",
            url: "../../action/add_comment_minus",
            data: {"comment_id": comment, "user_id": user},
            cache: false,
            success: function(response) {
                var answer = $.parseJSON(response);
                if (answer == 'true') {
                    $('#com_rating_' + comment_id).html(parseInt(rating) - 1);
                }
            }
        }
    );
}

function addCommentPlus(comment_id, user_id) {
    var comment = comment_id;
    var user = user_id;
    var rating = $('#com_rating_'+comment_id).html();
    $.ajax({
            type: "POST",
            url: "../../action/add_comment_plus",
            data: {"comment_id": comment, "user_id": user},
            cache: false,
            success: function(response) {
                var answer = $.parseJSON(response);
                if (answer == 'true') {
                    $('#com_rating_' + comment_id).html(parseInt(rating) + 1);
                }
            }
        }
    );
}

function checkUser(f) {
    var login = $('#input_login').val();
    var pass = $('#input_pass').val();
    if ((login == '') || (pass == '')) {
        alert('Заполните все необходимые поля!');
    } else {
        $.ajax({
            type: "POST",
            url: "../../action/check_user_nick",
            data: {"nick": login},
            cache: false,
            success: function (response) {
                var answer = $.parseJSON(response);
                if (answer == 'false') {
                    alert('Пользователь с таким логином уже существует!');
                } else {
                    $('#input_pass').val(md5(pass));
                    f.submit();
                }
            }
        });
    }
}