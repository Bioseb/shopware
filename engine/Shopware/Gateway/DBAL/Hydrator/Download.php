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

namespace Shopware\Gateway\DBAL\Hydrator;

use Shopware\Struct;

/**
 * @package Shopware\Gateway\DBAL\Hydrator
 */
class Download extends Hydrator
{
    /**
     * @var Attribute
     */
    private $attributeHydrator;

    function __construct(Attribute $attributeHydrator)
    {
        $this->attributeHydrator = $attributeHydrator;
    }

    /**
     * Creates a new Struct\Product\Download struct with the passed data.
     *
     * @param array $data
     * @return \Shopware\Struct\Product\Download
     */
    public function hydrate(array $data)
    {
        $download = new Struct\Product\Download();

        $download->setId((int) $data['__download_id']);

        $download->setDescription($data['__download_description']);

        $download->setFile($data['__download_filename']);

        $download->setSize((float) $data['__download_size']);

        if (!empty($data['__downloadAttribute_id'])) {
            $attribute = $this->extractFields('__downloadAttribute_', $data);
            $download->addAttribute('core', $this->attributeHydrator->hydrate($attribute));
        }

        return $download;
    }
}
