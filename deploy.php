<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:WiredPea/moneyz.git');

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

add('writable_dirs', ['bootstrap/cache', 'storage']);

// Servers

host('wiredpea.com')
    ->user('noe')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/moneyz');


// Tasks
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php7.0-fpm.service
    run('sudo systemctl restart php7.3-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'artisan:migrate');
