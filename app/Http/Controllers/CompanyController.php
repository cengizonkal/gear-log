<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show(Company $company)
    {
        return new CompanyResource($company->load('items'));
    }

    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return new CompanyResource($company->load('items'));
    }

    public function delete(Company $company)
    {
        $company->delete();
        return response()->json(['message' => 'Şirket başarıyla silindi.'], 200);
    }
}
