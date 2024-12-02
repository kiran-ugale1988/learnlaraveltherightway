## About Laravel

curl -s "https://laravel.build/learnlaraveltherightway" | bash
cd learnlaraveltherightway/
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate

add APP_PORT=8081 im .env file
and then ./vendor/bin/sail down and ./vendor/bin/sail up -d


ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail shell
sail@bf60c29a74fb:/var/www/html$ php artisan list


laravel - tinker 
it is Read, eval, print, loop
- To experiment and debug 
- 
ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail artisan tinker
ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail artisan tinker
Psy Shell v0.12.4 (PHP 8.3.12 — cli) by Justin Hileman
> $date = date('m-d-y');
= "11-05-24"

> $date
= "11-05-24"

> config('app.name')
= "Laravel"

> down

   INFO  Application is now in maintenance mode.  

> up

   INFO  Application is now live.  

> env('APP_NAME')
= "Laravel"

> App::environment()
= "local"

> App::isProduction()
= false

> App::isLocal()
= true

> App::hasDebugModeEnabled()
= true

> history
 0: $date = date('m-d-y');
 1: $date
 2: config('app.name')
 3: down
 4: up
 5: env('APP_NAME')
 6: App::envoirnment()
 7: App::enviornment()
 8: App::environment()
 9: App::isProduction()
10: App::isLocal()
11: App::hasEnableDebugMode()
12: App::hasDebugModeEnabled()

ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail artisan config:cache
=>INFO  Configuration cached successfully.  

ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail artisan config:clear
=> INFO  Configuration cache cleared successfully.  

Publish config files:
 ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ php artisan config:publish

 ┌ Which configuration file would you like to publish? ─────────┐
 │ broadcasting                                                 │
 └──────────────────────────────────────────────────────────────┘


 ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail shell
sail@bf60c29a74fb:/var/www/html$ php artisan vendor:publish --provider="Laravel\Tinker\TinkerServiceProvider"

   INFO  Publishing assets.  

  Copying file [vendor/laravel/tinker/config/tinker.php] to [config/tinker.php] ................................... DONE

sail@bf60c29a74fb:/var/www/html$ 


=====Routes====
php artisan route:list
php artisan route:list --except-vendor

# php artisan route:list --help
Description:
  List all registered routes

Usage:
  route:list [options]

Options:
      --json                       Output the route list as JSON
      --method[=METHOD]            Filter the routes by method
      --name[=NAME]                Filter the routes by name
      --domain[=DOMAIN]            Filter the routes by domain
      --path[=PATH]                Only show routes matching the given path pattern
      --except-path[=EXCEPT-PATH]  Do not display the routes matching the given path pattern
  -r, --reverse                    Reverse the ordering of the routes
      --sort[=SORT]                The column (domain, method, uri, name, action, middleware) to sort by [default: "uri"]
      --except-vendor              Do not display routes defined by vendor packages
      --only-vendor                Only display routes defined by vendor packages
  -h, --help                       Display help for the given command. When no command is given display help for the list command
  -q, --quiet                      Do not output any message
  -V, --version                    Display this application version
      --ansi|--no-ansi             Force (or disable --no-ansi) ANSI output
  -n, --no-interaction             Do not ask any interactive question
      --env[=ENV]                  The environment the command should run under
  -v|vv|vvv, --verbose             Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
#

# php artisan route:list --path=dashboard

  GET|HEAD       dashboard ..............................................................................................

# php artisan route:cache

   INFO  Routes cached successfully.
   => stored cache file in location-> /bootstrap/cache/routes-v7.php

php artisan route:clear
=> INFO  Route cache cleared successfully.

=========Controllers=======
ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail shell
sail@bf60c29a74fb:/var/www/html$ 

sail@bf60c29a74fb:/var/www/html$ php artisan make:controller ProcessTransactionController --invokable
INFO  Controller [app/Http/Controllers/ProcessTransactionController.php] created successfully.  
=> use this post request only

=========Middleware==========
ubuntu@DESKTOP-994R1LE:~/learnlaraveltherightway$ ./vendor/bin/sail shell
sail@bf60c29a74fb:/var/www/html$ 
sail@bf60c29a74fb:/var/www/html$ 
sail@bf60c29a74fb:/var/www/html$ 
sail@bf60c29a74fb:/var/www/html$ php artisan make:middleware AssignRequestId 

  INFO  Middleware [app/Http/Middleware/AssignRequestId.php] created successfully.  

=>//this area is for global middleware to assign

sail@bf60c29a74fb:/var/www/html$ php artisan make:middleware CheckUserRole

   INFO  Middleware [app/Http/Middleware/CheckUserRole.php] created successfully.  
=> //this area is for specific route middleware to assign
sail@bf60c29a74fb:/var/www/html$ 

