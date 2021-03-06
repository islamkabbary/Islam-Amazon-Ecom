<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background: #7F7FD5;
            background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        }

        .element {
            display: inline;
            align-items: center;
        }

        i.fa-paperclip {
            /* margin: 10px; */
            cursor: pointer;
            font-size: 17px;
        }

        i:hover {
            opacity: 0.6;
        }

        input {
            display: none;
        }

        .chat {
            margin-top: auto;
            margin-bottom: auto;
        }

        .card {
            height: 500px;
            border-radius: 15px !important;
            background-color: rgba(0, 0, 0, 0.4) !important;
        }

        .contacts_body {
            padding: 0.75rem 0 !important;
            overflow-y: auto;
            white-space: nowrap;
        }

        .msg_card_body {
            overflow-y: auto;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 0 !important;
        }

        .card-footer {
            border-radius: 0 0 15px 15px !important;
            border-top: 0 !important;
        }

        .container {
            align-content: center;
        }

        .search {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
        }

        .search:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .type_msg {
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            height: 60px !important;
            overflow-y: auto;
        }

        .type_msg:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .attach_btn {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .send_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .search_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .contacts {
            list-style: none;
            padding: 0;
        }

        .contacts li {
            width: 100% !important;
            padding: 5px 10px;
            margin-bottom: 15px !important;
        }

        .active {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .user_img {
            height: 70px;
            width: 70px;
            border: 1.5px solid #f5f6fa;

        }

        .user_img_msg {
            height: 40px;
            width: 40px;
            border: 1.5px solid #f5f6fa;

        }

        .img_cont {
            position: relative;
            height: 70px;
            width: 70px;
        }

        .img_cont_msg {
            height: 40px;
            width: 40px;
        }

        .online_icon {
            position: absolute;
            height: 15px;
            width: 15px;
            background-color: #4cd137;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border: 1.5px solid white;
        }

        .offline {
            background-color: #c23616 !important;
        }

        .user_info {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }

        .user_info span {
            font-size: 20px;
            color: white;
        }

        .user_info p {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
        }

        .video_cam {
            margin-left: 50px;
            margin-top: 5px;
        }

        .video_cam span {
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }

        .msg_cotainer {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }

        .msg_cotainer_send {
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 25px;
            background-color: #78e08f;
            padding: 10px;
            position: relative;
        }

        .msg_time {
            position: absolute;
            left: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_time_send {
            position: absolute;
            right: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_head {
            position: relative;
        }

        #action_menu_btn {
            position: absolute;
            right: 10px;
            top: 10px;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .action_menu {
            z-index: 1;
            position: absolute;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 15px;
            top: 30px;
            right: 15px;
            display: none;
        }

        .action_menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .action_menu ul li {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        .action_menu ul li i {
            padding-right: 10px;

        }

        .action_menu ul li:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }

        @media(max-width: 576px) {
            .contacts_card {
                margin-bottom: 15px !important;
            }
        }

    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ul class="contacts">
                            @foreach ($chats as $key => $chat)
                                <li class="chats-for-user" user-id="{{ $chat[0]->sender_id }}"
                                    user-name="{{ $chat[0]->sender->name }}">
                                    <div class="d-flex bd-highlight" style="cursor: pointer">
                                        <div class="img_cont">
                                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                class="rounded-circle user_img">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>{{ $chat[0]->sender->name }}</span>
                                            <p>{{ $chat[0]->sender->name }} is online</p>
                                            <span id="lastMessage"></span></span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 chat" id="islam">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <span id="chatName"></span>
                                <p id="chatCount"></p>
                            </div>
                            <div class="video_cam">
                                <span><i class="fas fa-video"></i></span>
                                <span><i class="fas fa-phone"></i></span>
                            </div>
                        </div>
                        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                        <div class="action_menu">
                            <ul>
                                <li><i class="fas fa-user-circle"></i> View profile</li>
                                <li><i class="fas fa-users"></i> Add to close friends</li>
                                <li><i class="fas fa-plus"></i> Add to group</li>
                                <li><i class="fas fa-ban"></i> Block</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Message --}}
                    <div class="card-body msg_card_body" id="chatBody">
                    </div>
                    {{-- --- --}}
                    {{-- Send Message --}}
                    <div class="card-footer">
                        <form action="{{ route('sendMessages') }}" method="POST" file="true"
                            enctype="multipart/form-data" id="formId">
                            @csrf
                            <input type="hidden" name="reciver_id" id="reciverId">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"
                                            id="file1"></i>
                                        <input type="file" name="file" id="file">
                                    </span>
                                </div>
                                <textarea id="messageBody" name="message" class="form-control type_msg"
                                    placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text send_btn" id="sendMessage"><i
                                            class="fas fa-location-arrow"></i></button class="">
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                {{-- --- --}}
            </div>
        </div>
    </div>
    </div>
    <script>
        $('#islam').hide();
        $("#file1").click(function() {
            $("#file").trigger('click');
        });
        $('#file').on('change', function() {
            var val = $(this).val();
            $(this).siblings('span').text(val);
        })
        $(document).on('click', '.chats-for-user', function(event) {
            var self = $(this);
            $('#islam').show();
            $('#chatBody').attr('user-id', 'user_' + self.attr('user-id'))
            $("#reciverId").val(self.attr('user-id'))
            $.get("{{ URL::to('chats') }}/" + self.attr('user-id'), function(data) {
                $('.chats-for-user').removeClass('active');
                self.addClass('active');
                $('#chatName').text('Chat with ' + self.attr('user-name'))
                $('#chatCount').text(data.length + ' Messages')
                $('#chatBody').html("")
                var html = "";
                if (data.success == undefined) {
                    data.forEach(element => {
                        if (element.sender_id == self.attr("user-id")) {
                            if (element.file_path.length !== 0 && element.message !== null) {
                                html += `<div class="d-flex justify-content-start mb-4">`
                                element.file_path.forEach(image => {
                                    html +=
                                        `<img style="width: 300px; height: 300px;" class="img_cont_msg" src="` +
                                        image.full_path + `">`
                                })
                                html += ` <div class="msg_cotainer">
                                        ` + element.message + `
                                        <span class="msg_time">` + element.time + " " + "-" + " " + element.date + `</span>
                                    </div>
                            </div>`
                            } else if (element.message !== null) {
                                html += ` <div class="d-flex justify-content-start mb-4">
                                <div class="msg_cotainer">
                                        ` + element.message + `
                                        <span class="msg_time">` + element.time + " " + "-" + " " + element.date + `</span>
                                    </div>
                            </div>`
                            } else {
                                html += `<div class="d-flex justify-content-start mb-4">`
                                element.file_path.forEach(image => {
                                    html +=
                                        `<img style="width: 300px; height: 300px;" class="img_cont_msg" src="` +
                                        image.full_path + `">`
                                })
                            }
                        } else {
                            if (element.file_path.length !== 0 && element.message !== null) {
                                html += `<div class="d-flex justify-content-end mb-4">`
                                element.file_path.forEach(image => {
                                    html +=
                                        `<img style="width: 300px; height: 300px;" class="img_cont_msg" src="` +
                                        image.full_path + `">`
                                })
                                html += ` <div class="msg_cotainer_send">
                                        ` + element.message + `
                                        <span class="msg_time_send">` + element.time + " " + "-" + " " + element.date + `</span>
                                    </div>
                            </div>`
                            } else if (element.message !== null) {
                                html += `<div class="d-flex justify-content-end mb-4">
                                 <div class="msg_cotainer_send">
                                        ` + element.message + `
                                        <span class="msg_time_send">` + element.time + " " + "-" + " " + element.date + `</span>
                                    </div>
                            </div>`
                            } else {
                                html += `<div class="d-flex justify-content-end mb-4">`
                                element.file_path.forEach(image => {
                                    html +=
                                        `<img style="width: 300px; height: 300px;" class="img_cont_msg" src="` +
                                        image.full_path + `">`
                                })
                            }
                        }
                    });
                }
                $('#chatBody').append(html)
            })
        });
        $("#sendMessage").on("click", function(e) {
            var data = new FormData();
            if($('#file')[0].files[0]) data.append('file', $('#file')[0].files[0])
            data.append('_token', "{{ csrf_token() }}")
            data.append('reciver_id', $('#reciverId').val())
            data.append('message', $('#messageBody').val())
            $.ajax({
                url: "{{ URL::to('send-message') }}",
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    var html = "";
                    if (response.message && response.file_path.length !== 0) {
                        html += `<div class="d-flex justify-content-end mb-4">
                                <img style="width: 300px; height: 300px;" class="img_cont_msg" src="` + response
                            .file_path[0].full_path + `">
                                            <div class="msg_cotainer_send">
                                                ` + response.message + `
                                                <span class="msg_time_send">8:55 AM, Today</span>
                                            </div>`
                    } else if (response.message) {
                        html += `<div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            ` + response.message + `
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>`
                    } else {
                        html += `<div class="d-flex justify-content-end mb-4">
                        <img style="width: 300px; height: 300px;" class="img_cont_msg" src="` + response.file_path[0]
                            .full_path + `">`
                    }
                    $('#chatBody').append(html)
                    $('#messageBody').val(" ")
                },
            });
        });
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('33fb164cc6c0a6b54d94', {
            cluster: 'eu'
        });
        var auth = "{{ Auth::guard('store')->user()->id }}"
        var channel1 = pusher.subscribe('user_' + auth);
        channel1.bind('message', function(data) {
            if ($('#chatBody').attr('user-id') == 'user_' + data.chat.sender_id) {
                html = `<div class="d-flex justify-content-start mb-4">
                    <img style="width: 300px; height: 300px;" class="img_cont_msg" src="` + data.path.full_path + `">
                                                <div class="msg_cotainer">
                                                    ` + data.chat.message + `
                                                </div>
                                        </div>`
                $('#chatBody').append(html)
            }
        });
    </script>
</body>

</html>
