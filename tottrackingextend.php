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
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . 'tottrackingextend/vendor/autoload.php';

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use Tottrackingextend\Hook\HookDispatcher;
use TottrackingextendClasslib\Module\Module;

class Tottrackingextend extends Module implements WidgetInterface
{
    /** @var string Unique name */
    public $name = 'tottrackingextend';

    /** @var string Admin tab corresponding to the module */
    public $tab = 'analytics_stats';

    /** @var string Version */
    public $version = '1.0.0';

    /** @var string author of the module */
    public $author = '202 ecommerce';

    /** @var int need_instance */
    public $need_instance = 0;

    /** @var array filled with known compliant PS versions */
    public $ps_versions_compliancy = [
        'min' => '8.0.0',
        'max' => _PS_VERSION_,
    ];

    /** @var string This module requires at least PHP version */
    public $php_version_required = '8.1';

    /**
     * List of objectModel used in this Module
     *
     * @var array
     */
    public $objectModels = [];

    /**
     * List of controllers used in this Module
     *
     * @var array
     */
    public $controllers = [];

    /**
     * List of admin controllers used in this Module
     *
     * @var array
     */
    public $moduleAdminControllers = [];

    public $hooks = [];

    public $extensions = [
    ];

    /**
     * Constructor of module
     */
    public function __construct()
    {
        parent::__construct();
        $this->displayName = $this->trans('Tottrackingextend', [], 'Modules.Tottrackingextend.Shop');
        $this->description = $this->trans('Extension module for tottracking', [], 'Modules.Tottrackingextend.Shop');
        $this->hookDispatcher = new HookDispatcher($this);
        $this->hooks = array_merge($this->hooks, $this->hookDispatcher->getAvailableHooks());
    }
}
