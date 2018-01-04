<?php


namespace HustleWorks\Chute;


abstract class ServiceResponse
{
    /**
     * @var bool
     */
    private $success;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $message;

    /**
     * ServiceResponse constructor.
     *
     * @param bool   $success
     * @param array  $data
     * @param string $message
     */
    public function __construct($success = null, array $data = [], $message = null)
    {
        $this->success = $success;
        $this->data    = $data;
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }


}