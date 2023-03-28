<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'post_name',
       'post_image',
       'description',
       'added_by',
       'updated_by',
       'deleted_by'
    ];

    public function AddedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
