<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Mail\UsertMail;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('verified');
    }

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
     * @param EmployeeCreateRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeCreateRequest $request): RedirectResponse
    {
        Employee::create($request->all());

        $email = new UsertMail($request->name);
        Mail::to($request->email)->send($email);

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
     * @param EmployeeUpdateRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee): RedirectResponse
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
