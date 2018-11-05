<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Code\Validator\Cnpj;
use Code\Validator\Cpf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $plataform = \Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $plataform->registerDoctrineTypeMapping('enum','string');

        \Validator::extend('document_number', function($attribute, $value, $parameters, $validator){
            $document_validator = $parameters[0] == 'cpf' ? new Cpf() : new Cnpj();
            return $document_validator->isValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
