<?php

namespace App\Providers\SNS\Wechat;

use SocialiteProviders\Manager\SocialiteWasCalled;

class WechatExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'weixin', __NAMESPACE__.'\Provider'
        );
    }
}
