<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RenunganAddRequest;
use App\Http\Requests\RenunganEditRequest;
use App\Models\Renungan;
use Illuminate\Http\Request;
use Exception;
class RenunganController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.renungan.list";
		$query = Renungan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Renungan::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "renungan.id_renungan";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Renungan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Renungan::query();
		$record = $query->findOrFail($rec_id, Renungan::viewFields());
		return $this->renderView("pages.renungan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.renungan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(RenunganAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Renungan record
		$record = Renungan::create($modeldata);
		$rec_id = $record->id_renungan;
		return $this->redirect("renungan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(RenunganEditRequest $request, $rec_id = null){
		$query = Renungan::query();
		$record = $query->findOrFail($rec_id, Renungan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("renungan", "Record updated successfully");
		}
		return $this->renderView("pages.renungan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Renungan::query();
		$query->whereIn("id_renungan", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
