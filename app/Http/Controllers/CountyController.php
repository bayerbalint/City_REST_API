<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function index(Request $request){
        $query = County::query();

        if ($request->filled('search')) {
            $query->where(
                'name',
                'LIKE',
                '%' . $request->search . '%'
            );
        }

        $counties = $query->get();
        
        return response()->json([
            'counties' => $counties
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'badge' => ['required','string'],
        ]);

        $county = County::create($request->all());

        return response()->json(['county' => $county]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required','string','max:255'],
            'badge' => ['required','string'],
        ]);

        $county = County::findOrFail($id);

        $county->update($request->all());

        return response()->json(['county' => $county]);
    }

    public function destroy($id){
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json(['county' => $county]);
    }
}
