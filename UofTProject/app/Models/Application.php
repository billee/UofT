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
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getIsChairDeptRoleAttribute():bool
    {
        $roleId = auth()->user()->role_id;

        return $roleId == 2;  /////// refactor all numbers below as lookup
    }

    public function getIsFacultyMemberRoleAttribute():bool
    {
        $roleId = auth()->user()->role_id;

        return $roleId == 1;
    }

    public function getIsDOAdministratorRoleAttribute():bool
    {
        $roleId = auth()->user()->role_id;

        return $roleId == 3;
    }

    public function getIsDecanalCommitteeMemberRoleAttribute():bool
    {
        $roleId = auth()->user()->role_id;

        return $roleId == 4;
    }



    public function getIsDeptApprovedStatusAttribute(): Bool
    {
        return $this->status_id == 3;
    }

    public function getIsPendingDeptApprovalStatusAttribute(): Bool
    {
        return $this->status_id == 2;
    }

    public function getIsPendingRevisionsStatusAttribute(): Bool
    {
        return $this->status_id == 4;
    }

    public function getIsPendingDORevisionsStatusAttribute(): Bool
    {
        return $this->status_id == 5;
    }

    public function getIsPendingDOApprovalStatusAttribute(): Bool
    {
        return $this->status_id == 6;
    }

    public function getIsDOConditionallyApprovedStatusAttribute(): Bool
    {
        return $this->status_id == 8;
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }


    // public function getIsApprovedAttribute(): Bool
    // {
    //     return $this->status_id == 3 || $this->status_id == 7;
    // }

}
