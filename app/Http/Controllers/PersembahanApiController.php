<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersembahanAddRequest;
use App\Http\Requests\PersembahanEditRequest;
use App\Models\Persembahan;
use Illuminate\Http\Request;
use Exception;
class PersembahanApiController extends Controller
{
	// API endpoint to get all persembahan
    public function getAll(){
        try {
            $persembahan = Persembahan::all();
            return response()->json([
                'success' => true,
                'data' => $persembahan
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
