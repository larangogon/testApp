<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = trim($request->get('search'));

        $companies = Company::where('id', 'LIKE', '%' . $query . '%')
            ->orwhere('name', 'LIKE', '%' . $query . '%')
            ->orwhere('email', 'LIKE', '%' . $query . '%')
            ->orwhere('id', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('companies.index', [
            'companies' => $companies,
            'search'   => $query
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Company::create($request->all());

        return redirect('/companies');
    }

    /**
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        return view('companies.show', [
            'company' => $company
        ]);
    }

    /**
     * @param Company $company
     * @return View
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * @param Request $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $company->update($request->all());

        return redirect('companies');
    }

    /**
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect('/companies');
    }
}
