<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Medium[] $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereIgBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount wherePageAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount whereUserId($value)
 * @property-read \App\User $user
 */
class InstagramAccount extends Model
{
    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'label',
        'ig_business_id',
        'page_access_token',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->client = new Client();
        parent::__construct($attributes);
    }

    /**
     * Get the media that this account has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media(): HasMany
    {
        return $this->hasMany(Medium::class);
    }

    /**
     * Get the user this account belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Search media by query this Instagram account has.
     *
     * @param  array $attribute
     * @return \Illuminate\Support\Collection
     */
    public function searchMedia(array $attribute): Collection
    {
        $query = $this->media()->where('omit', 0);

        if (!empty($attribute['contains'])) {
            $query->where('caption', 'like', '%' . $attribute['contains'] . '%');
        }

        if (!empty($attribute['omit'])) {
            $query->where('caption', 'not like', '%' . $attribute['omit'] . '%');
        }

        return $query->get();
    }

    /**
     * Update the media of this Instagram account.
     *
     * @return bool
     */
    public function updateMedia(): bool
    {
        $timestamp = date('Y-m-d H:i:s');
        $omittedMedia = $this->media()->where('omit', true)->get()
            ->map(function (Medium $medium) {
                return $medium['media_id'];
            });

        $this->media()->delete();

        // Fetch data and add instagram_account_id and timestamp.
        $data = $this->getCurrentMedia(['media_url', 'caption', 'permalink'])
            ->map(function (array $medium) use ($timestamp, $omittedMedia) {
                $medium['instagram_account_id'] = $this->id;
                $medium['media_id'] = $medium['id'];
                $medium['omit'] = $omittedMedia->contains($medium['media_id']);
                $medium['created_at'] = $timestamp;
                $medium['updated_at'] = $timestamp;

                unset($medium['id']);

                return $medium;
            })->toArray();

        return $this->media()->insert($data);
    }

    /**
     * Fetch current media from Instagram Graph API.
     *
     * @param  array $columns
     * @return \Illuminate\Support\Collection
     */
    protected function getCurrentMedia(array $columns): Collection
    {
        $url = $this->getCurrentMediaUrl($columns);
        $data = json_decode($this->client->get($url)->getBody()->getContents(), true)['media']['data'];

        return collect($data);
    }

    /**
     * Get the URL of Instagram Graph API.
     *
     * @param  array $columns
     * @return string
     */
    protected function getCurrentMediaUrl(array $columns): string
    {
        $columnsQuery = implode(',', $columns);

        return "https://graph.facebook.com/v3.0/{$this->ig_business_id}" .
            "?fields=media{{$columnsQuery}}" .
            "&access_token={$this->page_access_token}";
    }

    /**
     * Create a new Instagram account and fetch the media this account has.
     *
     * @param  array $attributes
     * @return bool
     */
    static public function create(array $attributes): bool
    {
        $attributes['user_id'] = \Auth::user()->id;

        try {
            $result = \DB::transaction(function () use ($attributes) {
                $instance = new static($attributes);
                return $instance->save()
                    && $instance->updateMedia();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        return $result;
    }

    /**
     * Delete this Instagram account and the media this account has.
     *
     * @return bool
     */
    public function delete(): bool
    {
        try {
            $result = \DB::transaction(function () {
                return $this->media()->delete()
                    && parent::delete();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        return $result;
    }

    /**
     * Update the Instagram account and fetch the media this account has.
     *
     * @param  array $attributes
     * @param  array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        try {
            $result = \DB::transaction(function () use ($attributes, $options) {
                return parent::update($attributes, $options)
                    && $this->updateMedia();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        return $result;
    }
}
