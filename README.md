# Remote Company Test

### Installation
- Clone the repo
- `cd` to the project folder
- Run `composer install`
- If you don't have a `.env` file after installing the project run `cp .env.example .env`
- Run `php artisan key:generate`
- Change the DB related configurations on the `.env` file. I used sqlite for simplicity
- Run `php artisan config:cache`
- Run `php artisan migrate`
- Run `npm install`
- Run `npm run dev`

### Tests
Run `php artisan test`
