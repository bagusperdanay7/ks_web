<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DashboardCompanyController extends Controller
{
    final public const DASHBOARD_COMPANY_PATH = '/dashboard/companies';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.companies.index', [
            'title' => 'Company Table',
            'companies' => Company::orderBy('name')->paginate(50),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.companies.create', [
            'title' => 'Create Company',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:191'],
        ]);

        Company::create($validateData);

        return redirect(self::DASHBOARD_COMPANY_PATH)->with('success', 'New Company has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('dashboard.companies.show', [
            'title' => $company->name,
            'company' => $company,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('dashboard.companies.edit', [
            'title' => 'Update Company',
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => ['required', 'max:191'],
        ];

        $validateData = $request->validate($rules);

        Company::where('id', $company->id)->update($validateData);

        return redirect(self::DASHBOARD_COMPANY_PATH)->with('success', 'The Company has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            Company::destroy($company->id);
            return redirect(self::DASHBOARD_COMPANY_PATH)->with('success', 'The company has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_COMPANY_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
