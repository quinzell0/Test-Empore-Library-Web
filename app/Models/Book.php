<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'publish_year',
        'author',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'publish_year' => 'integer',
            'stock' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }
}
