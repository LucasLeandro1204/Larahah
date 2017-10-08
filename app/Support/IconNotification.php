<?php

namespace App\Support;

class IconNotification
{
    /**
     * The notification icon.
     *
     * @var string
     */
    protected $icon;

    /**
     * The notification message.
     *
     * @var string
     */
    protected $message;

    /**
     * Set the notification message.
     *
     * @param  string  $message
     * @return self
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the notification icon.
     *
     * @param  string  $icon
     * @return self
     */
    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get an array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'icon' => 'fa fa-' . $this->icon,
        ];
    }
}
