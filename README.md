## About Status

AvaIre Status is a small single page web app that shows information about each shard in Ava, and auto updates every 30 seconds, you can see the live version of the site by [clicking here](https://status.avairebot.com/).

This project uses [Composer](https://getcomposer.org/) for managing PHP packages, and [Yarn](https://yarnpkg.com/) for managing Node modules, if you want to self-host the status page you can clone the repository, and setup everything using:

    composer install & yarn && yarn prod

The API endpoint that are hit to display the shard data is stored in the `assets/js/app.js` file, you can change it to anything else that returns a valid JSON object matching the one Ava sends.

More information coming soon...

## License

AvaIre Status is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
