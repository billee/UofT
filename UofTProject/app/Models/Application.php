<?php

namespace App\Models;

use App\Models\Lookup\Status;
use App\Models\Lookup\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class Application extends Model
{
    use HasFactory;

    // protected static function booted(): void{

    //     static::addGlobalScope('user_id', function(Builder $builder){
    //         $builder->where('user_id', Auth::id());
    //     });

    // }

    protected $fillable = [
        'program_id',
        'user_id',
        'academic_year',
        'no_of_students',
        'status_id'
    ];


    public function program() :BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status() :BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getIsApprovedAttribute(): Bool
    {
        return $this->status_id == 3 || $this->status_id == 7;
    }

}
