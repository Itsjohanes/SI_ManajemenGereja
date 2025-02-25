<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_user_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('user', $value)->value('user');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
}
