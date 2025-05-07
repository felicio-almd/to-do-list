<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function index(): JsonResponse
    {
        $tasks = $this->tasks->all();

        return response()->json($tasks, Response::HTTP_OK); // para API
    }

    /**
     * Criar uma nova tarefa.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados da requisição com mensagens personalizadas
        $tasks = $request->validate([
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:100',
            'start_at' => 'date|after:today',
            'end_at' => 'date|after:start_at',
            'priority' => 'required|string',
        ], [
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O campo título deve ser uma string.',
            'title.min' => 'O campo título deve ter mais de 3 caracteres.',
            'title.max' => 'O campo título não pode ter mais de 50 caracteres.',

            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'description.min' => 'O campo descrição deve ter mais de 3 caracteres.',
            'description.max' => 'O campo descrição não pode ter mais de 50 caracteres.',

            'start_at.date' => 'A data de início deve ser uma data válida.',
            'start_at.after' => 'A data de início deve ser uma data posterior a hoje.',

            'end_at.date' => 'A data de término deve ser uma data válida.',
            'end_at.after' => 'A data de término deve ser posterior à data de início.',

            'priority.required' => 'O campo prioridade é obrigatório.',
            'priority.string' => 'O campo prioridade deve ser uma string.',
        ]);

        $task = $this->tasks->create($tasks);

        return response()->json($task, Response::HTTP_CREATED);
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
