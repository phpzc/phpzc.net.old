<?php

class Software extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $description_simple;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $develop_log;

    /**
     *
     * @var string
     */
    public $create_time;

    /**
     *
     * @var string
     */
    public $update_time;

    /**
     *
     * @var integer
     */
    public $isdel;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("vip_software");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vip_software';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Software[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Software
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
