<?php

namespace Noorfarooqy\SchoolModule\DataModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use HasFactory;

    protected $table = "scm_schools";
    protected $guarded = [];

    public function Branches()
    {
        return $this->hasMany(SchoolBranches::class, 'school');
    }
}
