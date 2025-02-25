<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Persembahan extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'persembahan';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_persembahan';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'judul','norek','bank'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id_persembahan LIKE ?  OR 
				judul LIKE ?  OR 
				norek LIKE ?  OR 
				bank LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id_persembahan",
			"judul",
			"norek",
			"bank" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_persembahan",
			"judul",
			"norek",
			"bank" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_persembahan",
			"judul",
			"norek",
			"bank" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_persembahan",
			"judul",
			"norek",
			"bank" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_persembahan",
			"judul",
			"norek",
			"bank" 
		];
	}
}
