<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class EmployeesExport implements FromView
{
    public function view(): View
    {
        return view('pages.Employees.Export_Excel', [
            'Employees' => Employee::all()
        ]);
    }
}
