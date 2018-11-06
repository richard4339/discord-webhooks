<?php

namespace Discord\Embed;

/**
 * Class Provider
 *
 * @author  Scrummer <scrummer@gmx.ch>
 * @package Discord\Embed
 */
class Provider extends AbstractEmbed
{
    /**
     * @param string $name
     *
     * @return Provider
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return Provider
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
            'name' => $this->name,
            'url'  => $this->url
        ];
    }
}
