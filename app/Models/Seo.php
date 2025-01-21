<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'seo';
    protected $fillable = [
        'model_type',
        'model_id',
        'description',
        'title',
        'keywords',
        'image',
        'author',
        'robots',
        'seo_url',
        'canonical_url',
    ];
    /**
     * The model that owns this Seo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(Page::class);
    }
}
