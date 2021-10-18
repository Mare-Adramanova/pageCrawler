<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crawl extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the pageUrls for the crawled page.
     */
    public function pageUrls()
    {
        return $this->hasMany(PageUrl::class);
    }
}
