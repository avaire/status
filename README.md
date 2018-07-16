## About Status

AvaIre Status is a small single page web app that shows information about each shard in Ava, and auto updates every 30 seconds, you can see the live version of the site by [clicking here](https://status.avairebot.com/).

This project uses [Composer](https://getcomposer.org/) for managing PHP packages, and [Yarn](https://yarnpkg.com/) for managing Node modules, if you want to self-host the status page you can clone the repository, and setup everything using:

    composer install & yarn && yarn prod

The API endpoint that are hit to display the shard data is stored in the `assets/js/app.js` file, you can change it to anything else that returns a valid JSON object matching the one Ava sends.

An example of a valid JSON response from the API.

```json
{
    "shards":[
        {
            "channels": 13145,
            "guilds": 860,
            "latency": 115,
            "id": 1,
            "users": 20168,
            "status": "CONNECTED"
        },
        {
            "channels": 12397,
            "guilds": 811,
            "latency": 112,
            "id": 0,
            "users": 15002,
            "status": "CONNECTED"
        }
    ],
    "global": {
        "channels": {
            "voice": 113882,
            "total": 279007,
            "text": 165125
        },
        "guilds": 17674,
        "users": 568817
    }
}
```

The status on the page will change color depending on the status returned from the API, the status names are the [JDA Statuses](https://github.com/DV8FromTheWorld/JDA/blob/3092875bd5fd1eec10f4973a34a13ab6b4170c6e/src/main/java/net/dv8tion/jda/core/JDA.java#L43), you can see what color is giving to what status in the `assets/sass/app.sass` file.

## License

AvaIre Status is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
