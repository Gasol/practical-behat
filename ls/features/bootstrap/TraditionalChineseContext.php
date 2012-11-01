<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class TraditionalChineseContext extends BehatContext
{
    private $mainContext;

    public function __construct(FeatureContext $context)
    {
        $this->mainContext = $context;
    }

    /**
     * @Given /^我目前在"([^"]*)"目錄中$/
     */
    public function 我目前在目錄中($dir)
    {
        $this->mainContext->iAmInADirectory($dir);
    }

    /**
     * @Given /^我有一個檔案叫"([^"]*)"$/
     */
    public function 我有一個檔案叫($file)
    {
        $this->mainContext->iHaveAFileNamed($file);
    }

    /**
     * @Given /^我有另一個檔案叫"([^"]*)"$/
     */
    public function 我有另一個檔案叫($file)
    {
        $this->我有一個檔案叫($file);
    }

    /**
     * @Given /^我執行"([^"]*)"$/
     */
    public function 我執行($command)
    {
        $this->mainContext->iRun($command);
    }

    /**
     * @Given /^我應該得到$/
     */
    public function 我應該得到(PyStringNode $string)
    {
        $this->mainContext->iShouldGet($string);
    }
}

