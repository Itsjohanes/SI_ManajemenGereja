<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RenunganAddRequest;
use App\Http\Requests\RenunganEditRequest;
use App\Models\Renungan;
use Illuminate\Http\Request;
use Exception;
class RenunganApiController extends Controller
{
	// API endpoint to get all persembahan
    public function getAll(){
        try {
            $renungan = Renungan::all();
            
            $renungan = Renungan::orderBy('id_renungan', 'desc')->get();
            return response()->json([
                'success' => true,
                'data' => $renungan
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
