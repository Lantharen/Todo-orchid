<?php

namespace App\Orchid\Layouts;

use App\Models\Todo;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TodoListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'todos';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
                ->sort()
                ->filter(Input::make())
                ->render(function (Todo $todo) {
                    return Link::make($todo->title)
                        ->route('platform.todo.edit', $todo);

                }),
            TD::make('content', 'Content')
                ->sort()
                ->render(function (Todo $todo) {
                    return Link::make($todo->content)
                        ->route('platform.todo.edit', $todo);
                }),
            TD::make('status', 'Status')
                ->sort()
                ->render(function (Todo $todo) {
                    return Link::make($todo->status)
                        ->route('platform.todo.edit', $todo);
                }),

            TD::make('created_at', 'Created')->sort(),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
