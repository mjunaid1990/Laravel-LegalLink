<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategories extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'added_from',
        'name',
        'description',
        'slug',
        'image',
        'status'
    ];
    
    /**
     * Find same listing with same title
     * @param  string $title
     * @return int $total
     */
    protected function getSlugs($title): int {
        return self::select()->where('name', 'like', $title)->count();
    }
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
    
}
