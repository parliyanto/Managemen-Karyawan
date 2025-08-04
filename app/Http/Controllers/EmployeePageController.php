<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeePageController extends Controller
{
    public function index()
    {
        $employees = \App\Models\Employee::all();
        // $employeeNames = \App\Models\Employee::select('name')->distinct()->orderBy('name')->pluck('name');
        return view('employees', compact('employees'));
    }

    public function assign($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->status = 'assigned';
        $employee->save();

        return redirect()->back()->with('success', 'Karyawan berhasil di-assign!.');
    }
    
    // untuk menampilkan form tambah karyawan
    public function store(Request $request)
    {
        $request->validate([  
            'name' => 'required|string|max:100',
            'team' => 'required|string|max:255',
            // 'purpose' => 'required|string|max:255',

            
        ]);
        
        \App\Models\Employee::create([
            'name' => $request->name,
            'team' => $request->team,
            // 'purpose' => $request->purpose,
            'status' => 'available'
        ]);
        
        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan.'); 
    }

    // untuk menghapus karyawan
    public function destroy($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Karyawan berhasil dihapus!');
    }

    // untuk edit karyawan
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'team' => 'required|string|max:255',
        // 'purpose' => 'nullable|string|max:255'
    ]);

    $employee = \App\Models\Employee::findOrFail($id);
    $employee->update([
        'name' => $request->name,
        'team' => $request->team,
        // 'purpose' => $request->purpose,
    ]);

    return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diupdate.');
}
}
