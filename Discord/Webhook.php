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
     * @var HttpClientInterface
     */
    protected $httpClient;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string|null
     */
    private $username;
    /**
     * @var string|null
     */
    private $avatar;
    /**
     * @var string|null
     */
    private $message;
    /**
     * @var Embed[]|null
     */
    private $embeds;
    /**
     * @var bool
     */
    private $tts = false;

    /**
     * @param bool $tts
     *
     * @return Webhook
     */
    public function setTts(?bool $tts = false)
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
        if (empty($this->url)) {
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
        if (isset($this->embeds) == true) {
            $payload['embeds'] = $this->embeds;
        }

        $response = $this->getHttpClient()->request('POST', $this->url, [
            'query' => [
                'wait' => true,
            ],
            'json' => $payload
        ]);

        $status = $response->getStatusCode();

        switch ($status) {
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
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        if (empty($this->httpClient)) {
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

    /**
     *
     */
    private function unsetFields()
    {
        foreach (get_object_vars($this) as $index => $var) {
            switch ($index) {
                case 'httpClient':
                    break;
                default:
                    unset($var);
                    break;
            }
        }
    }

    /**
     * @param string $url
     *
     * @return Webhook
     */
    public function setUrl(string $url): Webhook
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string|null $avatar
     *
     * @return Webhook
     */
    public function setAvatar(?string $avatar): Webhook
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @param string|null $message
     *
     * @return Webhook
     */
    public function setMessage(?string $message): Webhook
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param Embed[]|null $embeds
     *
     * @return Webhook
     */
    public function setEmbeds(?array $embeds): Webhook
    {
        $this->embeds = $embeds;
        return $this;
    }


}
