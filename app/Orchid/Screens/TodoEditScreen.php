<?php

namespace App\Orchid\Screens;

use App\Models\Todo;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class TodoEditScreen extends Screen
{
    public Todo $todo;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Todo $todo): iterable
    {
        return [
            'todo' => $todo
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {

        return $this->todo->exists ? 'Edit Todo' : 'Creating new Todo';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create todo')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->todo->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->todo->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->todo->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('todo.title')
                    ->title('Todo Title')
                    ->placeholder('Please write your title.'),
                TextArea::make('todo.content')
                    ->title('Todo Content')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Write for content.'),
                TextArea::make('todo.status')
                    ->title('Todo Status')
                    ->value('1 or 0'),
            ])
        ];
    }
    /**
     * @param Todo    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Todo $todo, Request $request)
    {
        $todo->fill($request->get('todo'))->save();

        Alert::info('You have successfully created a todo.');

        return redirect()->route('platform.todo.list');
    }
    public function remove(Todo $todo)
    {
        $todo->delete();

        Alert::warning('You have successfully deleted the todo.');

        return redirect()->route('platform.todo.list');
    }
}
