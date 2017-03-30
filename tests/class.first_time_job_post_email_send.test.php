<?php

use App\Mails\FirstTimeJobPostEmailSend;

class testFirstTimeJobPostEmailSend extends PHPUnit_Framework_TestCase
{
    /*
     * @var FirstTimeJobPostEmailSend
     */
    protected $mailer;

    /**
     * Set up the SimpleMail class before each test.
     */
    public function setUp()
    {
        $this->mailer = new FirstTimeJobPostEmailSend(
            1,
            [
                'title' => 'Simple title',
                'description' => 'Simple description',
            ]
        );
    }

    /**
     * @test
     */
    public function get_publish_url_will_contain_job_id_publish()
    {
        $this->assertContains('job/1/publish', $this->mailer->getPublishUrl());
    }

    /**
     * @test
     */
    public function get_spam_url_will_contain_job_id_spam()
    {
        $this->assertContains('job/1/spam', $this->mailer->getSpamUrl());
    }
}
