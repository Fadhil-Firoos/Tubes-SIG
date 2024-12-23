<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get file .json in same folder
        $geoJson = file_get_contents(__DIR__ . '/geoJson.json');
        $geoJsonData = json_decode($geoJson, true);

        // Check if the GeoJSON contains a FeatureCollection
        if (isset($geoJsonData['type']) && $geoJsonData['type'] === 'FeatureCollection') {
            foreach ($geoJsonData['features'] as $index => $feature) {
                // Convert the geometry part to a JSON string
                $geometryJson = json_encode($feature['geometry']);
                
                // Use a placeholder name or generate a unique identifier
                $name = "Feature_{$index}";

                // Insert into the database
                DB::statement("
                    INSERT INTO geo_data (name, geom)
                    VALUES (?, ST_GeomFromGeoJSON(?))
                ", [$name, $geometryJson]);
            }
        } else {
            $this->command->error('Invalid GeoJSON format. Expected a FeatureCollection.');
        }
    }
}
