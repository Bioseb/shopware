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

use Shopware\Service\Core\Context;
use Shopware\Struct;


/**
 * @package Shopware\Service
 */
interface Media
{
    /**
     * @see \Shopware\Service\Media::getProductMedia()
     *
     * @param Struct\ListProduct[] $products
     * @param Context $context
     * @return array Indexed by the product order number, each array element contains a \Shopware\Struct\Media array.
     */
    public function getProductsMedia(array $products, Context $context);

    /**
     * If the forceArticleMainImageInListing configuration is activated,
     * the function try to selects the first product media which has a configurator configuration
     * for the provided product.
     *
     * If no configurator image exist, the function returns the fallback main image of the product.
     *
     * To get detailed information about the selection conditions, structure and content of the returned object,
     * please refer to the linked classes.
     *
     * @see \Shopware\Gateway\VariantMedia::getCover()
     * @see \Shopware\Gateway\ProductMedia::getCover()
     *
     * @param Struct\ListProduct $product
     * @param Struct\Context $context
     * @return Struct\Media
     */
    public function getCover(Struct\ListProduct $product, Struct\Context $context);

    /**
     * @see \Shopware\Service\Media::getCover()
     *
     * @param Struct\ListProduct[] $products
     * @param \Shopware\Struct\Context $context
     * @return Struct\Media[] Indexed by product number
     */
    public function getCovers(array $products, Struct\Context $context);

    /**
     * Selects first the media structs which have a configurator configuration for the provided product variant.
     * The normal product media structs which has no configuration, are appended to the configurator media structs.
     *
     * To get detailed information about the selection conditions, structure and content of the returned object,
     * please refer to the linked classes.
     *
     * @see \Shopware\Gateway\ProductMedia::get()
     * @see \Shopware\Gateway\VariantMedia::get()
     *
     * @param Struct\ListProduct $product
     * @param Struct\Context $context
     * @return Struct\Media[]
     */
    public function getProductMedia(Struct\ListProduct $product, Struct\Context $context);
}
