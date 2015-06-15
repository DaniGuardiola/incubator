<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'movements';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['slug', 'name', 'technique_description_text', 'discipline_id', 'history', 'equals', 'category', 'steps', 'mistakes', 'technique', 'requirements', 'variations', 'progressions', 'derived_from'];

}
