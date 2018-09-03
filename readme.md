### Mini Api Starter

Use this project for writing any new code which will have any endpoints.

### Requirements:

- php > 7.1
- ext-json: *

### Setup:
```bash
git clone git@github.com:crazy-factory/api-package-starter.git project
cd project
rm .git
git init
git add .
git commit -m 'WIP: initial commit'
```

Simply make a initial commit.

### Starting project:
```bash
php -S 127.0.0.1:8000 -t public
```
and it should start development server.

### Viewing routes:
```bash
php crazy.php route:list
```
Should display all registered routes

### Gotchas:
sdk generation isn't done yet, but will be done soon, before this project is adapted, sdk is supposed to work.

### Defining a new route:
Open `src/Routes.php` and add to registerRoutes method
```php
$routeCollection->add("name", $this->get('/path/to/route', Controller::class, 'methodName'));
```

### Creating a new controller.
- `php crazy.php make:controller`
- Enter name of controller, eg: UserController

### Creating a new command
- `php crazy.php make:command`
- enter command name which will trigger that command
- enter command description
- register command to crazy.php
