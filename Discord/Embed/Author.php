<?php

namespace Discord\Embed;

/**
 * Class Author
 *
 * @author  Scrummer <scrummer@gmx.ch>
 * @package Discord\Embed
 */
class Author extends AbstractEmbed
{
    /**
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return Author
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $iconUrl
     *
     * @return Author
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * @param string $proxyIconUrl
     *
     * @return Author
     */
    public function setProxyIconUrl($proxyIconUrl)
    {
        $this->proxyIconUrl = $proxyIconUrl;

        return $this;
    }

    /**
     * Converts the embed object to an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name'           => $this->name,
            'url'            => $this->url,
            'icon_url'       => $this->iconUrl,
            'proxy_icon_url' => $this->proxyIconUrl
        ];
    }
}
