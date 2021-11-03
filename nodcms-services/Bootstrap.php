<?php
/*
 * NodCMS
 *
 * Copyright (c) 2015-2021.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *  @author     Mojtaba Khodakhah
 *  @copyright  2015-2021 Mojtaba Khodakhah
 *  @license    https://opensource.org/licenses/MIT	MIT License
 *  @link       https://nodcms.com
 *  @since      Version 3.2.0
 *  @filesource
 *
 */

namespace NodCMS\Services;

use Config\Services;
use NodCMS\Services\Controllers\ServicesFrontend;

class Bootstrap extends \NodCMS\Core\Modules\Bootstrap
{
    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return "Services";
    }

    /**
     * @inheritDoc
     */
    public function description(): string
    {
        return "This is module to create and mange you services on your website.";
    }

    /**
     * @inheritDoc
     */
    public function hasDashboard(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function hasMemberDashboard(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function hasHomePreview(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     * @return string
     */
    public function getHomePreview(): string
    {
        return ServicesFrontend::home();
    }

    /**
     * @throws \Exception
     */
    function backend()
    {
        define('SERVICES_ADMIN_URL',base_url("admin-services").'/');
        if(Services::identity()->isAdmin(true)){
            Services::sidebar()->addLink(
                "services",
                _l("Services", $this),
                null,
                "fas fa-concierge-bell"
            );
            Services::sidebar()->addSubLink(
                'services',
                'services_list',
                _l("Services' list", $this),
                SERVICES_ADMIN_URL."services"
            );
            Services::sidebar()->addSubLink(
                'services',
                'services_settings',
                _l("Display settings", $this),
                SERVICES_ADMIN_URL."settings"
            );
        }
    }
}