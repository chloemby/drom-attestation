<?php
namespace Deployer;

require 'recipe/composer.php';

// Project name
set('application', 'drom-attestation');

// Project repository
set('repository', 'https://github.com/chloemby/drom-attestation.git');

// Shared files/dirs between deploys 
add('shared_files', [
    '.env.local'
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
