import Request from './components/Request';

const app = new Vue({
    el: '.container',
    data: {
        query: '',
        stats: {},
        services: {},
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
        },
        formattedServices: function () {
            // The order of the services is hardcoded here, just so
            // they are groupped a bit better in the font-end.
            let services = {};
            let servicesOrder = [
                'bot', 'website', 'database', 'lavalink-us', 'lavalink-eu'
            ];
            
            for (let serviceName of servicesOrder) {
                for (let service in this.services) {
                    if (serviceName == service) {
                        services[serviceName] = this.services[serviceName];
                    }
                }
            }

            return services;
        }
    }
});

const statsRequest = new Request('https://api.avairebot.com/v1/stats', {
    parseJson: true
});

const servicesRequest = new Request('https://api.avairebot.com/v1/services', {
    parseJson: true
});

const updateStats = () => {
    app.updateTime--;
    if (app.updateTime < 0) {
        statsRequest.send().then(function (data) {
            app.stats = data;
        }).catch(error => console.log('Error in stats request: ' + error));

        servicesRequest.send().then(function (data) {
            app.services = data;
        }).catch(error => console.log('Error in services request: ' + error));

        app.updateTime = 30;
    }
};

updateStats();
setInterval(updateStats, 1000);
