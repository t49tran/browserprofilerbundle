<?php
/**
 * Created by IntelliJ IDEA.
 * User: trant
 * Date: 30/05/2015
 * Time: 3:51 PM
 */
namespace t49tran\BrowserProfilerBundle\Profiler;

use Unirest;
use t49tran\BrowserProfilerBundle\Model\BrowserProfiles;
/**
 * Class LeadManager
 * @package Nkahnt\DigitalQuotesBundle\Services
 */
class BrowserProfiler {

    private $api_end_point;

    private $browser_profiles;

    public function __construct($api_end_point){
        $this->api_end_point = $api_end_point;
        $this->browser_profiles = new BrowserProfiles();
    }

    public function profiling(){

        $user_agent = $this->profileUserAgent();

        $user_info = $this->userAgentQuery($user_agent);
        /**
         * By default, set all is* to false
         */
        $this->browser_profiles->initialize($user_agent);

        if($this->profileIsSpider($user_info)){
            /**
             * Always check for spider/crawler first
            **/
            $this->browser_profiles->setIsSpider(true);
        }else if($this->profileIsMobile($user_agent)){
            /**
             * Then go for mobile
             */
            $this->browser_profiles->setIsMobile(true);
        }else if($this->profileIsTablet($user_agent)){
            /**
             * Then go for tablet
             */
            $this->browser_profiles->setIsTablet($user_info);
        }else{
            /**
             * Otherwise, browser profile is desktop
             */
            $this->browser_profiles->setIsDesktop(true);
        }


        return $this->browser_profiles;
    }



    public function profileUserAgent(){
        return $_SERVER['HTTP_USER_AGENT'];
    }


    public function profileIsMobile($user_agent){
        /**
         * If user_agent contains Mobile
        */
        if(preg_match("/mobile\b/i", $user_agent))
            return true;

        return false;
    }

    public function profileIsTablet($user_agent){
        /**
         * If user_agent contains Android, but doesnt contain Mobile
         */
        if(!preg_match("/mobile\b/i",$user_agent) && preg_match("/Android\b/i",$user_agent))
            return true;
        /**
         * If user_agent contains Ipad
         */
        if(preg_match("/ipad\b/i",$user_agent))
            return true;
        /**
         * If user_agent contains Touch, but doesnt contains Mobile
         * They may be a latop with touchscreen
         * But who know
         */
        if(!preg_match("/mobile\b/i",$user_agent) && preg_match("/touch\b/i",$user_agent))
            return true;

        return false;
    }

    public function profileIsDesktop($user_agent){
        /**
         * We presumable consider a non-mobile, non-tablet, non-spider UA as a desktop browser
         */
        if(!$this->profileIsMobile($user_agent) && !$this->profileIsTablet($user_agent) && !$this->profileIsSpisder($user_info) && $user_info->browser_type=="Browser")
            return true;

        return false;
    }

    public function profileIsSpider($user_info){
        /**
         * Browser type: Crawler returned from the API
         */
        if($user_info->agent_type=="Crawler")
            return true;

        return false;
    }

    /**
     * Query the UserAgent API for UA information
     * Used mostly to detect crawler
     * @param $user_agent
     * @return mixed
     */
    public function userAgentQuery($user_agent){
        $request = new Unirest\Request();

        $request->verifyPeer(false);

        $response = $request->get($this->api_end_point,
            array(
            ),
            array(
                "getJSON" => "all",
                "uas" => $user_agent
            )
        );

        return $response->body;
    }

    /**
     * @return BrowserProfiles
     */
    public function getBrowserProfiles(){
        return $this->browser_profiles;
    }

    /**
     * This function for someone want to hook in the service and do something with the object
     * @param $browser_profiles
     */
    public function setBrowserProfiles($browser_profiles){
        $this->browser_profiles = $browser_profiles;
    }
}