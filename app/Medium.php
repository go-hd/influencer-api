<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Medium
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $instagram_account_id
 * @property string $media_id
 * @property string $media_url
 * @property string $permalink
 * @property string $caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereInstagramAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium wherePermalink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereUpdatedAt($value)
 * @property int $omit
 * @property-read \App\InstagramAccount $instagramAccount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medium whereOmit($value)
 */
class Medium extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['omit'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['omit', 'created_at', 'updated_at'];

    /**
     * Get the Instagram account this media belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instagramAccount()
    {
        return $this->belongsTo(InstagramAccount::class);
    }
}
