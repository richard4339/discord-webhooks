<?php

namespace Discord\Embed;

/**
 * Class Video
 *
 * @author Scrummer <scrummer@gmx.ch>
 * @package Discord\Embed
 */
class Video extends AbstractEmbed
{
    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param int $width
     *
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;

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
            'url'    => $this->url,
            'height' => $this->height,
            'width'  => $this->width
        ];
    }
}
