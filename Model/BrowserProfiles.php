<?php
/**
 * Created by IntelliJ IDEA.
 * User: trant
 * Date: 24/05/2015
 * Time: 9:12 PM
 */
namespace t49tran\BrowserProfilerBundle\Model;

class BrowserProfiles {

    protected $user_agent;
    protected $is_mobile;
    protected $is_tablet;
    protected $is_desktop;
    protected $is_spider;

    /**
     * Set user_agent
     *
     * @param string $userAgent
     * @return BrowserProfiles
     */
    public function setUserAgent($userAgent)
    {
        $this->user_agent = $userAgent;

        return $this;
    }

    /**
     * Get user_agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }


    /**
     * Set is_mobile
     *
     * @param boolean $isMobile
     * @return BrowserProfiles
     */
    public function setIsMobile($isMobile)
    {
        $this->is_mobile = $isMobile;

        return $this;
    }

    /**
     * Get is_mobile
     *
     * @return boolean
     */
    public function getIsMobile()
    {
        return $this->is_mobile;
    }

    /**
     * Set is_table
     *
     * @param boolean $isTable
     * @return BrowserProfiles
     */
    public function setIsTablet($isTable)
    {
        $this->is_table = $isTable;

        return $this;
    }

    /**
     * Get is_table
     *
     * @return boolean
     */
    public function getIsTablet()
    {
        return $this->is_table;
    }

    /**
     * Set is_desktop
     *
     * @param boolean $isDesktop
     * @return BrowserProfiles
     */
    public function setIsDesktop($isDesktop)
    {
        $this->is_desktop = $isDesktop;

        return $this;
    }

    /**
     * Get is_desktop
     *
     * @return boolean
     */
    public function getIsDesktop()
    {
        return $this->is_desktop;
    }

    /**
     * Set is_spider
     *
     * @param boolean $isSpider
     * @return BrowserProfiles
     */
    public function setIsSpider($isSpider)
    {
        $this->is_spider = $isSpider;

        return $this;
    }

    /**
     * Get is_spider
     *
     * @return boolean
     */
    public function getIsSpider()
    {
        return $this->is_spider;
    }

    public function initialize($user_agent){
        $this->user_agent = $user_agent;
        $this->is_tablet = false;
        $this->is_desktop = false;
        $this->is_mobile = false;
        $this->is_spider = false;
    }
}
