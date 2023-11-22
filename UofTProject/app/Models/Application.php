<?php

namespace App\Models;

use App\Models\Lookup\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected static function booted(): void{

        static::addGlobalScope('user_id', function(Builder $builder){
            $builder->where('user_id', Auth::id());
        });

    }

    public function program() :BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
