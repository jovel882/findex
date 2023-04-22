<?php

namespace Findex\OnboardingCard;

use Laravel\Nova\Card;

class OnboardingCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'onboarding-card';
    }
}
