<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 3/28/17
 * Time: 11:57 AM
 */

namespace App\Models;

use PubSub;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fields = [
        'email',
        'title',
        'description',
        'status',
    ];
    const PUBLISHED = 'PUBLISHED';
    const PUBLISHED_STATUS_VALUE = 1;
    const SPAM = 'SPAM';
    const SPAM_STATUS_VALUE = 2;
    const UNPUBLISHED = 'UNPUBLISHED';
    const UNPUBLISHED_STATUS_VALUE = 0;
    protected $new;

    public function validate()
    {
        if (
            empty($this->data['email'])
            || filter_var($this->data['email'], FILTER_VALIDATE_EMAIL) === false
        )
        {
            $this->messages['email'] = 'Invalid Email!';
        }

        if (empty($this->data['title']))
        {
            $this->messages['title'] = 'Title is required!';
        }

        return $this;
    }

    public function filter()
    {
        if (isset($this->data['email']))
            $this->data['email'] = mb_substr(trim($this->data['email']), 0, 255, 'UTF-8');

        if (isset($this->data['title']))
            $this->data['title'] = mb_substr(trim($this->data['title']), 0, 255, 'UTF-8');

        return $this;
    }

    public function postedPreviousJobWithEmail($email)
    {
        $this->new = !(bool) $this->db
            ->from($this->table)
            ->where(['email' => $email])
            ->count();

        return $this;
    }

    public function process()
    {
        $this->postedPreviousJobWithEmail($this->data['email']);
        $this->data['status'] = (int) !$this->new;

        return $this;
    }

    public function fire()
    {
        if ($this->new)
        {
            PubSub::publish( 'first-time-job-post', $this->id, $this->data );
        }

        return $this;
    }

    public function save()
    {
        $this->process();
        $this->insert();
        $this->id = $this->db->insert_id;
        $this->fire();
        return true;
    }

    public function insert()
    {
        return $this->db->from($this->table)
            ->insert($this->getData())
            ->execute();
    }

    public function spam()
    {
        return $this->db->from($this->table)
            ->where(['id' => $this->id])
            ->update(['status' => self::SPAM_STATUS_VALUE])
            ->execute();
    }

    public function publish()
    {
        return $this->db->from($this->table)
            ->where(['id' => $this->id])
            ->update(['status' => self::PUBLISHED_STATUS_VALUE])
            ->execute();
    }
}