@extends('layouts.app')

@section('styles')
    <style>
        #myModel {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            min-height: 100vh !important;
            transition: opacity 0.15s linear !important;
        }

        .modalMessageCreateGroup {
            background-color: #000000cf;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 350px !important;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <header>
            <h1>Drag & Drop<br /><span>Lean Kanban Board</span></h1>
        </header>

        <div class="border p-2 rounded-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modelCreateGroup">
                Tạo nhóm
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modelCreateGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo nhóm làm việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="groupName">Tên nhóm</label>
                                <input type="text" class="form-control" id="groupName" name="groupName"
                                    placeholder="Nhập tên nhóm...">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" id="btnAddBoardGroup" class="btn btn-primary"
                                data-user-id="{{ Auth::id() }}">Tạo nhóm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 p-3">
            <div class="col-md-6 border rounded-2 p-3">
                <h2 class="alert alert-warning">
                    NHÓM LÀM VIỆC CỦA BẠN
                </h2>
                <div class="d-flex flex-wrap groupBox">
                    @foreach ($myBoardGroup as $item)
                        <div class="card mb-3" style="margin-right: 10px; width: 193px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->board_name }}</h5>
                                <p style="font-size: 12px">Bạn đang là nhóm trưởng</p>
                                <a href="{{ route('boardGroup', $item->id) }}" class="btn btn-outline-success">Vào
                                    nhóm</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 border rounded-2 p-3">
                <h2 class="alert alert-warning">
                    BẠN ĐANG LÀM VIỆC TRONG NHÓM
                </h2>
                <div class="d-flex flex-wrap groupBox">
                    @foreach ($boardGroupNotLeader as $item)
                        <div class="card mb-3" style="margin-right: 10px; width: 193px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->board_name }}</h5>
                                <p style="font-size: 12px">Bạn đang là nhóm trưởng</p>
                                <a href="{{ route('boardGroup', $item->id) }}" class="btn btn-outline-success">Vào
                                    nhóm</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <footer>
            <p>Built with <a href="https://github.com/bevacqua/dragula" target="_blank">Dragula</a> and Vanilla JS by <a
                    href="http://nikkipantony.com" target="_blank">Nikki Pantony</a></p>
        </footer>
    </div>
@endsection

@section('scripts')
    <script type="module">
        const btnAddBoardGroup = document.querySelector('#btnAddBoardGroup');
        const groupName = document.querySelector('#groupName');
        const leader = btnAddBoardGroup.dataset.userId;

        btnAddBoardGroup.addEventListener('click', function() {
            let data = {
                board_name: groupName.value,
                leader: leader
            };

            axios.post("{{ route('createGroup') }}", data)
                .then(response => {
                    const btnClose = document.querySelector('.btn-close');
                    btnClose.click();
                    groupName.value = "";

                    const Toast = Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Tạo Nhóm Thành Công",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        });

        Echo.private('user.' + {{ Auth::id() }})
            .listen('GroupCreated', (e) => {
                let groupBox = document.querySelector('.groupBox');
                let cardGroup = `
                        <div class="card mb-3" style="margin-right: 10px; width: 193px;">
                            <div class="card-body">
                                <h5 class="card-title">${e.board.board_name}</h5>
                                <a href="/board-group/${e.board.id}" class="btn btn-outline-success">Vào
                                    nhóm</a>
                            </div>
                        </div>     
                    `;

                groupBox.insertAdjacentHTML('afterbegin', cardGroup);
            });
    </script>
@endsection
