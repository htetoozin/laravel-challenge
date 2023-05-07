<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Staff;
use App\Http\Controllers\BaseController;

class StaffController extends BaseController
{

    public function payroll(Staff $staff)
    {
        $data = $staff->salary();
        return $this->responseSuccess($data);
    }
}
