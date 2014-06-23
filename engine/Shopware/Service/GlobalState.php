<?php
/**
 * Shopware 4
 * Copyright © shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Service;

use Shopware\Struct;


/**
 * @package Shopware\Service
 */
interface GlobalState
{
    /**
     * The \Shopware\Struct\Context requires the following data:
     * - Current shop
     * - Current language
     * - Current customer group
     * - Fallback customer group of the current shop
     * - Current country data (area, country, state)
     * - The currency of the shop
     * - Different tax rules for the current context
     *
     * Required conditions for the selection:
     * - Use the `shop` service of the di container for the language and current category
     * - Use the `session` service of the di container for the current user data.
     */
    public function initialize();

    /**
     * To get detailed information about the selection conditions, structure and content of the returned object,
     * please refer to the linked classes.
     *
     * @see \Shopware\Gateway\GlobaleState::initialize()
     *
     * @return Struct\Context
     */
    public function get();
}
