<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\Promotion;

class Agreements extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'added_from',
        'name',
        'category_id',
        'language',
        'page_count',
        'status',
        'date',
        'description',
        'regular_price',
        'sale_price',
        'promotion_id',
        'is_featured',
        'is_recomended',
        'tags',
        'image',
        'slug',
        'agreement_text'
    ];
    
    /**
     * Create a slug from title
     * @param  string $title
     * @return string $slug
     */
    public function createSlug(string $title): string {
        $slugsFound = $this->getSlugs($title);
        $counter = (int)$slugsFound + 1;

        $slug = Str::slug($title, '-');
        if ($slugsFound) {
            $slug = $slug . '-' . $counter;
        }
        return $slug;
    }
    
    /**
     * Find same listing with same title
     * @param  string $title
     * @return int $total
     */
    protected function getSlugs($title): int {
        return self::select()->where('name', 'like', $title)->count();
    }

    public static function findBySlug($slug) {
        return self::select()->where('slug', '=', $slug)->first();
    }
    
    public function getCategoryName($id) {
        $cat = Categories::where('id', $id)->first();
        if($cat) {
            return $cat->name;
        }
    }
    
    public function getPromotionName($id) {
        $cat = Promotion::where('id', $id)->first();
        if($cat) {
            return $cat->name;
        }
    }
    
}
