<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoAddRequest;
use App\Http\Requests\VideoEditRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Exception;
class VideoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.video.list";
		$query = Video::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Video::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "video.id_video";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Video::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Video::query();
		$record = $query->findOrFail($rec_id, Video::viewFields());
		return $this->renderView("pages.video.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.video.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(VideoAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Video record
		$record = Video::create($modeldata);
		$rec_id = $record->id_video;
		return $this->redirect("video", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(VideoEditRequest $request, $rec_id = null){
		$query = Video::query();
		$record = $query->findOrFail($rec_id, Video::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("video", "Record updated successfully");
		}
		return $this->renderView("pages.video.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Video::query();
		$query->whereIn("id_video", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
