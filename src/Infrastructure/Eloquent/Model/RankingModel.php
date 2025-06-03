<?php

namespace App\Rankings\Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RankingModel extends Model
{
    protected $table = 'rankings';

    protected $casts = [
        'calculated_at' => 'datetime',
    ];

    protected $fillable = [
        'id',
        'type',
        'name',
        'calculated_at',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function entries(): HasMany
    {
        return $this->hasMany(RankingEntryModel::class, 'ranking_id');
    }
}
