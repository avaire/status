import Request from './components/Request';

const app = new Vue({
    el: '.container',
    data: {
        query: '',
        stats: {},
        updateTime: 0
    },
    methods: {
        prettify: function (string) {
            string = string.toLowerCase().replace(/_/g, ' ');
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    },
    computed: {
        shards: function () {
            if (! this.stats.hasOwnProperty('shards')) {
                return [];
            }

            let shards = this.stats.shards;
            if (this.query.length > 0) {
                let query = this.query.trim().split(/[\s,]+/);
                shards = shards.filter((shard, index) => {
                    return query.indexOf(shard.id.toString()) > -1;
                });
            }
            return shards;
        }
    }
});

const request = new Request('https://api.avairebot.com/v1/stats', {
    parseJson: true
});

const updateStats = () => {
    app.updateTime--;
    if (app.updateTime < 0) {
        request.send().then(function (data) {
            app.stats = data;
        }).catch(error => console.log('Error: ' + error));
        app.updateTime = 30;
    }
};

updateStats();
setInterval(updateStats, 1000);
