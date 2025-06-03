<?php

namespace App\Rankings\Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RankingEntryModel extends Model
{
    protected $table = 'ranking_entries';

    protected $fillable = [
        'ranking_id',
        'user_id',
        'position',
        'score',
    ];

    public $timestamps = false;

    public function ranking(): BelongsTo
    {
        return $this->belongsTo(RankingModel::class, 'ranking_id');
    }
}
