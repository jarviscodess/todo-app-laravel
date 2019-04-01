@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="todolist not-done">
             <h1>Aufgaben</h1>
                <input type="text" class="form-control add-todo" placeholder="Aufgabe hinzufügen">
                    <hr>
                    <ul id="sortable" class="list-unstyled">
                        @foreach($tasks as $task)   
                            
                            <li id="task_{{ $task->id }}" class="ui-state-default">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" />{{ $task->description }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                <div class="todo-footer">
                    <strong><span class="count-todos"></span></strong> Aufgaben zu erledigen
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="todolist">
             <h1>Erledigt</h1>
                <ul id="done-items" class="list-unstyled">
                    @foreach($doneTasks as $doneTask)   
                        <li id="task_{{ $doneTask->id }}">{{ $doneTask->description }} <button class="remove-item btn btn-default btn-xs pull-right">Löschen</button></li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
