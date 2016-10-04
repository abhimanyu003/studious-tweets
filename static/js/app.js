new Vue({
    el: '#app',
    data: {
        tweets: [],
        busy: false,
        lastId: null,
        isLoading: true,
    },
    created: function () {
        this.fetchTweets();
    },
    methods: {
        loadMore: function () {
            this.$http.get('tweets?value=' + this.lastId).then(function (response) {
                length = response.data.data.length;
                for (var i = 0; i < length; i++) {
                    this.tweets.push(response.data.data[i]);
                }
                this.lastId = response.data.data[length - 1].id;
            });
        },
        fetchTweets: function () {
            this.$http.get('tweets').then(function (response) {
                this.tweets = response.data.data;
                length = response.data.data.length;
                this.lastId = response.data.data[length - 1].id;
                this.isLoading = false;
            });
        }
    }
});