import http from 'http';
import https from 'https';

export default class Request {
    constructor(url, options = {}) {
        if (url === null || url === undefined || typeof url !== 'string') {
            throw new Error('Invalid request argument given, the url must be an string!');
        }

        this.url = url;
        this.options = options;
        this.client = http;

        if (this.url.indexOf('https://') === 0) {
            this.client = https;
        }
    }

    async send() {
        return new Promise((resolve, reject) => {
            this.client.get(this.url, (response) => this.readResponse(response, resolve, reject))
                .on('error', (error) => reject(error));
        });
    }

    readResponse(response, resolve, reject) {
        let data = '';

        response.on('data', (chunk) => data += chunk);
        response.on('end', () => {
            if (this.options.hasOwnProperty('parseJson') && this.options.parseJson) {
                return resolve(JSON.parse(data));
            }
            return resolve(data);
        });
    }
}
