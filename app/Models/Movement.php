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
	protected $fillable = [
		'discipline_id',
		'slug',
		'category',
		'name',
		'name_variants',
		'equals',
		'tags',
		'history',
		'specific',
		'technique_description_text',
		'steps',
		'advice',
		'progressions',
		'requirements',
		'derived_from',
		'variations',
	];

}
