<?php

declare (strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Banner extends Model
{
    use HasFactory;

    /**
     * The table name.
     */
    const TABLE_NAME = 'banners';

    /**
     * The identificator field.
     */
    const FIELD_ID = 'id';

    /**
     * The name field.
     */
    const FIELD_NAME = 'name';

    /**
     * The text field.
     */
    const FIELD_TEXT = 'text';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_TEXT,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * The campaigns that belong to the banner.
     *
     * @return BelongsToMany
     */
    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class);
    }
}
