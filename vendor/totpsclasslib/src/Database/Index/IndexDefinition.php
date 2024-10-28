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

namespace TottrackingextendClasslib\Database\Index;

use TottrackingextendClasslib\Database\Index\IndexField;
use TottrackingextendClasslib\Database\Index\IndexType;

class IndexDefinition
{
    /**
     * @var array<IndexField>
     */
    private $fields = [];

    private $type = IndexType::STANDARD;

    private $name;

    private $options = '';

    private $table;

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     *
     * @return IndexDefinition
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return IndexDefinition
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return IndexDefinition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $options
     *
     * @return IndexDefinition
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     *
     * @return IndexDefinition
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function getIndex()
    {
        if (empty($this->getFields()) || empty($this->getTable())) {
            return null;
        }

        $type = $this->getType();
        $columns = implode(', ', array_map(function ($field) {
            return $field->getColumn();
        }, $this->getFields()));
        $name = $this->getName();
        if (empty($name)) {
            $name = 'ix_' . preg_replace('/[^A-Za-z0-9\-_]/', '', $columns);
        }
        $name = substr($name, 0, 64);
        $options = $this->getOptions();
        $table = $this->getTable();

        return "CREATE $type INDEX $name ON $table ($columns) $options";
    }

    public static function build($index, $table)
    {
        $indexObj = new IndexDefinition();
        $indexObj->setTable($table);

        if (!empty($index['type'])) {
            $indexObj->setType($index['type']);
        }

        if (!empty($index['name'])) {
            $indexObj->setName($index['name']);
        }

        if (!empty($index['options'])) {
            $indexObj->setOptions($index['options']);
        }

        if (!empty($index['fields'])) {
            $fields = [];
            foreach ($index['fields'] as $field) {
                $fields[] = (new IndexField())->setColumn($field['column']);
            }
            $indexObj->setFields($fields);
        }

        return $indexObj;
    }
}
