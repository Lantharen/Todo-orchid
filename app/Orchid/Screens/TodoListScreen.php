<?php

namespace App\Orchid\Screens;

use App\Models\Todo;
use App\Orchid\Layouts\TodoListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;


class TodoListScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'todos' => Todo::filters()->defaultSort('created_at')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'TodoList';
    }

    public function description(): ?string
    {
        return "All todos";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.todo.edit')
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
            TodoListLayout::class
        ];
    }
}
