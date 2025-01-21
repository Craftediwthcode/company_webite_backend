<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class Page extends Model
{

    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'title',
        'sub_title',
        'parent_id',
        'slug',
        'description',
        'banner_image',
        'type',
        'image',
        'status'
    ];
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    /**
     * Get the Seo model associated with this page
     *
     * @return \RalphJSmit\Laravel\SEO\Models\SEO
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'model');
    }

    /**
     * The parent page of this page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Page>
     */
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * The children of this page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Page>
     */
    public function children()
    {
        return $this->hasOne(Page::class, 'parent_id');
    }
}
