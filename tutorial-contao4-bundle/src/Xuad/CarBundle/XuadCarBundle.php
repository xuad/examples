<?php

namespace Xuad\CarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Xuad\CarBundle\DependencyInjection\CarBundleExtension;

class XuadCarBundle extends Bundle
{
    /**
     * Register extension
     * @return \Xuad\CarBundle\DependencyInjection\CarBundleExtension
     */
    public function getContainerExtension()
    {
        return new CarBundleExtension();
    }
}