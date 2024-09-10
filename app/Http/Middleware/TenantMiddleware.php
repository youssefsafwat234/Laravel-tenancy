<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();    // like a.localhost
        $tenant = collect(\DB::connection('mysql')->select("SELECT * from stores WHERE  domain = \"$domain\"")[0]);   // Select * from stores where domain = a.localhost


        if (!$tenant) {    // if tenant not found like the main tenant (localhost)
            return $next($request);
        }

        $options = collect(json_decode($tenant->get('database_options'), true));
        $connections = config('database.connections');
        $newConnection = [$tenant->get('domain') => [
            "driver" => "mysql",
            "url" => null,
            "host" => "127.0.0.1",
            "port" => "3306",
            "database" => $options->get('database'),
            "username" => "root",
            "password" => "12345678",
            "unix_socket" => "",
            "charset" => "utf8mb4",
            "collation" => "utf8mb4_unicode_ci",
            "prefix" => "",
            "prefix_indexes" => true,
            "strict" => true,
            "engine" => null,
            "options" => [],
        ]];
        $connections = array_merge($connections, $newConnection);
        \DB::statement('CREATE DATABASE IF NOT EXISTS ' . $options->get('database'));
        config(['database.connections' => $connections]);
        \Config::set('database.default', $tenant->get('domain'));

        \Artisan::call('migrate', [
            '--database' => $tenant->get('domain'),
            '--path' => 'database/migrations/tenants'
        ]);
        \Artisan::call('db:seed', [
            '--database' => $tenant->get('domain'),
        ]);


        $database = $options->get('database');

//        dd(app()->make('db')->reconnect($options->get('database')));

        return $next($request);
    }
}
