<?php
/**
 * Give page settings: the only file to edit when giving links change.
 * Leave a value empty ('') and that option is hidden, so the page never shows a dead button.
 */
return [
    // Givebutter → your campaign → Share → Embed. Paste the whole snippet on the blank line below.
    'givebutter_embed' => <<<'GIVEBUTTER'

GIVEBUTTER,

    // The campaign's public link, e.g. https://givebutter.com/your-campaign. Used as a button if there's no embed.
    'givebutter_url' => '',

    // PayPal.me link, or the link from PayPal's donate button.
    'paypal_url' => '',

    // Venmo username, without the @.
    'venmo_handle' => '',

    // Cash App cashtag, without the $.
    'cashtag' => '',

    // Shown when online giving isn't set up yet, and for receipt questions.
    'contact_email' => 'info@staytheway.com',
];
