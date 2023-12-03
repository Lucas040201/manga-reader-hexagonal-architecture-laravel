<?php

namespace App\Providers\MangaProviders\User\Out;

use App\Adapters\Queue\User\SendAccountVerificationEmailAdapter;
use App\Adapters\Repository\User\FindUserByEmailAdapter;
use App\Adapters\Repository\User\FindUserByTokenAdapter;
use App\Adapters\Repository\User\FindUserByUserNameAdapter;
use App\Adapters\Repository\User\InsertUserAdapter;
use App\Adapters\Repository\User\UpdateUserAdapter;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;
use Core\Domain\Users\Ports\Out\FindUserByTokenOutputPort;
use Core\Domain\Users\Ports\Out\FindUserByUsernameOutputPort;
use Core\Domain\Users\Ports\Out\InsertUserOutputPort;
use Core\Domain\Users\Ports\Out\SendVerificationEmailOutputPort;
use Core\Domain\Users\Ports\Out\UpdateUserOutputPort;
use Illuminate\Support\ServiceProvider;

class UserOutputAdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InsertUserOutputPort::class, InsertUserAdapter::class);
        $this->app->bind(FindUserByEmailOutputPort::class, FindUserByEmailAdapter::class);
        $this->app->bind(FindUserByUsernameOutputPort::class, FindUserByUserNameAdapter::class);
        $this->app->bind(SendVerificationEmailOutputPort::class, SendAccountVerificationEmailAdapter::class);
        $this->app->bind(FindUserByTokenOutputPort::class, FindUserByTokenAdapter::class);
        $this->app->bind(UpdateUserOutputPort::class, UpdateUserAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
