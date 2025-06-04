<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(
            Company::where('owner_id', auth()->id())->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        $data['owner_id'] = auth()->id();

        $company = Company::create($data);

        return new CompanyResource($company->load('owner'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {

        if (auth()->user()->cannot('update', $company)) {
            abort(403);
        }

        $company->load('owner');
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'email' => 'nullable|email|unique:companies,email,' . $company->id,
            'address' => 'nullable|string',
        ]);

        $this->authorize('update', $company);

        $company->update($data);
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->authorize('update', $company);

        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
