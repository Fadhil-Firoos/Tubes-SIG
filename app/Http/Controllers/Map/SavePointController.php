<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavePointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinates = Coordinate::where('unique_id', Auth::id())->get();
        $geoJson = $this->getGeoJson();
        return view('mapping.index', compact('coordinates', 'geoJson'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $geoJson = $this->getGeoJson();
        return view('mapping.create', compact('geoJson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'longlat' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            $coordinate = [
                'unique_id' => Auth::id(),
                'uuid' => uniqid(),
                'longlat' => $request->longlat,
                'tgl_start' => now(),
            ];
            Coordinate::create($coordinate);
            DB::commit();
            return response()->json(['success' => 'Coordinates saved successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to save coordinates']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinate $coordinate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coordinate $coordinate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coordinate $coordinate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinate $coordinate)
    {
        //
    }

    private function getGeoJson()
    {
        // Query the geo_data table
        $geoData = DB::table('geo_data')
        ->select('id', 'name', DB::raw('ST_AsGeoJSON(geom) as geojson'))
        ->get();

        // Rebuild GeoJSON structure
        $features = $geoData->map(function ($data) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'id' => $data->id,
                    'name' => $data->name, // Include any additional properties as needed
                ],
                'geometry' => json_decode($data->geojson), // Decode the geometry GeoJSON
            ];
        });

        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
        return json_encode($geoJson);
    }
}
