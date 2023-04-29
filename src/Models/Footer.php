<?php

namespace App\Models;

class Footer
{
    private $footer;

    public function __construct(array $footer)
    {
        $this->footer = $footer;
    }

    public function getFooter(): array
	{
        return $this->footer;
	}
}
