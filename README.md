
Fetch tweets as per given #hash tags that have at least one re-tweet.


## Requirements

* PHP 5.6 or Greater
* Nginx
* Redis


## Installation

* Clone the repo
* Run `composer install`
* Create new app at https://apps.twitter.com/app/
* Provide the API keys `app/Config/Config.php`

## Disabling Redis Cache.


If you want to disable redis cache simply open `app/Config/Config.php` and change.

```
    'redis_cache' => [
        'enabled' => false,
    ]
```


## Build Using

* PHP 5.6
* [nikic/FastRoute](https://github.com/nikic/FastRoute)
* [nrk/predis](https://github.com/nrk/predis)
* [Vue.js](https://github.com/vuejs/vue)
* [Bootstrap](http://getbootstrap.com/)


## Nginx Routing


You can configure your `nginx` routing like this.

```
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
```

## Adding New Page

* Open `index.php`
* Specify the routing url and method to execute.
* Create a controller in `app/Controllers` folder with properl name space.
* Run `composer dump-autoload`
* Done.