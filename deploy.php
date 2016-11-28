<?php

require 'recipe/laravel.php';

localserver('local')
    ->stage('production')
    ->env('deploy_path', '/var/www/depot')
    ->env('branch', 'dev');

set('repository', 'git@git.agentum.org:gbu/storage.git');