<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WartaAddRequest;
use App\Http\Requests\WartaEditRequest;
use App\Models\Warta;
use Illuminate\Http\Request;
use Exception;
class WartaController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.warta.list";
		$query = Warta::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Warta::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "warta.id_warta";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Warta::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Warta::query();
		$record = $query->findOrFail($rec_id, Warta::viewFields());
		return $this->renderView("pages.warta.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.warta.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WartaAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Warta record
		$record = Warta::create($modeldata);
		$rec_id = $record->id_warta;
		return $this->redirect("warta", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WartaEditRequest $request, $rec_id = null){
		$query = Warta::query();
		$record = $query->findOrFail($rec_id, Warta::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("warta", "Record updated successfully");
		}
		return $this->renderView("pages.warta.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Warta::query();
		$query->whereIn("id_warta", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
