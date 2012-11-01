<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\Behat\Exception\BehaviorException;
use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext
{
    public function __construct(array $parameters)
    {
    }

    /**
     * @AfterStep @javascript
     */
    public function afterAttachFile($event)
    {
        $text = $event->getStep()->getText();
        if (preg_match('/attach/i', $text)) {
            $condition =<<<JS
(function($, undefined) {
    return $('div.drop-success').css('display') != 'none';
})(jQuery);
JS;

            $session = $this->getSession();
            $this->getSession()
                 ->wait(5000, $condition);
        }
    }
}
