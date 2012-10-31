<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\Behat\Exception\BehaviorException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->useContext('traditional_chinese', new TraditionalChineseContext($this));
    }

    /**
     * @AfterScenario
     */
    public function removeDir()
    {
        if (is_dir($this->dir)) {
            $this->removeDirRecursively($this->dir);
        }
    }

    /**
     * @Given /^I am in a directory "([^"]*)"$/
     */
    public function iAmInADirectory($dir)
    {
        $tmpFile = tempnam(sys_get_temp_dir(), '.placeholder');
        $tmpDir = dirname($tmpFile) . "/$dir";
        $this->dir = $tmpDir;

        if (!file_exists($tmpDir)) {
            mkdir($tmpDir);
        }

        chdir($tmpDir);
    }

    /**
     * @Given /^I have a file named "([^"]*)"$/
     */
    public function iHaveAFileNamed($file)
    {
        touch($this->dir . "/$file");
    }

    /**
     * @When /^I run "([^"]*)"$/
     */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet(PyStringNode $string)
    {
        if (strval($string) !== $this->output) {
            throw new Exception("Actual output is:\n". $this->output);
        }
    }

    private function removeDirRecursively($dir) {
        $files = scandir($dir);

        foreach ($files as $file) {
            if ('.' == $file || '..' == $file) {
                continue;
            }

            if (is_dir($file)) {
                $this->rmdir($dir);
            } else if (is_file($file)) {
                unlink($file);
            }
        }

        rmdir($dir);
    }
}

