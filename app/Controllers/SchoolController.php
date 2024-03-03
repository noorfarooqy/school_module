<?php

namespace Noorfarooqy\SchoolModule\Controllers;

use Illuminate\Http\Request;
use Noorfarooqy\SchoolModule\Services\SchoolServices;

class SchoolController extends Controller
{
    public function newSchool(Request $request, SchoolServices $schoolServices)
    {
        return $schoolServices->addNewSchool($request);
    }

    public function getSchoolDetails(Request $request, SchoolServices $schoolServices)
    {
        return $schoolServices->getSchoolDetails($request);
    }
}
