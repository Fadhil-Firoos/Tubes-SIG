<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'fileUpload' => 'required|string',
            'widthMaintenance' => 'required',
            'lengthMaintenance' => 'required',
            'location' => 'required',
            'startDate' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            $fileName = null;
            if ($request->fileUpload){
                // Decode the Base64 image
                $imageData = base64_decode($request->fileUpload);
                // Generate a unique name for the image
                $fileName = uniqid() . '.png';
                // Save the image to the storage
                Storage::disk('public')->put("images/{$fileName}", $imageData);
                $fileName = "/storage/images/{$fileName}";
            }

            $coordinate = [
                'unique_id' => Auth::id(),
                'uuid' => Str::uuid()->toString(),
                'longlat' => $request->longlat,
                'tgl_start' => now(),
                'panjang_perbaikan' => $request->lengthMaintenance,
                'lebar_perbaikan' => $request->widthMaintenance,
                'nama_lokasi' => $request->location,
                'foto' => $fileName,
                'nama_company' => Auth::user()->name,
                'status' => 'process',
            ];
            Coordinate::create($coordinate);
            DB::commit();
            return response()->json(['success' => 'Coordinates saved successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' =>$e->getMessage()]);
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
    public function edit(Coordinate $coordinate, string $uuid)
    {
        if (strlen($uuid) < 30) {
            return redirect()->route('mapping.index');
        }

        $coordinate = Coordinate::where('uuid', $uuid)->first();
        if (!$coordinate) {
            return redirect()->route('mapping.index');
        }

        $geoJson = $this->getGeoJson();
        return view('mapping.edit', compact('coordinate', 'geoJson', 'uuid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coordinate $coordinate)
    {
        return redirect()->back();
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
