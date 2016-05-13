<?php

class User extends \Phalcon\Mvc\Model
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
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $regtime;

    /**
     *
     * @var integer
     */
    public $regip;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $baidu;

    /**
     *
     * @var string
     */
    public $qq;

    /**
     *
     * @var string
     */
    public $sina;

    /**
     *
     * @var string
     */
    public $github;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $auth_key;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("vip_user");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vip_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
