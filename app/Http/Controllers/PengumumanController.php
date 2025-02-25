<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengumumanAddRequest;
use App\Http\Requests\PengumumanEditRequest;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Exception;
class PengumumanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pengumuman.list";
		$query = Pengumuman::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pengumuman::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pengumuman.id_pengumuman";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pengumuman::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Pengumuman::query();
		$record = $query->findOrFail($rec_id, Pengumuman::viewFields());
		return $this->renderView("pages.pengumuman.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pengumuman.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PengumumanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		// Handle file upload with encrypted filename
		if ($request->hasFile('gambar')) {
			$file = $request->file('gambar');
			$filename = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
			$path = $file->storeAs('uploads', $filename, 'public'); // Simpan ke storage/app/public/uploads
			$modeldata['gambar'] = $path;
		}
		// Save Pengumuman record
		$record = Pengumuman::create($modeldata);
		$rec_id = $record->id_pengumuman;
		
		return $this->redirect("pengumuman", "Record added successfully");
	}
	
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PengumumanEditRequest $request, $rec_id = null){
		$query = Pengumuman::query();
		$record = $query->findOrFail($rec_id);
		
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			
			// Handle file upload with encrypted filename if a new file is uploaded
			if ($request->hasFile('gambar')) {
				$file = $request->file('gambar');
				$filename = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
				$path = $file->storeAs('uploads', $filename, 'public');
				
				// Delete old file
				if ($record->gambar) {
					Storage::disk('public')->delete($record->gambar);
				}
				
				$modeldata['gambar'] = $path;
			}
			
			$record->update($modeldata);
			return $this->redirect("pengumuman", "Record updated successfully");
		}
		
		return $this->renderView("pages.pengumuman.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Pengumuman::query();
		$query->whereIn("id_pengumuman", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
