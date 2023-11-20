<?php

namespace App\Providers\MangaProviders\User\Out;

use App\Adapters\Mail\User\SendVerificationEmailUserAdapter;
use App\Adapters\Repository\User\FindUserByEmailAdapter;
use App\Adapters\Repository\User\FindUserByUserNameAdapter;
use App\Adapters\Repository\User\InsertUserAdapter;
use App\Adapters\Repository\UserVerificationEmail\InsertUserVerificationEmailAdapter;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;
use Core\Domain\Users\Ports\Out\FindUserByUsernameOutputPort;
use Core\Domain\Users\Ports\Out\InsertUserOutputPort;
use Core\Domain\Users\Ports\Out\InsertUserVerificationEmailOutputPort;
use Core\Domain\Users\Ports\Out\SendVerificationEmailOutputPort;
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
        $this->app->bind(InsertUserVerificationEmailOutputPort::class, InsertUserVerificationEmailAdapter::class);
        $this->app->bind(SendVerificationEmailOutputPort::class, SendVerificationEmailUserAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
