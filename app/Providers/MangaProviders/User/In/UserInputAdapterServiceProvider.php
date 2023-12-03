<?php

namespace App\Providers\MangaProviders\User\In;

use Core\Domain\Users\Ports\In\ConfirmAccountInputPort;
use Core\Domain\Users\Ports\In\CreatePasswordRecoveryInputPort;
use Core\Domain\Users\Ports\In\CreateUserInputPort;
use Core\Domain\Users\UseCases\ConfirmAccountUseCase;
use Core\Domain\Users\UseCases\CreatePasswordRecoveryUseCase;
use Core\Domain\Users\UseCases\CreateUserUseCase;
use Illuminate\Support\ServiceProvider;

class UserInputAdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CreateUserInputPort::class, CreateUserUseCase::class);
        $this->app->bind(ConfirmAccountInputPort::class, ConfirmAccountUseCase::class);
        $this->app->bind(CreatePasswordRecoveryInputPort::class, CreatePasswordRecoveryUseCase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
