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

namespace TottrackingextendClasslib\Database\Action;

use TottrackingextendClasslib\Database\Action\Table\TableActionFactory;
use TottrackingextendClasslib\Database\Action\Table\TableActionType;
use TottrackingextendClasslib\Database\Definition\ObjectModel\ObjectModelDefinition;
use TottrackingextendClasslib\Database\Definition\Schema\SchemaDefinition;
use TottrackingextendClasslib\Database\Definition\Table\TableDefinition;
use TottrackingextendClasslib\Database\Repository\ActionRepository;
use TottrackingextendClasslib\Registry;

class InstallAction implements ActionInterface
{
    /**
     * @var ActionRepository
     */
    protected $actionRepository;

    /**
     * @var TableActionFactory
     */
    protected $tableActionFactory;

    public function __construct()
    {
        $this->actionRepository = new ActionRepository();
        $this->tableActionFactory = new TableActionFactory();
    }

    /**
     * @param ObjectModelDefinition $objectModelDefinition
     *
     * @return bool
     *
     * @throws \PrestaShopException
     */
    public function performAction(ObjectModelDefinition $objectModelDefinition)
    {
        $schemaDefinition = new SchemaDefinition($objectModelDefinition);
        $schemaDefinition->buildTableDefinitions();

        $tableDefinitions = $schemaDefinition->getTableDefinitions();
        foreach ($tableDefinitions as $tableDefinition) {
            if (!$this->actionRepository->isTableExist($tableDefinition->getName())) {
                $this->tableActionFactory->getTableAction(TableActionType::CREATE)->handle($tableDefinition);
            }
            $this->tableActionFactory->getTableAction(TableActionType::UPDATE)->handle($tableDefinition);
            $this->addTableToRegistry($tableDefinition);
        }

        return true;
    }

    protected function addTableToRegistry(TableDefinition $tableDefinition)
    {
        $tables = Registry::get('tables');
        if (empty($tables)) {
            $tables = [];
        }

        Registry::set('tables', array_merge($tables, [$tableDefinition]));
    }
}
