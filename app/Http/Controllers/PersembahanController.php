<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersembahanAddRequest;
use App\Http\Requests\PersembahanEditRequest;
use App\Models\Persembahan;
use Illuminate\Http\Request;
use Exception;
class PersembahanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.persembahan.list";
		$query = Persembahan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Persembahan::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "persembahan.id_persembahan";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Persembahan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Persembahan::query();
		$record = $query->findOrFail($rec_id, Persembahan::viewFields());
		return $this->renderView("pages.persembahan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.persembahan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PersembahanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Persembahan record
		$record = Persembahan::create($modeldata);
		$rec_id = $record->id_persembahan;
		return $this->redirect("persembahan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PersembahanEditRequest $request, $rec_id = null){
		$query = Persembahan::query();
		$record = $query->findOrFail($rec_id, Persembahan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("persembahan", "Record updated successfully");
		}
		return $this->renderView("pages.persembahan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Persembahan::query();
		$query->whereIn("id_persembahan", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
