@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4">
          <div class="card card-header shadow">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">TaskName</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">Limit</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-outline-primary">タスクを追加</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <table class="table">
            <thead>
            <tr>
              <th>Title</th>
              <th>Status</th>
              <th>Limit</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td>{{ $task['title'] }}</td>
                <td>
                  
                  @if ($task['status'] == 1)
                  <span class="badge badge-danger">未着手</span>
                  @elseif($task['status'] == 2)
                  <span class="badge badge-info">着手中</span>
                  @elseif($task['status'] == 3)
                  <span class="badge badge-primary">完了！</span>
                  @endif
                  
                </td>
                <td>{{ $task['formatted_due_date'] }}</td>
                <td class="text-right"><a class="btn btn-outline-success" href="{{ route('tasks.edit', ['task_id' => $task['id']]) }}">
                    Edit
                    </a>
                    <a class="btn btn-outline-danger" href="{{ route('destroy', ['task_id' => $task['id']]) }}">
                    Delete
                    </a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>
@endsection