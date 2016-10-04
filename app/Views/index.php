<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
<!--.container-->
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Twitter</a>
            </div>
        </div><!--/.container-fluid -->
    </nav>
</div>
<!--./container-->

<!--.container-->
<div class="container">
    <div id="app">
        <div class="container content">

            <div class="col-md-12 text-center" v-if="isLoading">
                <h3>Fetching Tweets</h3>
            </div>

            <div v-for="tweet in tweets">
                <div class="row" v-bind:data-tweetid="tweet.id">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="testimonials">
                            <div class="active item">
                                <div class="carousel-info">
                                    <img v-bind:src="tweet.profile_image_url" class="pull-left">
                                    <div class="pull-left">
                                        <span class="testimonials-name">{{ tweet.username }}</span>
                                        <span class="testimonials-post">@{{ tweet.screen_name }}</span>
                                    </div>
                                </div>
                                <blockquote>
                                    <p>{{ tweet.text }}</p>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-retweet fa-fw"></i> {{ tweet.retweet_count }}</li>
                                        <li><i class="fa fa-heart fa-fw"></i> {{ tweet.favorite_count }}</li>
                                    </ul>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-success" v-on:click="loadMore">Load More</button>
            </div>
        </div>
    </div>
</div>
<!--./container-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
<script src="static/js/app.js"></script>
<script src="http://algo.dev/static/js/vue-infinite-scroll.js"></script>
</body>
</html>