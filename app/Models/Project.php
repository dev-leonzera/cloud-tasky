<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $table = 'projects';

    protected $guarded = ['id'];

    protected static function boot(){
        parent::boot();

        static::creating(function ($project){
            $project->creator_id = Auth::user()->id;
        });

        static::updating(function ($project){
            if($project->status == 'Active'){
                $project->status = 1;
            } else {
                $project->status = 0;
            }
        });
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function getStatusAttribute()
    {
        return $this->attributes['status'] == 1 ? 'Active' : 'Inactive';
    }
}
