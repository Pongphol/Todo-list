@extends("layouts.app")
@section("content")
<div class="container">
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif
    <div class="col-md-6">
        <h1>Todo List</h1>
        <form method="POST" action="@if(session()->has('url')){{ session()->get('url') }}@else {{ url('/task') }} @endif">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" class="form-control" name="task" placeholder="Enter Task" value="@if(session()->has('taskText')){{ session()->get('taskText') }}@endif">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">@if(session()->has('taskText')){{ 'Save' }}@else {{ 'Add' }} @endif</button>
            </div>
        </form>
        <hr>
        <ol>
            @foreach($tasks as $task)
                <li>
                    <strong>{{ $task->task }}</strong>
                    <a href ={{url('/'.$task->id.'/complete')}}><i class="fas fa-check" aria-hidden="true"></i></a>
                    <a href ={{url('/'.$task->id.'/edit')}}><i class="fas fa-cog" aria-hidden="true"></i></a>
                    <a href ={{url('/'.$task->id.'/delete')}}><i class="fas fa-trash" aria-hidden="true"></i></a>
                </li>
            @endforeach
        </ol>
        <h4>Done</h4>
        <ol>
            @foreach($completed_tasks as $c_task)
                <li>
                    <strong>{{ $c_task->task }}</strong>
                    <a href ={{url('/'.$c_task->id.'/uncompleted')}}><i class="fas fa-arrow-up" aria-hidden="true"></i></a>
                    <a href ={{url('/'.$c_task->id.'/delete')}}><i class="fas fa-trash" aria-hidden="true"></i></a>
                </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection