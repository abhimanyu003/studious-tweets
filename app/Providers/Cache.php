<?php
namespace App\Providers;

class Cache
{
    /**
     * Redis client object.
     *
     * @var \Predis\Client
     */
    public $cache;

    /**
     * Contains all the configuration
     *
     * @var mixed
     */
    protected $config;

    /**
     * Cache constructor.
     */
    public function __construct()
    {
        $this->cache = new \Predis\Client();
        $this->config = (new Config())->config;
    }

    /**
     * Method add tweet to redis database.
     *
     * @param $id ID of tweet.
     * @param array $data Tweet array to store in database.
     */
    public function cache($id, $data)
    {
        if (!$this->config['redis_cache']['enabled']) {
            return false;
        }

        // Adds tweets with specified scores to the sorted set stored at key.
        $this->cache->zadd('tweet', [$id => $id]);

        // Add tweets to specified fields to their respective values in the hash stored at key.
        $this->cache->hmset(sprintf('tweet:%s', $id), $data);
    }

    /**
     * Check if given tweet key exists in database,
     * If exists then return true else false.
     *
     * @param string $key ID of tweet that is to be checked
     * @return bool true if exists false if not
     */
    public function checkIfExists($key)
    {
        $exists = false;
        if ($this->cache->exists(sprintf('tweet:%s', $key))) {
            $exists = true;
        }

        return $exists;
    }

    /**
     * Get all tweets from database older then give ID. Method accepts
     * the tweet ID, which acts as marker to get all the older
     * tweets from that specific ID
     *
     * @param string $key Tweet ID
     * @return array
     */
    public function getCachedTweets($id)
    {
        $output = false;

        // Checks if redis caching is enabled or not if not then return immediately
        if (!$this->config['redis_cache']['enabled']) {
            return false;
        }

        if ($this->checkIfExists($id)) {

            // Get all the tweets from starting from given ID and limit them
            $value = $this->cache->zrevrangebyscore('tweet', $id, '-inf', ['limit' => ['offset' => 0, 'count' => 20]]);

            // Loop over all the keys
            foreach ($value as $key) {

                // Ignore if ID is same as that of given ID
                if ($key != $id) {
                    // Get all tweets from database.
                    $output[] = $this->cache->hgetall(sprintf('tweet:%s', $key));
                }
            }
        }

        return $output;
    }
}
