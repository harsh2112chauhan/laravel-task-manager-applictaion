@extends('layout.baseview')
@section('title','All Tasks')
@section('style')
<style>
    .done {
        text-decoration: line-through;
    }
</style>
@endsection
@section('content')
@include('layout.navigation')
<div class="container mt-5">
    <button type="button" class="btn btn-outline-primary mb-5 end-0" onclick="addtask()">Add Tasks</button>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Si No.</th>
                        <th scope="col">Task Description</th>
                        <th scope="col"> Task Owner</th>
                        <th scope="col">Task ETA</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="taskTable">

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="createTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="createTaskDescription">Task Description</label>
                        <input type="text" class="form-control" id="createTaskDescription" placeholder="Enter Task Description">
                    </div>
                    <div class="form-group">
                        <label for="createTaskOwner">Task Owner</label>
                        <input type="text" class="form-control" id="createTaskOwner" placeholder="Enter Task Owner">
                    </div>
                    <div class="form-group">
                        <label for="createTaskEmail">Task Owner Email</label>
                        <input type="text" class="form-control" id="createTaskEmail" placeholder="Enter Task Owner Email">
                    </div>
                    <div class="form-group">
                        <label for="createTaskETA">Task ETA</label>
                        <input type="date" class="form-control" id="createTaskETA" placeholder="Enter Task ETA">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="createTask()">Create</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="editTaskDescription">Task Description</label>
                        <input type="text" class="form-control" id="editTaskDescription" placeholder="Enter Task Description">
                    </div>
                    <div class="form-group">
                        <label for="editTaskOwner">Task Owner</label>
                        <input type="text" class="form-control" id="editTaskOwner" placeholder="Enter Task Owner">
                    </div>
                    <div class="form-group">
                        <label for="editTaskEmail">Task Owner Email</label>
                        <input type="text" class="form-control" id="editTaskEmail" placeholder="Enter Task Owner Email">
                    </div>
                    <div class="form-group">
                        <label for="editTaskETA">Task ETA</label>
                        <input type="date" class="form-control" id="editTaskETA" placeholder="Enter Task ETA">
                    </div>
                    <div class="form-group">
                        <label for="editTaskStatus">Task Status</label>
                        <select class="form-control" id="editTaskStatus">
                            <option>Set Task Status</option>
                            <option value="0">In Progress</option>
                            <option value="1">Done</option>
                        </select>
                        <input type="hidden" id="editTaskid">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateTask()">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DoneTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark Task as Done</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to mark this task as done?</p>
                <input type="hidden" id="doneTaskid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateMarkTaskasDone()">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Task</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure want delete this task?</p>
                <input type="hidden" id="deleteTaskid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateTaskDelete()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script>
    $(document).ready(function() {
        getALLTasks();
    });

    function getALLTasks() {
        $.ajax({
            type: 'get',
            url: 'http://localhost:8000/api/task',
            success: function(result) {
                var html = '';
                for (var i = 0; i < result.length; i++) {
                    var lineThrough = result[i]['status'] == 1 ? 'class="done"' : "";
                    html +=
                        '<tr>' +
                        '<th scope="row"' + lineThrough + '> ' + (i + 1) + ' </th>' +
                        '<td ' + lineThrough + '>' + result[i]['task_description'] + '</td>' +
                        '<td ' + lineThrough + '>' + result[i]['task_owner'] + '</td>' +
                        '<td ' + lineThrough + '>' + result[i]['task_eta'] + '</td>' +
                        '<td>' +
                        '<i class="bi bi-pencil-square" onclick="editTask(' + result[i]['id'] + ')" > </i>' +
                        '<i class="bi bi-check2-square" onclick="markasdone(' + result[i]['id'] + ')"></i>' +
                        '<i class="bi bi-trash" onclick="deleteTask(' + result[i]['id'] + ')"></i>' +
                        '</td>' +
                        '</tr>'
                }
                $('#taskTable').html(html)
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }

    function addtask() {
        $('#createTaskModal').modal('show');
    }

    function createTask() {
        var task_decription = $('#createTaskDescription').val();
        var task_Owner = $('#createTaskOwner').val();
        var task_Owner_Email = $('#createTaskEmail').val();
        var task_ETA = $('#createTaskETA').val();
        $.ajax({
            type: 'post',
            url: 'http://localhost:8000/api/task',
            data: {
                task_description: task_decription,
                task_owner: task_Owner,
                task_owner_email: task_Owner_Email,
                task_eta: task_ETA
            },
            success: function(result) {
                $('#createTaskModal').modal('hide');
                getALLTasks();
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }

    function editTask(id) {
        $.ajax({
            type: 'get',
            url: 'http://localhost:8000/api/task/' + id,
            success: function(result) {
                $("#editTaskDescription").val(result['task_description']);
                $("#editTaskOwner").val(result['task_owner']);
                $("#editTaskEmail").val(result['task_owner_email']);
                $("#editTaskETA").val(result['task_eta']);
                $("#editTaskStatus").val(result['status']);
                $("#editTaskid").val(result['id']);
                $('#editTaskModal').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })

    }

    function updateTask() {
        var id = $("#editTaskid").val();
        var task_decription = $('#editTaskDescription').val();
        var task_Owner = $('#editTaskOwner').val();
        var task_Owner_Email = $('#editTaskEmail').val();
        var task_ETA = $('#editTaskETA').val();
        var task_status = $("#editTaskStatus").val();
        $.ajax({
            type: 'put',
            url: 'http://localhost:8000/api/task/' + id,
            data: {
                task_description: task_decription,
                task_owner: task_Owner,
                task_owner_email: task_Owner_Email,
                task_eta: task_ETA,
                status: task_status
            },
            success: function(result) {
                $('#editTaskModal').modal('hide');
                getALLTasks();
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }

    function markasdone(id) {
        $('#doneTaskid').val(id)
        $('#DoneTaskModal').modal('show')
    }

    function updateMarkTaskasDone() {
        var id = $("#doneTaskid").val();
        $.ajax({
            type: 'post',
            url: 'http://localhost:8000/api/task/done/' + id,
            success: function(result) {
                $('#DoneTaskModal').modal('hide');
                getALLTasks();
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }

    function deleteTask(id) {
        $('#deleteTaskid').val(id)
        $('#deleteTaskModal').modal('show')
    }

    function updateTaskDelete() {
        var id = $("#deleteTaskid").val();
        $.ajax({
            type: 'delete',
            success: function(result) {
                url: 'http://localhost:8000/api / task / ' + id
                $('#deleteTaskModal').modal('hide');
                getALLTasks();
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }
</script>
@endsection