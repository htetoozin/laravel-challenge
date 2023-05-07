<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Applicant;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class JobController extends BaseController
{
    public function apply(Request $request, Applicant $applicant)
    {
        $data = $applicant->applyJob();
        return $this->responseSuccess($data);
    }
}
