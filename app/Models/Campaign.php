<?php

declare (strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The table name.
     */
    const TABLE_NAME = 'campaigns';

    /**
     * The identificator field.
     */
    const FIELD_ID = 'id';

    /**
     * The name field.
     */
    const FIELD_NAME = 'name';

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
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['banners', 'metadata'];

    /**
     * The banners that belong to the campaign.
     *
     * @return BelongsToMany
     */
    public function banners(): BelongsToMany
    {
        return $this->belongsToMany(Banner::class);
    }

    /**
     * Get the metadata for the campaign.
     *
     * @return HasMany
     */
    public function metadata(): HasMany
    {
        return $this->hasMany(CampaignMetadata::class);
    }

    /**
     * Get the status field
     *
     * @return void
     */
    public function getStatus()
    {
        $status = 'Not Active';
        $now = time();

        foreach ($this->metadata as $meta) {
            $start = strtotime($meta[CampaignMetadata::FIELD_START_TIME]);
            $end = strtotime($meta[CampaignMetadata::FIELD_END_TIME]);

            if ($start <= $now && $end >= $now) {
                $status = 'Active';
                break;
            }
        }

        return $status;
    }

    /**
     * Save related Banners
     *
     * @param  array $banners
     *
     * @return void
     */
    public function saveBanners(array $banners): void
    {
        $this->banners()->sync($banners);
    }

    /**
     * Save related Metadata
     *
     * @param  array $metadata
     * @return void
     */
    public function saveMetadata(array $metadata): void
    {
        $count = count($metadata);
        $index = 0;
        $data = [];

        sort($metadata);

        for ($i = 0; $i < $count; $i++) {
            if ($i > 0 && $metadata[$i] - $metadata[$i - 1] > 1) {
                $index++;
            }

            if (!isset($data[$index]['start_time'])) {
                $data[$index]['start_time'] = $metadata[$i] . ":00:00";
            }

            $data[$index]['end_time'] = $metadata[$i] . ":59:59";
        }

        $this->metadata()->delete();
        $this->metadata()->createMany($data);
    }
}
