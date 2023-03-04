<?php

declare(strict_types=1);

namespace App\Orchid\Presenters;

use Illuminate\Support\Str;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class UserPresenter extends Presenter implements Searchable, Personable
{
    /**
     * Get the searchable label.
     *
     * @return string
     */
    public function label(): string
    {
        return 'Users';
    }

    /**
     * Get the searchable title.
     *
     * @return string
     */
    public function title(): string
    {
        return $this->entity->name;
    }

    /**
     * Get the searchable subtitle.
     *
     * @return string
     */
    public function subTitle(): string
    {
        $roles = $this->entity->roles->pluck('name')->implode(' / ');

        return (string) Str::of($roles)
            ->limit(20)
            ->whenEmpty(fn() => __('Regular user'));
    }

    /**
     * Get the searchable URL.
     *
     * @return string
     */
    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    /**
     * Get the searchable image.
     *
     * @return string|null
     */
    public function image(): ?string
    {
        $hash = md5(strtolower(trim($this->entity->email)));

        return "https://www.gravatar.com/avatar/$hash?d=mp";
    }

    /**
     * The number of models to return for show compact search result.
     *
     * @return int
     */
    public function perSearchShow(): int
    {
        return 3;
    }

    /**
     * @param  string|null  $query
     *
     * @return Builder
     */
    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }
}
