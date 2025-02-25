<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WartaAddRequest;
use App\Http\Requests\WartaEditRequest;
use App\Models\Warta;
use Illuminate\Http\Request;
use Exception;
class WartaApiController extends Controller
{
	

	public function getAll(){
        try {
            $warta = Warta::all();
            return response()->json([
                'success' => true,
                'data' => $warta
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
