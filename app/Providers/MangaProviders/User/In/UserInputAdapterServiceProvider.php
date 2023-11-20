<?php

namespace App\Providers\MangaProviders\User\In;

use Core\Domain\Users\Ports\In\InsertUserInputPort;
use Core\Domain\Users\Ports\In\InsertUserVerificationEmailInputPort;
use Core\Domain\Users\UseCases\InsertUserUseCase;
use Core\Domain\Users\UseCases\InsertUserVerificationEmailUseCase;
use Illuminate\Support\ServiceProvider;

class UserInputAdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InsertUserInputPort::class, InsertUserUseCase::class);
        $this->app->bind(InsertUserVerificationEmailInputPort::class, InsertUserVerificationEmailUseCase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
