<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 3/30/17
 * Time: 1:52 AM
 */

namespace App\Mails;

use ArifMahmudRana\Context\ContextContainer;
use SimpleMail;

class FirstTimeJobPostEmailSend
{
    protected $id;
    protected $data;
    protected $subject = 'First time job post';

    /**
     * FirstTimeJobPostEmailSend constructor.
     * @param $id
     * @param $data
     */
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
        $this->mailConfigs = require_once __DIR__ . '/../../config/mail.php';
    }

    public function getPublishUrl()
    {
        return ContextContainer::get('baseUrl') . 'job/' . $this->id . '/publish';
    }

    public function getSpamUrl()
    {
        return ContextContainer::get('baseUrl') . 'job/' . $this->id . '/spam';
    }

    public function getVars()
    {
        return [
            'title' => $this->data['title'],
            'description' => $this->data['description'],
            'publishUrl' => $this->getPublishUrl(),
            'spamUrl' => $this->getSpamUrl(),
        ];
    }

    public function getTemplate()
    {
        ob_start();
        extract($this->getVars());
        include __DIR__ . '/../../views/email-templates/first-time-job-post-template.php';
        return ltrim(ob_get_clean());
    }

    public function send()
    {
        extract($this->mailConfigs);
        return SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setFrom($fromEmail, $fromName)
            ->setSubject($this->subject)
            ->setMessage($this->getTemplate())
            ->setHtml()
            ->setWrap(100)
            ->send();
    }
}