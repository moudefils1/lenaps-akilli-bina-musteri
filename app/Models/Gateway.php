<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gateway extends Model
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        "name",
        "mac",
        "status",
        "brand",
        "sensitivity_rate",
        "created_by",
        "updated_by",
    ];
    protected $casts = [
        "status" => StatusEnum::class
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom("name")
            ->saveSlugsTo("slug");
    }
    public function gateways():BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }
}
