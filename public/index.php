<?php require __DIR__ . '/../vendor/autoload.php'; ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Alexis Tan">
    <meta name="keywords" content="AvaIre, Discord Bot, Stats, Status, Live Stats, Shards">
    <meta name="description" content="AvaIre Status, lookup the status of each shard in Ava super easily and quickly!">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="revisit-after" content="30 days">
    <meta name="distribution" content="web">

    <title>AvaIre - Live shard counter</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo mix('css/app.css'); ?>">
</head>
<body>
    <div class="container">
        <header>
            <h1>AvaIre Status</h1>
        </header>

        <div id="content">
            <div class="row">
                <div class="col-md-12" v-if="stats.hasOwnProperty('global')">
                    <p class="currently-serving">Currently serving <strong>{{ stats.global.users.toLocaleString() }}</strong> users in <strong>{{ stats.global.channels.total.toLocaleString() }}</strong> channels, and <strong>{{ stats.global.guilds.toLocaleString() }}</strong> servers.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Type the ID of one or more shards to find filter them" v-model="query">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Services</h3>
                </div>

                <div
                    v-for="(service, index) of formattedServices"
                    class="col-md-6"
                >
                    <div class="service-box">
                        <div class="row"> 
                            <div
                                class="col-md-12 service-status"
                                :class="{ 'is-healthy': service.health == 'up' }"
                            >
                                <strong>{{ service.name }}</strong> is <strong>{{ service.health.toUpperCase() }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Shards</h3>
                </div>

                <div v-for="shard of shards" class="col-md-4">
                    <div class="shard-box">
                        <h5>
                            Shard #{{ shard.id }}
                            <div class="status" v-bind:class="shard.status.toLowerCase()"></div>
                        </h5>

                        <div class="row" v-if="shard.status == 'CONNECTED'">
                            <div class="col-md-6">
                                <strong>Users:</strong> {{ shard.users.toLocaleString() }}
                            </div>
                            <div class="col-md-6">
                                <strong>Channels:</strong> {{ shard.channels.toLocaleString() }}
                            </div>
                            <div class="col-md-6">
                                <strong>Servers:</strong> {{ shard.guilds.toLocaleString() }}
                            </div>
                            <div class="col-md-6">
                                <strong>Latency:</strong> {{ shard.latency.toLocaleString() }} ms
                            </div>
                        </div>

                        <div class="row" v-else> 
                            <div class="col-md-12">
                                <p class="error">{{ prettify(shard.status) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>

        <footer>
            <p>Refreshing in <span id="refresh_counter"><a href="#">{{ updateTime }}</a></span> seconds.</p>
            <p>
                Created by <a href="https://senither.com/">Alexis Tan</a>, powered by <a href="https://m.do.co/c/9f589c4101c3">Digital Ocean</a>, <a href="http://getbootstrap.com/">Bootstrap</a>, and <a href="https://vuejs.org/">VueJS</a>.
                <br>Not enough for you? Checkout the <a href="https://metrics.avairebot.com/dashboard/db/avaire-dashboard?orgId=1&from=now-6h&to=now&refresh=30s">live metrics</a> for all of Ava.
                <br>Get the <a href="https://github.com/avaire/status">source code</a> on <a href="https://github.com/avaire/status">GitHub</a>.
            </p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="<?php echo mix('js/app.js') ?>"></script>
</body>
</html>
