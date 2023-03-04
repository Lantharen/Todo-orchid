<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Todo extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;
    use Filterable;

    protected $fillable = [
        'title',
        'content',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $allowedSorts = [
        'title',
        'content',
        'status',
        'created_at'
    ];
    protected $allowedFilters = [
        'title',
    ];
}
