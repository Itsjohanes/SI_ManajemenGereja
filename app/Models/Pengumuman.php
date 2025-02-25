<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pengumuman extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pengumuman';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_pengumuman';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'gambar','judul','isi','tanggal'
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
				id_pengumuman LIKE ?  OR 
				gambar LIKE ?  OR 
				judul LIKE ?  OR 
				isi LIKE ? 
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
			"id_pengumuman",
			"gambar",
			"judul",
			"isi",
			"tanggal" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_pengumuman",
			"gambar",
			"judul",
			"isi",
			"tanggal" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_pengumuman",
			"gambar",
			"judul",
			"isi",
			"tanggal" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_pengumuman",
			"gambar",
			"judul",
			"isi",
			"tanggal" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_pengumuman",
			"gambar",
			"judul",
			"isi",
			"tanggal" 
		];
	}
}
