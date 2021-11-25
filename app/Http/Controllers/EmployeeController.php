<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = trim($request->get('search'));

        $employees = Employee::where('id', 'LIKE', '%' . $query . '%')
            ->orwhere('name', 'LIKE', '%' . $query . '%')
            ->orwhere('email', 'LIKE', '%' . $query . '%')
            ->orwhere('id', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('employees.index', [
            'employees' => $employees,
            'search'   => $query
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Employee::create($request->all());

        return redirect('/employees');
    }

    /**
     * @param Employee $employee
     * @return View
     */
    public function show(Employee $employee): View
    {
        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    /**
     * @param Employee $employee
     * @return View
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->all());

        return redirect('employees');
    }

    /**
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect('/employees');
    }
}
