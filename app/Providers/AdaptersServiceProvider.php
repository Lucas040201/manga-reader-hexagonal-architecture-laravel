<?php

namespace App\Providers;

use App\Adapters\Repository\User\FindUserByEmailAdapter;
use App\Adapters\Repository\User\FindUserByUserNameAdapter;
use App\Adapters\Repository\User\InsertUserAdapter;
use Core\Domain\Users\Ports\In\InsertUserInputPort;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;
use Core\Domain\Users\Ports\Out\FindUserByUsernameOutputPort;
use Core\Domain\Users\Ports\Out\InsertUserOutputPort;
use Core\Domain\Users\UseCases\InsertUserUseCase;
use Illuminate\Support\ServiceProvider;

class AdaptersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InsertUserInputPort::class, InsertUserUseCase::class);
        $this->app->bind(InsertUserOutputPort::class, InsertUserAdapter::class);
        $this->app->bind(FindUserByEmailOutputPort::class, FindUserByEmailAdapter::class);
        $this->app->bind(FindUserByUsernameOutputPort::class, FindUserByUserNameAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
