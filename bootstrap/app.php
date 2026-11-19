<?php

use Illuminate\Foundation\Application;

// Use this project folder as the application base path.
return Application::configure(basePath: dirname(__DIR__))
    // Load the web and console route files.
    ->withRouting(web: __DIR__.'/../routes/web.php', commands: __DIR__.'/../routes/console.php')
    // Keep Laravel's default sessions, CSRF checks, and route binding.
    ->withMiddleware()
    // Register Laravel's standard exception handler.
    ->withExceptions()
    ->create();
