<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); // ★

        return view('tasks/index', [
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(CreateTask $request)
    {
        $savedata = [
            'id' => $request->id,
            'title' => $request->title,
            'due_date' => $request->due_date
        ];

        $task = new Task();
        $task->fill($savedata)->save();

        return redirect()->route('tasks.index',[
            $savedata['id']
        ]);
    }

    public function destroy(int $task_id)
    {
      $task = Task::find($task_id);

      $task->delete();

      return redirect()->route('tasks.index')->with('poststatus', 'Deleted Post!');
    }

    public function showEditForm(int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $task_id, EditTask $request)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $task_id,
        ]);
    }
}
