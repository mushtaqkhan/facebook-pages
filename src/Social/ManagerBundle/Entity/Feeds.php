<?php

namespace Social\ManagerBundle\Entity;

/**
 * Feeds
 */
class Feeds
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
    private $name;

    /**
     * @var string
     */
    private $p_id;

    /**
     * @var string
     */
    private $type_page;

    /**
     * @var integer
     */
    private $feed_update_count;

    /**
     * @var string
     */
    private $type_feed;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $caption;

    /**
     * @var string
     */
    private $link_title;

    /**
     * @var string
     */
    private $link_url;

    /**
     * @var string
     */
    private $image_url;

    /**
     * @var integer
     */
    private $time_post;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var string
     */
    private $feed_id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;


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
     * @return Feeds
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
     * Set name
     *
     * @param string $name
     *
     * @return Feeds
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pId
     *
     * @param string $pId
     *
     * @return Feeds
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
     * Set typePage
     *
     * @param string $typePage
     *
     * @return Feeds
     */
    public function setTypePage($typePage)
    {
        $this->type_page = $typePage;

        return $this;
    }

    /**
     * Get typePage
     *
     * @return string
     */
    public function getTypePage()
    {
        return $this->type_page;
    }

    /**
     * Set feedUpdateCount
     *
     * @param integer $feedUpdateCount
     *
     * @return Feeds
     */
    public function setFeedUpdateCount($feedUpdateCount)
    {
        $this->feed_update_count = $feedUpdateCount;

        return $this;
    }

    /**
     * Get feedUpdateCount
     *
     * @return integer
     */
    public function getFeedUpdateCount()
    {
        return $this->feed_update_count;
    }

    /**
     * Set typeFeed
     *
     * @param string $typeFeed
     *
     * @return Feeds
     */
    public function setTypeFeed($typeFeed)
    {
        $this->type_feed = $typeFeed;

        return $this;
    }

    /**
     * Get typeFeed
     *
     * @return string
     */
    public function getTypeFeed()
    {
        return $this->type_feed;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Feeds
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Feeds
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set caption
     *
     * @param string $caption
     *
     * @return Feeds
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set linkTitle
     *
     * @param string $linkTitle
     *
     * @return Feeds
     */
    public function setLinkTitle($linkTitle)
    {
        $this->link_title = $linkTitle;

        return $this;
    }

    /**
     * Get linkTitle
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->link_title;
    }

    /**
     * Set linkUrl
     *
     * @param string $linkUrl
     *
     * @return Feeds
     */
    public function setLinkUrl($linkUrl)
    {
        $this->link_url = $linkUrl;

        return $this;
    }

    /**
     * Get linkUrl
     *
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->link_url;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Feeds
     */
    public function setImageUrl($imageUrl)
    {
        $this->image_url = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Set timePost
     *
     * @param integer $timePost
     *
     * @return Feeds
     */
    public function setTimePost($timePost)
    {
        $this->time_post = $timePost;

        return $this;
    }

    /**
     * Get timePost
     *
     * @return integer
     */
    public function getTimePost()
    {
        return $this->time_post;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Feeds
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set feedId
     *
     * @param string $feedId
     *
     * @return Feeds
     */
    public function setFeedId($feedId)
    {
        $this->feed_id = $feedId;

        return $this;
    }

    /**
     * Get feedId
     *
     * @return string
     */
    public function getFeedId()
    {
        return $this->feed_id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Feeds
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Feeds
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

