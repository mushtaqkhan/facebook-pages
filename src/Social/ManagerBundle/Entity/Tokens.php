<?php

namespace Social\ManagerBundle\Entity;

/**
 * Tokens
 */
class Tokens
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $u_id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $p_id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $token_facebook;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uId
     *
     * @param integer $uId
     *
     * @return Tokens
     */
    public function setUId($uId)
    {
        $this->u_id = $uId;

        return $this;
    }

    /**
     * Get uId
     *
     * @return integer
     */
    public function getUId()
    {
        return $this->u_id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tokens
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set pId
     *
     * @param string $pId
     *
     * @return Tokens
     */
    public function setPId($pId)
    {
        $this->p_id = $pId;

        return $this;
    }

    /**
     * Get pId
     *
     * @return string
     */
    public function getPId()
    {
        return $this->p_id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Tokens
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tokenFacebook
     *
     * @param string $tokenFacebook
     *
     * @return Tokens
     */
    public function setTokenFacebook($tokenFacebook)
    {
        $this->token_facebook = $tokenFacebook;

        return $this;
    }

    /**
     * Get tokenFacebook
     *
     * @return string
     */
    public function getTokenFacebook()
    {
        return $this->token_facebook;
    }
}

