<?php

declare (strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignMetadata extends Model
{
    use HasFactory;

    /**
     * The table name.
     */
    const TABLE_NAME = 'campaign_metadata';

    /**
     * The identificator field.
     */
    const FIELD_ID = 'id';

    /**
     * The campaign identificator field.
     */
    const FIELD_CAMPAIGN_ID = 'campaign_id';

    /**
     * The start time field.
     */
    const FIELD_START_TIME = 'start_time';

    /**
     * The end time field.
     */
    const FIELD_END_TIME = 'end_time';

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
        self::FIELD_CAMPAIGN_ID,
        self::FIELD_START_TIME,
        self::FIELD_END_TIME,
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
