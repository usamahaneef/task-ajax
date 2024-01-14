@extends('web.layout.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" data-target="#modal-task-add"
                            data-toggle="modal" class="btn btn-sm btn-info">
                            <i class="fas fa-plus-circle"></i> Create task
                        </button>
                    </div>
                    <div id="modal-task-add" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fas fa-plus-circle"></i> Create task</h4>
                                    <button type="button" class="close"
                                        data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="taskForm" action="{{ route('task.store') }}" method="post">
                                        @csrf
                                        <div id="error-container"></div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter">
                                            @error('title')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="due_date">Due date</label>
                                            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date') }}" placeholder="Enter">
                                            @error('due_date')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="priority">Priority</label>
                                            <input type="number" id="priority" name="priority" class="form-control"
                                                   value="{{old('priority')}}"
                                                   placeholder="Enter ">
                                            @error('priority')
                                            <span class="text-danger text-sm pull-right">{{$errors->first('priority')}}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group d-flex justify-content-between align-items-center">
                                            <label for="status">Completed</label><br>
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" id="status" name="status" class="bt-switch" data-size="small" data-on-text="Yes" data-off-text="No" value="1" {{ old('status') == 1 ? 'checked="checked"' : '' }}>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" id="saveTask" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Save record</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0" id="taskList">    
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-borderless">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due&nbsp;date</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $key => $task)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td> <span class="badge badge-info">{{ $task->title}}</span></td>
                                        <td><span class="badge badge-warning">{{ $task->description}}</span></td>
                                        <td><button class="btn btn-default btn-sm text-nowrap">
                                            <i class="fas fa-calendar-alt"></i> {{$task->due_date->format('M-d-Y')}}</button>
                                        </td>
                                        <td>
                                            @if ($task->status)
                                                <span class="badge badge-warning">Completed</span>
                                            @else
                                                <span class="badge badge-danger">Uncompleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">
                                                {{$task->priority}}
                                            </button>
                                        </td>
                                        <td>
                                            <button title="Edit task" class="btn btn-secondary btn-xs"
                                             data-target="#modal-task-edit{{$task->id}}" data-toggle="modal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <div id="modal-task-edit{{$task->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><i class="fas fa-edit"></i> Update task</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="taskFormUpdate" class="updateTask" data-id="{{ $task->id }}" action="{{ route('task.update', $task->id) }}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div id="error-container"></div>
                                                                <div class="form-group">
                                                                    <label for="title">Title</label>
                                                                    <input type="text" id="title" name="title" class="form-control" value="{{$task->title , old('title') }}" placeholder="Enter">
                                                                    @error('title')
                                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter">{{$task->description, old('description') }}</textarea>
                                                                    @error('description')
                                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="due_date">Due date</label>
                                                                    <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date') ?? ($task->due_date ? $task->due_date->format('Y-m-d') : '') }}" placeholder="Enter">
                                                                    @error('due_date')
                                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="priority">Priority</label>
                                                                    <input type="text" id="priority" name="priority" class="form-control"
                                                                           value="{{$task->priority ,old('priority')}}"
                                                                           placeholder="Enter ">
                                                                    @error('priority')
                                                                    <span class="text-danger text-sm pull-right">{{$errors->first('priority')}}</span>
                                                                    @enderror
                                                                </div>
                                                                
                                                                
                                                                <div class="form-group d-flex justify-content-between align-items-center">
                                                                    <label for="status">Completed</label><br>
                                                                    <input type="hidden" name="status" value="0">
                                                                    <input type="checkbox" id="status" name="status" class="bt-switch" data-size="small" data-on-text="Yes" data-off-text="No" value="1" {{ $task->status == 1 ? 'checked="checked"' : '' }}>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-sm btn-success "><i class="fas fa-save"></i> Update record</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button title="Delete task" class="btn btn-danger btn-xs deleteTaskBtn"
                                                    data-target="#modal-delete{{$task->id}}" data-toggle="modal" data-task-id="{{$task->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    
                                            <div class="modal fade" id="modal-delete{{$task->id}}" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirmation!</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input id="delete-task-id" type="hidden"  name="id" value="{{$task->id}}" />
                                                            <div class="form-group">
                                                                <label>Are you sure you want to delete this task?</label>
                                                                <span id="accept_error" class="text-sm text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            <button type="button" onclick='deleteRecord({{$task->id}})' class="btn btn-danger btn-sm delete-task"><i class="fas fa-trash"></i> Delete task</button>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- {{ $tasks->links() }} --}}
                </div>
                <div id="reload-container"></div>

                <div class="modal fade" id="modal-success" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">successful!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="delete-task-id" type="hidden"  name="id" value="{{$task->id}}" />
                                <div class="form-group">
                                    <label>Are you sure you want to delete this task?</label>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success btn-sm success-task"><i class="fas fa-check"></i> Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>

$(document).ready(function () {
    $('#saveTask').click(function () {
        $.ajax({
            type: 'POST',
            url: '{{ route("task.store") }}',
            data: $('#taskForm').serialize(),
            dataType: 'json',
            success: function (data) {
                $('#taskList').load('{{ route("tasks") }} #taskList');
                $('#taskForm')[0].reset();
                $('#modal-task-add').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                $('#error-container').empty();
                $.each(errors, function (key, value) {
                    $('#error-container').append('<div class="text-danger">' + value + '</div>');
                });
            }
        });
    });
});
</script>

<script>
$('.updateTask').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var id = form.data('id');
    var url = "{{ url('task/update') }}" + '/' + id;
    $.ajax({
        url: url,
        type: "PATCH",
        cache: false,
        data: form.serialize(),
        dataType: 'json',
        success: function (data) {
            console.log('Update successful', data);
            if (data.success) {
                $('#taskList').load('{{ route("tasks") }} #taskList');
                $('#modal-task-edit'+id).modal('hide');
                location.reload();
            } else {
                console.error('Update was not successful.');
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
<script>
    function deleteRecord(id) {
            $.ajax({
            type: "DELETE",
            url: "{{ url('task/delete') }}"+'/'+id,
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (data) {
            console.log('Update successful', data);
            if (data.success) {
                $('#taskList').load('{{ route("tasks") }} #taskList');
                $('#modal-delete' + id).modal('hide');
                location.reload();
            } else {
                console.error('delete was not successful.');
            }
        },
        error: function (xhr, status, error) {
            console.error('delete error:', error);
        }
        });
    }
</script>

@endpush
