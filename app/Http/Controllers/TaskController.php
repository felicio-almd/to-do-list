<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $tasks;

    public function __construct(Task $task)
    {
        $this->tasks = $task;
    }

    /**
     * Lista todas as tarefas do usuário autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->tasks->all();

        return response()->json($tasks); // para API
    }

    /**
     * Criar uma nova tarefa.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados da requisição
        $tasks = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'start_at' => 'date|after:today',
            'end_at' => 'date|after:start_at',
            'priority' => 'required|string',
        ]);

        try {
            $task = new Task($tasks);
            $task->save();

            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $task = $this->tasks->find($id);

        return response()->json($task);
    }

    /**
     * Atualiza uma tarefa existente.
     *
     * @param  int  $id
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'start_at' => 'required|date|after:today',
            'end_at' => 'required|date|after:start_at',
            'priority' => 'required|string',
        ]);

        $task->update($request->all());

        // return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');

        return response()->json($task);
    }

    public function delete(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'cart deletado com sucesso!']);

        // return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
