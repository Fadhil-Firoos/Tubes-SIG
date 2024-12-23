<?php

namespace App\Http\Controllers;

use App\Models\Coordinate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')) {
            $vendors = User::role('vendor')->with('vendor')->get();
            $coordinates = Coordinate::all();$countStatus = Coordinate::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->map(fn ($item) => $item->total)
            ->toArray();

            $statuses = ['reported', 'process', 'finish', 'accepted', 'rejected'];
            $statusCounts = array_map(fn ($status) => $countStatus[$status] ?? 0, $statuses);

            return view('dashboard', compact('vendors', 'coordinates', 'statusCounts', 'statuses'));
        }else {
            $coordinates = Coordinate::where('unique_id', Auth::id())->get();
            $countStatus = Coordinate::select('status', DB::raw('count(*) as total'))
            ->where('unique_id', Auth::id())
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->map(fn ($item) => $item->total)
            ->toArray();

            $statuses = ['reported', 'process', 'finish', 'accepted', 'rejected'];
            $statusCounts = array_map(fn ($status) => $countStatus[$status] ?? 0, $statuses);

            return view('dashboard', compact('coordinates', 'statusCounts', 'statuses'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
