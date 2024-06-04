<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $todos;
    public $title;
    public $description;

    public function mount()
    {
        $this->todos = Todo::all();
    }

    public function render()
    {
        return view('livewire.todo-component');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        Todo::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->reset(['title', 'description']);
        $this->todos = Todo::all();
    }

    public function update(Todo $todo)
    {
        $todo->update(['isDone' => true]);
        $this->todos = Todo::all();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        $this->todos = Todo::all();
    }
}