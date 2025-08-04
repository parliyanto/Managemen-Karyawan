<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $query = Employee::query();

        // Filter team
        if ($request->has('team') && $request->team != '') {
            $query->where('team', $request->team);
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pencarian nama
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $employees = $query->get();

        $total = Employee::count();
        $available = Employee::where('status', 'available')->count();
        $assigned = Employee::where('status', 'assigned')->count();
        $teams = Employee::selectRaw('team, COUNT(*) as total')->groupBy('team')->pluck('total', 'team');
        $allTeams = Employee::select('team')->distinct()->pluck('team');

        // Statistik assignment bulanan (line chart)
        $monthlyAssignments = Assignment::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw('MONTH(date)'))
        ->orderBy(DB::raw('MONTH(date)'))
        ->pluck('total', 'month');

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $monthlyAssignments[$i] ?? 0;
        }

        // Statistik karyawan dengan assignment terbanyak (bar chart)
         $topEmployees = DB::table('assignments')
        ->join('employees', 'assignments.employee_id', '=', 'employees.id')
        ->select('employees.name', DB::raw('COUNT(*) as total'))
        ->groupBy('employees.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        return view('dashboard', compact('total', 'available', 'assigned', 'teams', 'employees', 'allTeams', 'months', 'topEmployees'));
    }
}
