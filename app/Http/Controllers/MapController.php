<?php

namespace App\Http\Controllers;

use App\Models\Site; // Menggunakan model Site
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Mengambil data lokasi site dan mengubahnya menjadi format GeoJSON.
     */
    public function towerLocations()
    {
        // Eager load relasi towers untuk menghindari N+1 problem
        $sites = Site::with('towers')->whereNotNull('latitude')->whereNotNull('longitude')->get();

        // Mengubah koleksi data menjadi format GeoJSON
        $geoJson = $sites->map(function($site) {
            // Membangun konten HTML untuk popup
            $popupHtml = "<div><strong class='text-lg'>{$site->name}</strong><br>";
            $popupHtml .= "<strong>Lokasi:</strong> {$site->location}<br>";
            $popupHtml .= "<strong>Region:</strong> {$site->region}<hr class='my-2'>";

            if ($site->towers->isNotEmpty()) {
                $popupHtml .= "<strong class='text-md'>Data Tower:</strong>";
                $popupHtml .= "<ul class='list-disc pl-5 mt-1'>";
                foreach ($site->towers as $tower) {
                    $popupHtml .= "<li><strong>Tipe:</strong> {$tower->repeater_type} ({$tower->system})</li>";
                }
                $popupHtml .= "</ul>";
            } else {
                $popupHtml .= "<em>Tidak ada data tower untuk site ini.</em>";
            }
            $popupHtml .= "</div>";

            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$site->longitude, $site->latitude],
                ],
                'properties' => [
                    // Kita kirim HTML yang sudah jadi ke frontend
                    'popup_html' => $popupHtml,
                ],
            ];
        });

        // Mengembalikan response dalam format JSON
        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJson,
        ]);
    }
}
