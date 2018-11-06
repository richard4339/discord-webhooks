<?php

namespace Discord\Embed;

/**
 * Class Footer
 *
 * @author  Scrummer <scrummer@gmx.ch>
 * @package Discord\Embed
 */
class Footer extends AbstractEmbed
{
    /**
     * @param string $text
     *
     * @return Footer
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string $iconUrl
     *
     * @return Footer
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * @param string $proxyIconUrl
     *
     * @return Footer
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
            'text'           => $this->text,
            'icon_url'       => $this->iconUrl,
            'proxy_icon_url' => $this->proxyIconUrl
        ];
    }
}
