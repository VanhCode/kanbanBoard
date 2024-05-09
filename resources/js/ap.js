let url = window.location.href;
let match = url.match(/\/board\/(\d+)\/edit/);
var board_id = match[1];

function handleTaskClick(task) {
    let id = task.getAttribute('data-id');
    let taskName = task.querySelector('p').textContent;
    let status = task.getAttribute('data-status');
    // alert("ID: " + id + ", Task: " + taskName);

    // update sửa
    let value_edit = document.querySelector(".add-task-container");
    let task_controller = `
                <input type="text" maxlength="25" id="taskText" value="${task.querySelector('p').textContent}" placeholder="New Task...">
                <button id="update" class="button add-button">Update Task</button>
            `;
    value_edit.innerHTML = task_controller;

    let updateButton = document.querySelector("#update");
    let taskText = document.querySelector("#taskText");
    updateButton.addEventListener("click", (e) => {
        // Echo.private('updatetask_{{ $board->id }}')
        //     .listen('UpdateTask', (e) => {
        //         // console.log(e);
        //         let updatetask = document.querySelector(`[data-id="${e.updatetask.id}"]`);
        //         updatetask.querySelector('p').textContent = e.updatetask.name;
        //     });
        e.preventDefault();
        axios.put("{{ route('task.update', ['task' => ':taskId']) }}".replace(':taskId', id), {
            id: id,
            name: taskText.value,
            status: status
        }).catch(function (error) {
            console.log(error);
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Ôi lỗi rồi !"
            });
        });
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Cập nhật task thành công !"
        });
    })
}
// console.log(board_id);

let tasks = document.querySelectorAll('.task');
tasks.forEach(task => {
    task.addEventListener('click', e => {
        handleTaskClick(task);
    });
});


// load lại khi thêm mới
const taskList = document.getElementById('to-do');
taskList.addEventListener('DOMNodeInserted', function (event) {
    if (event.target.classList && event.target.classList.contains('task')) {
        event.target.addEventListener('click', function () {
            handleTaskClick(event.target);
        });
    }
});

//     console.log(document.querySelector('#update'));