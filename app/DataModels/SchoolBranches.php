<?php

namespace Noorfarooqy\SchoolModule\DataModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBranches extends Model
{
    use HasFactory;

    protected $table = "scm_school_branches";


    protected $guarded = [];
}
