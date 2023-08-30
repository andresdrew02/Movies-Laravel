<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 *
 * @property int $id
 * @property string $text
 * @property integer $user_id
 * @property integer $movie_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 *
 * @package App\Models
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $casts = [
        'user_id' => 'int',
        'movie_id' => 'int'
    ];

    protected $fillable = [
        'comment','user_id','movie_id'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
