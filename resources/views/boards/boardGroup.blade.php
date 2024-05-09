@extends('layouts.app')

@section('styles')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Arimo:400,700|Roboto+Slab:400,700");

        :root {
            font-size: calc(0.5vw + 1vh);
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            min-width: 420px;
        }

        h1,
        h4 {
            font-family: "Arimo", sans-serif;
            line-height: 1.3;
        }

        header h1 {
            font-size: 2.4rem;
            margin: 4rem auto;
        }

        p {
            font-family: "Roboto Slab", serif;
        }


        header,
        footer {
            width: 40rem;
            margin: 2rem auto;
            text-align: center;
        }

        .add-task-container {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 20rem;
            height: 5.3rem;
            margin: auto;
            background: #a8a8a8;
            border: #000013 0.2rem solid;
            border-radius: 0.2rem;
            padding: 0.4rem;
        }

        .main-container {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .columns {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            margin: 1.6rem auto;
        }

        .column {
            width: 8.4rem;
            margin: 0 0.6rem;
            background: #a8a8a8;
            border: #000013 0.2rem solid;
            border-radius: 0.2rem;
        }

        .column-header {
            padding: 0.1rem;
            border-bottom: #000013 0.2rem solid;
        }

        .column-header h4 {
            text-align: center;
        }

        .to-do-column .column-header {
            background: #ff872f;
        }

        .doing-column .column-header {
            background: #13a4d9;
        }

        .done-column .column-header {
            background: #15d072;
        }

        .trash-column .column-header {
            background: #ff4444;
        }

        .task-list {
            min-height: 3rem;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        li {
            list-style-type: none;
        }

        .column-button {
            text-align: center;
            padding: 0.1rem;
        }

        .button {
            font-family: "Arimo", sans-serif;
            font-weight: 700;
            border: #000013 0.14rem solid;
            border-radius: 0.2rem;
            color: #000013;
            padding: 0.6rem 1rem;
            margin-bottom: 0.3rem;
            cursor: pointer;
        }

        .delete-button {
            background-color: #ff4444;
            margin: 0.1rem auto 0.6rem auto;
        }

        .delete-button:hover {
            background-color: #fa7070;
        }

        .add-button {
            background-color: #ffcb1e;
            padding: 0 1rem;
            height: 2.8rem;
            width: 10rem;
            margin-top: 0.6rem;
        }

        .add-button:hover {
            background-color: #ffdd6e;
        }

        .task {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            vertical-align: middle;
            list-style-type: none;
            background: #fff;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            margin: 0.4rem;
            height: 4rem;
            border: #000013 0.15rem solid;
            border-radius: 0.2rem;
            cursor: move;
            text-align: center;
            vertical-align: middle;
        }

        #taskText {
            background: #fff;
            border: #000013 0.15rem solid;
            border-radius: 0.2rem;
            text-align: center;
            font-family: "Roboto Slab", serif;
            height: 4rem;
            width: 7rem;
            margin: auto 0.8rem auto 0.1rem;
        }

        .task p {
            margin: auto;
        }

        /* Dragula CSS Release 3.2.0 from: https://github.com/bevacqua/dragula */

        .gu-mirror {
            position: fixed !important;
            margin: 0 !important;
            z-index: 9999 !important;
            opacity: 0.8;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
            filter: alpha(opacity=80);
        }

        .gu-hide {
            display: none !important;
        }

        .gu-unselectable {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
        }

        .gu-transit {
            opacity: 0.2;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
            filter: alpha(opacity=20);
        }

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

        .member_img {
            width: 100px;
            border-radius: 50%;
        }

        .h5_member {}
    </style>
@endsection

@section('content')
    <div class="container">
        <header>
            <h1>Drag & Drop<br /><span>Lean Kanban Board</span></h1>
        </header>

        <h1 class="alert alert-success text-center mb-4" style="margin-bottom: 50px !important;">TÊN NHÓM:
            {{ $boardGroup->board_name }}</h1>

        <div class="group_members d-flex flex-wrap mb-5" id="boxMembers">
            <a href="" class="btn btn-warning m-2" style="width: 10rem;">
                <div class="member d-flex flex-column align-items-center">
                    <img class="member_img" src="{{ $leader->image }}">
                    <span>Nhóm trưởng</span>
                    <h5 class="mt-2 h5_member">{{ $leader->name }}</h5>
                </div>
            </a>
            @foreach ($members as $member)
                <a href="" class="btn btn-warning m-2" style="width: 10rem;">
                    <div class="member d-flex flex-column align-items-center">
                        <img class="member_img" src="{{ $member->image }}">
                        <h5 class="mt-2 h5_member">{{ $member->name }}</h5>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="add_member">
            @if ($checkLeader)
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#modelAddMember">
                    Thêm thành viên
                </button>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="modelAddMember" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm thành viên vào nhóm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="boardId" value="{{ $boardId }}">
                            <div class="form-group mb-3">
                                <label for="groupName">Chọn thành viên</label>
                                <select name="memberGroup[]" id="memberGroup" class="form-select memberGroup" multiple>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" id="btnAddMember" class="btn btn-primary">Thêm thành viên</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-task-container">
            <div class="add-task">
                <input type="text" name="taskName" class="taskText" id="taskText" placeholder="New Task...">
                <button type="button" id="addTask" class="button add-button">Add New Task</button>
            </div>
        </div>


        <div class="main-container">
            <ul class="columns box_congviec">
                <li class="column to-do-column">
                    <div class="column-header">
                        <h4>To Do</h4>
                    </div>
                    <ul class="task-list" id="to-do">
                        @foreach ($boxTodo as $toDo)
                            <li data-id-task="{{ $toDo->id }}" class="task">
                                <p>{{ $toDo->title }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="column doing-column">
                    <div class="column-header">
                        <h4>Doing</h4>
                    </div>
                    <ul class="task-list" id="doing">
                        @foreach ($boxDoing as $doing)
                            <li data-id-task="{{ $doing->id }}" class="task">
                                <p>{{ $doing->title }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="column done-column">
                    <div class="column-header">
                        <h4>Done</h4>
                    </div>
                    <ul class="task-list" id="done">
                        @foreach ($boxDone as $done)
                            <li data-id-task="{{ $done->id }}" class="task">
                                <p>{{ $done->title }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="column trash-column">
                    <div class="column-header">
                        <h4>Trash</h4>
                    </div>
                    <ul class="task-list" id="trash">
                        @foreach ($boxTrash as $trash)
                            <li data-id-task="{{ $trash->id }}" class="task">
                                <p>{{ $trash->title }}</p>
                            </li>
                        @endforeach
                    </ul>
                    @if ($checkLeader)
                        <div class="column-button">
                            <button id="deleteTask" class="button delete-button">Delete</button>
                        </div>
                    @endif
                </li>
            </ul>
        </div>

        <footer>
            <p>Built with <a href="https://github.com/bevacqua/dragula" target="_blank">Dragula</a> and Vanilla JS by <a
                    href="http://nikkipantony.com" target="_blank">Nikki Pantony</a></p>
        </footer>
    </div>
@endsection

@section('scripts')
    <script type="module">
        const btnAddMember = document.querySelector('#btnAddMember');
        const boardId = {{ $boardId }};

        btnAddMember.addEventListener('click', function(e) {

            e.preventDefault();

            var memberGroup = document.querySelector("#memberGroup");

            var selectedOptions = [];

            for (var i = 0; i < memberGroup.selectedOptions.length; i++) {
                selectedOptions.push(memberGroup.selectedOptions[i].value);
            }

            axios.post("{{ route('createMember', $boardId) }}", {
                    memberGroup: selectedOptions
                })
                .then(response => {
                    const btnClose = document.querySelector('.btn-close');
                    btnClose.click();
                    memberGroup.value = "";

                    if (response.data.success.length > 0) {
                        const Toast = Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Thêm thành viên nhóm thành công",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        const Toast = Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Thành viên đã vào nhóm",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
        });

        Echo.private('members.' + boardId)
            .listen('MemberGroup', e => {
                // console.log(e);

                let boxMembers = document.querySelector('#boxMembers');

                let boxMembersUi = `
                    <a href="" class="btn btn-warning m-2" style="width: 10rem;">
                        <div class="member d-flex flex-column align-items-center">
                            <img class="member_img" src="${e.user.image}">
                            <h5 class="mt-2 h5_member">${e.user.name}</h5>
                        </div>
                    </a>
                `;

                boxMembers.insertAdjacentHTML('afterbegin', boxMembersUi);
            })
    </script>

    <script type="module">
        const addTask = document.querySelector('#addTask');
        const taskText = document.querySelector('#taskText');
        const boardId = {{ $boardId }};
        const userId = {{ Auth::user()->id }};

        addTask.addEventListener('click', function() {
            axios.post("{{ route('createTask', $boardId) }}", {
                    board_id: boardId,
                    title: taskText.value,
                    iduser_created_by: userId
                })
                .then(response => {
                    taskText.value = "";
                    const Toast = Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Công Việc Đã Được Thêm",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        });

        Echo.private('task.' + boardId)
            .listen('TaskCreated', e => {
                // console.log(e);
                let toDo = document.querySelector('#to-do');

                let boxTodoUi = `
                    <li data-id-task="${e.taskData.id}" class="task">
                        <p>${e.taskData.title}</p>
                    </li>
                `;

                toDo.insertAdjacentHTML('afterbegin', boxTodoUi);
            })
    </script>

    <script type="module">
        const containers = [
            document.getElementById("to-do"),
            document.getElementById("doing"),
            document.getElementById("done"),
            document.getElementById("trash")
        ];


        const drake = dragula(containers, {
            removeOnSpill: false
        });

        drake.on("drag", function(el) {

        });

        drake.on("drop", function(el, target, source, sibling) {
            const taskId = el.getAttribute('data-id-task');
            const boardId = {{ $boardId }};
            const newStatus = target.id;

            axios.post(`/board-group/${boardId}/tasks/${taskId}`, {
                    status: newStatus
                })
                .then(response => {
                    const Toast = Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: `Việc làm '${response.data.task.title}' vừa được cập nhật`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // console.log(response);
                })
                .catch(error => {
                    const Toast = Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: 'Đã xảy ra lỗi khi cập nhật',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        });

        drake.on("over", function(el, container) {});

        drake.on("out", function(el, container) {

        });

        const boardId = {{ $boardId }}

        Echo.private('tasks.' + boardId)
            .listen('TaskUpdated', e => {
                const {
                    taskId,
                    taskData
                } = e;

                // Tìm phần tử task 
                const taskElement = document.querySelector(`li[data-id-task="${taskId}"]`);

                // Kiểm tra tồn tại
                if (taskElement) {
                    // Xóa bỏ task vị trí hiện tại
                    taskElement.parentNode.removeChild(taskElement);

                    // Tạo task mới
                    const newTaskElement = document.createElement('li');
                    newTaskElement.setAttribute('data-id-task', taskId);
                    newTaskElement.classList.add('task');
                    newTaskElement.innerHTML = `<p>${taskData.title}</p>`;

                    // lấy trang thái mới của công việc sau khi được update
                    const newColumnId = taskData.status;
                    const newColumn = document.getElementById(newColumnId);
                    newColumn.appendChild(newTaskElement);
                }
            });


        let deleteTask = document.querySelector('#deleteTask')

        if (deleteTask) {
            deleteTask.addEventListener('click', function() {
                const trashTasks = document.querySelectorAll('#trash .task');

                trashTasks.forEach(task => {
                    const taskId = task.getAttribute('data-id-task');

                    axios.post(`/board-group/${boardId}/deleteTask`, {
                            id: taskId
                        })
                        .then(response => {
                            task.remove();
                            const Toast = Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: 'Xóa task thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        })
                });
            })
        }

        Echo.private('deleteTasks.' + boardId)
            .listen('TaskDeleted', e => {
                const deletedTaskId = e.taskId;

                const deletedTaskElement = document.querySelector(
                    `#trash .task[data-id-task="${deletedTaskId}"]`);

                deletedTaskElement.remove();
            })


        const box_congviec = document.querySelectorAll('.box_congviec .task');

        box_congviec.forEach(task => {
            task.addEventListener('click', function() {
                let taskId = this.getAttribute('data-id-task');
                let boxAddTask = document.querySelector(".add-task-container");
                let value_edit = document.querySelector(".add-task");

                let task_controller = `
                    <div class="update-task">
                        <input type="text" maxlength="25" id="taskText" value="${task.querySelector('p').textContent}" placeholder="New Task...">
                        <button id="update" class="button add-button">Update Task</button>
                    </div>
                `;

                value_edit.remove();
                boxAddTask.insertAdjacentHTML('afterbegin', task_controller);

                let updateButton = document.querySelector("#update");
                let taskText = document.querySelector("#taskText");

                updateButton.addEventListener("click", function(e) {
                    axios.post(`/board-group/${boardId}/updateTask/${taskId}`, {
                        taskId: taskId,
                        title: taskText.value
                    }).then(response => {

                        // Tìm phần tử task 
                        const taskElement = document.querySelector(
                            `li[data-id-task="${taskId}"]`);

                        // Nếu tồn tại taskElement
                        if (taskElement) {
                            taskText.value = '';
                            // Xóa bỏ task vị trí hiện tại
                            taskElement.parentNode.removeChild(taskElement);

                            // Tạo task mới
                            const newTaskElement = document.createElement('li');
                            newTaskElement.setAttribute('data-id-task', taskId);
                            newTaskElement.classList.add('task');
                            newTaskElement.innerHTML =
                                `<p>${response.data.task.title}</p>`;

                            // lấy trang thái mới của công việc sau khi được update
                            const newColumnId = response.data.task.status;
                            const newColumn = document.getElementById(
                                newColumnId);
                            newColumn.appendChild(newTaskElement);

                            let value_updateTask = document.querySelector(
                                ".update-task");

                            let task_old = `
                                <div class="add-task">
                                    <input type="text" name="taskName" class="taskText" id="taskText" placeholder="New Task...">
                                    <button type="button" id="addTask" class="button add-button">Add New Task</button>
                                </div>
                            `;

                            value_updateTask.remove();

                            boxAddTask.insertAdjacentHTML('afterbegin',
                                task_old);

                            const Toast = Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: `Cập nhật task: '${response.data.task.title}' thành công`,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }


                    }).catch(function(error) {
                        const Toast = Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: `Lỗi rồi`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                })

            })

        });

        Echo.private('tasks.' + boardId)
            .listen('TaskUpdated', e => {
                console.log(e);
            })
    </script>
@endsection
