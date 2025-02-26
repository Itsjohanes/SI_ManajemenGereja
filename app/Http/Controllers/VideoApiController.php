<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoAddRequest;
use App\Http\Requests\VideoEditRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Exception;
class VideoApiController extends Controller
{
	// API endpoint to get all persembahan
    public function getAll(){
        try {
            $video = Video::all();
            $video = Video::orderBy('id_video', 'desc')->get();

            return response()->json([
                'success' => true,
                'data' => $video
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
