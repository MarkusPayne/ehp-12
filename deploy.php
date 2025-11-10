<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

// Config

set('repository', 'git@github.com:MarkusPayne/ehp-12.git');
set('http_user', 'www-data');
set('keep_releases', 2);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('ehp-12.hexcode.ca')
    ->set('remote_user', 'mark')
    ->set('branch', 'main')
    ->set('deploy_path', '~/www/ehp-12');

task(
    'deploy',
    [
        'deploy:prepare',
        'deploy:vendors',
        'artisan:storage:link',
        'artisan:view:clear',
        'artisan:cache:clear',
        'artisan:config:clear',
        'artisan:view:cache',
        'artisan:migrate',
        'npm:install',
        //   'npm:puppeteer',
        'npm:run:prod',
        'deploy:publish',
        //        'artisan:queue:restart',
        // 'artisan:horizon:terminate',
        // 'php-fpm:reload',
    ]
);

task(
    'npm:run:prod',
    function () {
        cd('{{release_or_current_path}}');
        run('npm run build');
    }
);

task(
    'npm:puppeteer',
    function () {
        cd('{{release_or_current_path}}');
        run('npx puppeteer browsers install chrome');
        run('npx puppeteer browsers install chrome-headless-shell');
    }
);

// Hooks

after('deploy:failed', 'deploy:unlock');
