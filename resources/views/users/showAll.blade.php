@extends('layouts.app')

@section('style')
    <style>
        #users {
            display: flex;
            flex-direction: column;
            height: 315px;
            overflow: auto;
        }

        #users li {
            list-style: none;
        }

        .img-listUser {
            width: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .flex {
            display: flex;
        }

        .a-user {
            text-decoration: none;
        }

        .a-hover:hover {
            background-color: rgb(12, 229, 124);
        }

        ol,
        ul {
            padding-left: 0;
        }

        .box-chat {
            width: 100%;
            height: 200px;
            border: 1px solid #000;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .ip-chat {
            margin-right: 11px;
        }

        #user a {
            position: relative;
        }

        .status {
            position: absolute;
            width: 15px;
            height: 15px;
            background-color: green;
            border-radius: 50%;
            top: 60px;
            left: 56px;
        }

        #messages {
            padding: 10px;
        }

        #messages li {
            list-style: none;
        }

        .my-message {
            text-align: right;
            color: blue;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="row m-3">
                        <div class="col">
                            <div id="users">
                                @foreach ($users as $user)
                                    <a href="" id="link{{ $user->id }}"
                                        class="user-status a-user a-hover alert alert-hover alert-secondary">
                                        <img class="img-listUser" src="{{ $user->image }}" alt="">
                                        <span class="">{{ $user->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-secondary">
                                <ul id="messages" class="box-chat">

                                </ul>
                                <form action="" method="post">
                                    <div class="d-flex justify-content-center align-items-center ">
                                        <input type="text" id="message" class="form-control ip-chat" placeholder="Soạn tin nhắn">
                                        <input type="submit" class="btn btn-success" id="btnSend" value="Gửi">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        Echo.join('chat')
            .here(users => {
                users.forEach(item => {
                    const elementUser = document.querySelector(`#link${item.id}`);
                    let statusElement = document.createElement('div');
                    statusElement.classList.add('status');
                    if(elementUser) {
                        elementUser.appendChild(statusElement);
                    }
                });
            })
            .joining(user => {
                const elementUser = document.querySelector(`#link${user.id}`);
                let statusElement = document.createElement('div');
                statusElement.classList.add('status');
                if(elementUser) {
                    elementUser.appendChild(statusElement);
                }
            })
            .leaving(user => {
                const elementUser = document.querySelector(`#link${user.id}`);
                let statusElement = elementUser.querySelector('.status');
                if(statusElement) {
                    elementUser.removeChild(statusElement);
                }
            })
            .listen('UserOnline', e => {
                let messages = document.querySelector('#messages');
                let itemElement = document.createElement('li');
                itemElement.innerText = `${e.user.name}: ${e.message}`;

                if(e.user.id == '{{ Auth::user()->id }}') {
                    itemElement.classList.add('my-message');
                }

                messages.appendChild(itemElement);
            })

        let btnSend = document.querySelector('#btnSend');
        let message = document.querySelector('#message');

        btnSend.addEventListener('click', function(e) {
            e.preventDefault();
            axios.post('{{ route("chat.sendMessage") }}', {
                'message': message.value
            })
                .then(data => {
                    message.value = "";
                })
        })
    </script>

    <script type="module">
        // const usersElement = document.getElementById('users');

        // window.axios.get('/api/users')
        //     .then((response) => {
        //         const users = response.data;
        //         // console.log(users);
        //         users.forEach((user, index) => {
        //             const elementLi = document.createElement('li');
        //             elementLi.setAttribute('id', user.id);
        //             elementLi.setAttribute('class', 'flex')

        //             const elementABox = document.createElement('a');
        //             elementABox.setAttribute('href', `/chat/private/${user.id}`)
        //             elementABox.setAttribute('class', 'a-user a-hover alert alert-hover alert-secondary')

        //             const elementImg = document.createElement('img');
        //             elementImg.setAttribute('src', user.image);
        //             elementImg.setAttribute('class', 'img-listUser');

        //             const elementA = document.createElement('a');
        //             elementA.setAttribute('href', `/chat/private/${user.id}`)
        //             elementA.setAttribute('class', 'a-user')
        //             elementA.innerText = user.name;

        //             elementABox.appendChild(elementImg)
        //             elementABox.appendChild(elementA)

        //             usersElement.appendChild(elementABox);
        //         });
        //     })
    </script>
    <script type="module">
        Echo.channel('users')
            .listen('UserCreated', (e) => {
                const element = document.createElement('li');
            })
            .listen('UserUpdated', (e) => {

            })
            .listen('UserDeleted', (e) => {

            })
    </script>
@endsection