<?php
/**
 * @author Abhimanyu Sharma <abhimanyusharma003@gmail.com>
 */

namespace App\Controllers;

use App\Providers\Twitter;

class HomeController
{
    /**
     * @var Twitter
     */
    protected $twitter;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->twitter = new Twitter();
    }

    /**
     * Index method renders the template.
     */
    public function index()
    {
        return view('index.php');
    }

    /**
     * Process request and send output in json format.
     *
     * @return mixed
     */
    public function tweets()
    {
        return json($this->twitter->searchTweets());
    }
}
