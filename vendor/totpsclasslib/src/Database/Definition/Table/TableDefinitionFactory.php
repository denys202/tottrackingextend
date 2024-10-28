<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from SARL 202 ecommerce
 * Use, copy, modification or distribution of this source file without written
 * license agreement from the SARL 202 ecommerce is strictly forbidden.
 * In order to obtain a license, please contact us: tech@202-ecommerce.com
 * ...........................................................................
 * INFORMATION SUR LA LICENCE D'UTILISATION
 *
 * L'utilisation de ce fichier source est soumise a une licence commerciale
 * concedee par la societe 202 ecommerce
 * Toute utilisation, reproduction, modification ou distribution du present
 * fichier source sans contrat de licence ecrit de la part de la SARL 202 ecommerce est
 * expressement interdite.
 * Pour obtenir une licence, veuillez contacter 202-ecommerce <tech@202-ecommerce.com>
 * ...........................................................................
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   Commercial license
 */

namespace TottrackingextendClasslib\Database\Definition\Table;

use TottrackingextendClasslib\Database\Definition\ObjectModel\ObjectModelDefinition;
use TottrackingextendClasslib\Database\Definition\Table\AbstractTableDefinitionBuilder;
use TottrackingextendClasslib\Database\Definition\Table\LangTableDefinitionBuilder;
use TottrackingextendClasslib\Database\Definition\Table\MainTableDefinitionBuilder;
use TottrackingextendClasslib\Database\Definition\Table\ShopTableDefinitionBuilder;
use PrestaShopException;

class TableDefinitionFactory
{
    /**
     * @var ObjectModelDefinition
     */
    protected $objectModelDefinition;

    /**
     * @param ObjectModelDefinition $objectModelDefinition
     */
    public function __construct(ObjectModelDefinition $objectModelDefinition)
    {
        $this->objectModelDefinition = $objectModelDefinition;
    }

    /**
     * @param string $type
     *
     * @return AbstractTableDefinitionBuilder
     *
     * @throws PrestaShopException
     */
    public function getTableDefinitionBuilder($type)
    {
        switch ($type) {
            case TableType::MAIN:
                return new MainTableDefinitionBuilder($this->objectModelDefinition);
            case TableType::LANG:
                return new LangTableDefinitionBuilder($this->objectModelDefinition);
            case TableType::SHOP:
                return new ShopTableDefinitionBuilder($this->objectModelDefinition);
            default:
                throw new PrestaShopException('Table builder not found');
        }
    }
}
