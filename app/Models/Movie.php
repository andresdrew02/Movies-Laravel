<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $stars
 * @property string $image_url
 * @property int $category_id
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 *
 * @package App\Models
 */
class Movie extends Model
{
	protected $table = 'movies';

	protected $casts = [
		'stars' => 'float',
		'category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'stars',
		'image_url',
		'category_id',
		'slug'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
