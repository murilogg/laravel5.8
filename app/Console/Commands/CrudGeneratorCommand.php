<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGeneratorCommand extends Command
{
    
    protected $signature = 'crud:generator {name : Class (singular), e.g User}';


    protected $description = 'Create CRUD operations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //
    }

    protected function getStub($type) 
    {
        return file_get_contents(resources_path("stubs/$type.stub"));
    }

    protected function model($name) 
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $template);
    }

    protected function request($name) 
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        if(!fileExists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $template);
    }
}
