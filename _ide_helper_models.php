<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\InstagramAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $label
 * @property int $ig_business_id
 * @property string $page_access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereIgBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount wherePageAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereUserId($value)
 */
	class InstagramAccount extends \Eloquent {}
}

namespace App{
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
	class Media extends \Eloquent {}
}

