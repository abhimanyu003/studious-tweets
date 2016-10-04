<?php
namespace App\Providers;

use TwitterAPIExchange;

class Twitter
{
    /**
     * @var TwitterAPIExchange
     */
    protected $twitter;

    /**
     * @var
     */
    protected $value;

    /**
     * Twitter constructor.
     */
    public function __construct()
    {
        $this->twitter = new TwitterAPIExchange((new Config())->config['twitter']);
        $this->config = (new Config())->config;
        $this->cache = new Cache();
    }

    /**
     * Search Tweets by making twitter api calls.
     *
     * @return string
     */
    public function searchTweets()
    {
        // Fetch tweets based in query sting.
        $fields = sprintf('?q=%s&count=50', $this->config['search']['hash']);
        if (isset($_GET['value'])) {
            $this->value = $_GET['value'];
            $fields = sprintf('?q=%s&count=50&max_id=%s', $this->config['search']['hash'], $this->value);
        }

        // Get cached tweets if no cached tweet found fetch the new one.
        $tweets = $this->cache->getCachedTweets($this->value);
        if (!$tweets) {

            $response = $this->twitter->setGetfield($fields)->buildOauth('https://api.twitter.com/1.1/search/tweets.json', 'GET')->performRequest();

            // Format payload for output
            $tweets = $this->processTweets($response, $this->value);
        }

        return json_encode(['data' => $tweets]);
    }

    /**
     * Method formats tweets for payload, also ignores tweets
     * of which have same ID as that last tweet fetched
     * in the last request.
     *
     * @param $response
     * @return array
     */
    protected function processTweets($response, $id = false)
    {
        $tweets = json_decode($response);
        $output = [];
        // Loop over every object
        foreach ($tweets->statuses as $tweet) {
            // Ignore tweet which has same ID as that of last tweet fetched.
            if ($tweet->retweet_count >= $this->config['search']['fav_count'] and $tweet->id != $id) {
                $status = [
                    'id'                => (string)$tweet->id,
                    'username'          => $tweet->user->name,
                    'screen_name'       => $tweet->user->screen_name,
                    'profile_image_url' => $tweet->user->profile_image_url,
                    'retweet_count'     => $tweet->retweet_count,
                    'text'              => $tweet->text,
                    'favorite_count'    => $tweet->favorite_count,
                ];
                array_push($output, $status);
                $this->doCaching((string)$tweet->id, $status);
            }

        }

        return $output;
    }

    /**
     * Cache tweets.
     *
     * @param $id
     * @param $data
     */
    protected function doCaching($id, $data)
    {
        $this->cache->cache($id, $data);
    }
}
