<?php

class Profile extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $foreign_name;

    /**
     *
     * @var integer
     */
    public $begin_time;

    /**
     *
     * @var integer
     */
    public $qq;

    /**
     *
     * @var string
     */
    public $mail;

    /**
     *
     * @var string
     */
    public $github;

    /**
     *
     * @var string
     */
    public $avator_url;

    /**
     *
     * @var string
     */
    public $weibo;

    /**
     *
     * @var string
     */
    public $description;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("vip_profile");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vip_profile';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Profile[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Profile
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
