<?php

namespace Discord\Embed;

/**
 * Class Field
 *
 * @author  Scrummer <scrummer@gmx.ch>
 * @package Discord\Embed
 */
class Field extends AbstractEmbed
{
    /**
     * @param string $name
     *
     * @return Field
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return Field
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param bool $inline
     *
     * @return Field
     */
    public function setInline($inline)
    {
        $this->inline = $inline;

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
            'name'   => $this->name,
            'value'  => $this->value,
            'inline' => $this->inline
        ];
    }
}
