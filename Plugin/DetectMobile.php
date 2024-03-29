<?php


namespace Tenx\VarnishDetectMobile\Plugin;


use Magento\Framework\App\Http\Context;

class DetectMobile
{

    const USER_AGENT_CONTEXT_VARIABLE = 'USER_AGENT_CONTEXT_VARIABLE';

    const DEFAULT_VALUE = 'desktop';

    private function isMobile(){
        $regex_match = "/iPhone|iPod|BlackBerry|Palm|Googlebot-Mobile|Mobile|mobile|mobi|Windows Mobile|Safari Mobile|Android|Opera Mini/i";

        if (preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
        return false;

        /**
         * temp
         *     $userAgent = $this->httpHeader->getHttpUserAgent();
         *     return $this->mobileAgent->match($userAgent, $_SERVER);
         */
    }
    /**
     * @param Context  $subject
     *
     * @return void.
     */
    public function beforeGetVaryString(Context $subject)
    {

        if($this->isMobile()) {
            $subject->setValue(
                self::USER_AGENT_CONTEXT_VARIABLE, "mobile", self::DEFAULT_VALUE
            );
        }
        else{
            $subject->setValue(
                self::USER_AGENT_CONTEXT_VARIABLE, "pc", self::DEFAULT_VALUE
            );
        }

        return [];

    }
}
