<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Employee::orderBy('id', 'asc');

    // Jika ada parameter pencarian (search), lakukan filter
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('team', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        });
    }

    $employees = $query->paginate(10);
    return view('employees', compact('employees'));
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'team' => 'required',
    ]);

    Employee::create([
        'name' => $request->name,
        'team' => $request->team,
        'status' => 'available', // default status
    ]);

    return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Employee = Employee::findOrFail($id);
        $Employee->update($request->all());
        return $Employee;
    }

     public function assign($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->status = 'assigned';
        $employee->save();
        return response()->json(['message' => 'Karyawan di-assign']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::destroy($id);
        return response()->json(['message' => 'Karyawan dihapus']);
    }
}
