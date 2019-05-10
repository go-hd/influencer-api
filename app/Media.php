<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $instagram_account_id
 * @property string $media_id
 * @property string $media_url
 * @property string $permalink
 * @property string $caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereInstagramAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media wherePermalink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUpdatedAt($value)
 */
class Media extends Model
{
    //
}
