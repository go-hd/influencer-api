<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * App\InstagramAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InstagramAccount query()
 * @mixin \Eloquent
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
     * @param  array  $attributes
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
        return $this->hasMany(Media::class);
    }

    /**
     * Update the media of this Instagram account.
     *
     * @return bool
     */
    public function updateMedia(): bool
    {
        $timestamp = date('Y-m-d H:i:s');

        // Fetch data and add instagram_account_id and timestamp.
        $data = $this->getCurrentMedia(['media_url', 'caption', 'permalink'])
            ->map(function (array $media) use ($timestamp) {
                $media['instagram_account_id'] = $this->id;
                $media['media_id'] = $media['id'];
                $media['created_at'] = $timestamp;
                $media['updated_at'] = $timestamp;

                unset($media['id']);

                return $media;
            })->toArray();

        return Media::insert($data);
    }

    /**
     * Fetch current media from Instagram Graph API.
     *
     * @param array $columns
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
     * @param array $columns
     * @return string
     */
    protected function getCurrentMediaUrl(array $columns): string
    {
        $columnsQuery = implode(',', $columns);

        return "https://graph.facebook.com/v3.0/{$this->ig_business_id}" .
            "?fields=media{{$columnsQuery}}" .
            "&access_token={$this->page_access_token}";
    }
}
