<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Staff;

class StaffController extends Controller
{

    public function payroll(Staff $staff)
    {
        $data = $staff->salary();

        return response()->json([
            'data' => $data,
        ]);
    }
}
