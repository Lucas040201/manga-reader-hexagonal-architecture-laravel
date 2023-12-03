<?php

namespace App\Providers\MangaProviders\User\In;

use Core\Domain\Users\Ports\In\ConfirmAccountInputPort;
use Core\Domain\Users\Ports\In\InsertUserInputPort;
use Core\Domain\Users\UseCases\ConfirmAccountUseCase;
use Core\Domain\Users\UseCases\InsertUserUseCase;
use Illuminate\Support\ServiceProvider;

class UserInputAdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InsertUserInputPort::class, InsertUserUseCase::class);
        $this->app->bind(ConfirmAccountInputPort::class, ConfirmAccountUseCase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
