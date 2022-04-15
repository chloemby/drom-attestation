<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'https://github.com/chloemby/drom-attestation.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', [
    '.env.local'
]);

// Writable dirs by web server 
add('writable_dirs', [
    'var',
    'var/cache',
    'var/log',
    'var/sessions',
]);


// Hosts

host('195.133.145.63')
    ->set('deploy_path', '/var/www/drom-attestation')
    ->user('deployer');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
