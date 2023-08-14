<?php

namespace Rewardful\RewardfulSpark;

use Illuminate\Support\Facades\Blade;
use Spark\Spark;
use App\Providers\SparkServiceProvider as ServiceProvider;
use Laravel\Spark\Contracts\Interactions\Settings\PaymentMethod\UpdatePaymentMethod;
use Rewardful\RewardfulSpark\UpdateStripePaymentMethod;

class RewardfulServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/rewardful.php' => config_path('rewardful.php'),
        ], 'rewardful-config');

        $this->publishes([
            __DIR__ . '/resources/js' => resource_path('js/rewardful'),
        ], 'rewardful-vue');

        Blade::directive('rewardful_js', function () {
            return "<script>(function(w,r){w._rwq=r;w[r]=w[r]||function(){(w[r].q=w[r].q||[]).push(arguments)}})(window,'rewardful');</script>
            <script async src='https://r.wdfl.co/rw.js' data-rewardful='b03639'></script>";
        });
    }
}
