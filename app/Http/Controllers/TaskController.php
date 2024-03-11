<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Lista todas as tarefas do usuário autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        return response()->json($tasks);
    }
    /**
     * Criar uma nova tarefa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:50',
        'description' => 'required|string|max:50',
        'start_at' => 'required|date|after:today',
        'end_at' => 'required|date|after:start_at',
        'priority' => 'required|string',
    ]);

    // Obtenha o ID do usuário autenticado
    $userId = Auth::id();

    $task = new Task();
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->start_at = $request->input('start_at');
    $task->end_at = $request->input('end_at');
    $task->priority = $request->input('priority');
    $task->user_id = $userId;

    $task->save();

    return response()->json($task, 201);
}



    /**
     * Lista todas as tarefas do usuário autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        return response()->json($tasks);
    }

    /**
     * Atualiza uma tarefa existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50',
            'description' => 'string|max:50',
            'start_at' => 'date|after:today',
            'end_at' => 'date|after:start_at',
            'priority' => 'string',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        if ($task->user_id != Auth::id()) {
            return response()->json(['message' => 'Usuário não tem permissão para alterar essa tarefa'], 403);
        }

        $task->fill($request->all());
        $task->save();

        return response()->json($task);
    }
}
