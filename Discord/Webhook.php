<?php

namespace Discord;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Webhook
 *
 * @author Scrummer <scrummer@gmx.ch>
 * @package Discord
 */
class Webhook
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $embeds;

    /**
     * @var bool
     */
    private $tts;

    /**
     * @var array
     */
    private $file;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param bool $tts
     *
     * @return Webhook
     */
    public function setTts($tts = false)
    {
        $this->tts = $tts;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return Webhook
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return Webhook
     */
    public function setAvatar($url)
    {
        $this->avatar = $url;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return Webhook
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param Embed $embed
     *
     * @return Webhook
     */
    public function addEmbed($embed)
    {
        $this->embeds[] = $embed->__toArray();

        return $this;
    }

    /**
     * @param File $file
     *
     * @return Webhook
     */
    public function setFile($file)
    {
        $this->data['file'] = curl_file_create($file->getFile(), null, $file->getFileName());
        $this->file         = $this->data['file'];

        return $this;
    }

    /**
     * Send the Webhook
     *
     * @param bool|null $unsetFields
     *
     * @return $this
     *
     * @throws \Exception
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function send(?bool $unsetFields = false)
    {
        if(empty($this->url))
        {
            throw new \Exception('URL has not been defined.');
        }
        $this->message = 'Symfony';
        $payload = [];
        if (isset($this->username) == true) {
            $payload['username'] = $this->username;
        }
        if (isset($this->username) == true) {
            $payload['avatar_url'] = $this->avatar;
        }
        if (isset($this->message) == true) {
            $payload['content'] = $this->message;
        }
        if (isset($this->tts) == true) {
            $payload['tts'] = $this->tts;
        }
        if (isset($this->file) == true) {
            $payload['file'] = $this->file;
        } elseif (isset($this->embeds) == true) {
            $payload['embeds'] = $this->embeds;
        }

        $response = $this->getHttpClient()->request('POST', $this->url, [
            'query' => [
                'wait' => true,
            ],
            'json' => $payload
        ]);

        $status = $response->getStatusCode();

        switch ($status)
        {
            case 200:
            case 204:
                break;
            default:
                throw new \Exception($status . ':' . json_decode($response->getContent(false));
                break;
        }

        if ($unsetFields) {
            $this->unsetFields();
        }

        return $this;
    }

    /**
     *
     */
    private function unsetFields()
    {
        foreach (get_object_vars($this) as $index => $var) {
            switch($index)
            {
                case 'httpClient':
                    break;
                default:
                    unset($var);
                    break;
            }
        }
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        if(empty($this->httpClient))
        {
            return $this->createHttpClient();
        }
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return Webhook
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return HttpClientInterface
     */
    protected function createHttpClient()
    {
        $this->httpClient = HttpClient::create();
        return $this->httpClient;
    }


}
