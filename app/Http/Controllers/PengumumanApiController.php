<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengumumanAddRequest;
use App\Http\Requests\PengumumanEditRequest;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Exception;

class PengumumanApiController extends Controller{
    
    // API endpoint to get all Pengumuman
    public function getAll(){
        try {
            $pengumuman = Pengumuman::all();
            return response()->json([
                'success' => true,
                'data' => $pengumuman
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
