<?php

namespace App\Models;

use App\Traits\GenerateUUIDTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    use GenerateUUIDTrait;

    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'categories_id'
    ];


    public function blogImages()
    {
        return $this->hasMany(BlogImage::class);
    }


    public function blogComments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSingleBlogImage($id)
    {
        $blog = Blog::find($id);

        return $blog->blogImages()->where('is_main', true)->first();
    }

    public function getBlogCreatedHours($id)
    {
        $blog = Blog::find($id);
        $currentTime = Carbon::now();
        $blogCreatedTime = new Carbon($blog->created_at);

        return (int) $blogCreatedTime->diffInHours($currentTime);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
