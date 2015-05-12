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
	protected $fillable = ['slug', 'name', 'video_id', 'img_id', 'gif_id', 'discipline_id', 'video_id', 'equals', 'category', 'info', 'mistakes', 'technique', 'requirements', 'progressions', 'derived_from'];

}
