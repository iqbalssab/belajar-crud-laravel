<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category', 'user'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        // if(isset($filters['search']) ? $filters['search'] : false){
        //     return $query->where('title', 'like', '%'. $filters['search']. '%')
        //           ->orWhere('body', 'like', '%'. $filters['search']. '%');
        // }
            // yang atas dan bawah sama aja
            // cuma yg bawah lebih simple

        // query pencarian ke semua postingan
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where(function($query) use ($search){
                   $query->where('title', 'like', '%'. $search. '%')
                             ->orWhere('body', 'like', '%'. $search. '%');
            });
        });

        // query pencarian yg berelasi dengan table category
        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        // query pencarian yg berelasi dengan table user
        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user) {
                $query->where('username', $user);
            });
        });
    }

    public function getRouteKeyName()
    {
    return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
}
