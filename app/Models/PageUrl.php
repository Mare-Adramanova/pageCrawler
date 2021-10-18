<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageUrl extends Model
{
    use HasFactory;

    protected $guarded = [];

      /**
     * Get the crawl that owns the pageUrl.
     */
    public function crawl()
    {
        return $this->belongsTo(Crawl::class);
    }
}
