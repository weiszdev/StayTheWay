<?php
function staytheway_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('staytheway-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.5');
    wp_enqueue_script('staytheway-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.4', true);
}
add_action('wp_enqueue_scripts', 'staytheway_scripts');

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

// Open Graph & Twitter Card meta for link previews
add_action('wp_head', function() {
    $title = wp_get_document_title();
    $url = home_url($_SERVER['REQUEST_URI']);
    $site = 'StayTheWay';
    $logo = 'https://res.cloudinary.com/dyq7rnjjw/image/upload/c_fill,w_1200,h_630,g_center,q_auto,f_jpg/v1775094378/IMG_2196_waiddo.png';

    // Per-page descriptions and images
    $meta = [
        'benr' => [
            'desc' => 'BENR: Body · Emotions · Neuro · Repair — A biblical framework for whole-person healing. Take the free assessment and receive a personalized 7-day plan grounded in Scripture.',
            'img' => $logo
        ],
        'benr-assessment' => [
            'desc' => 'A gentle, 5-phase biblical reflection to help you see where unresolved burdens may be affecting your body, emotions, and identity. Personalized scriptures and a 7-day healing plan.',
            'img' => $logo
        ],
        'teachings' => [
            'desc' => '300+ free Bible teachings from StayTheWay. Verse-by-verse studies, topical deep dives, and more. Watch, learn, and grow deeper in God\'s Word.',
            'img' => $logo
        ],
        'worship' => [
            'desc' => 'Original worship music from StayTheWay Worship. Stream on Apple Music, Spotify, and all major platforms.',
            'img' => 'https://is1-ssl.mzstatic.com/image/thumb/Music211/v4/36/77/96/36779643-effb-c89c-203f-a1ee098623bf/artwork.jpg/512x512bb.jpg'
        ],
        'quizzes' => [
            'desc' => 'Interactive Bible quizzes — discover your spiritual gifts, find which Man of God you are, test your knowledge of the 7 Pillars of Freedom, and more.',
            'img' => $logo
        ],
        'gifts-quiz' => [
            'desc' => 'Discover your spiritual gifts with this Scripture-grounded assessment. 20 questions, biblical examples, and practical ways to put your gifts to work.',
            'img' => $logo
        ],
        '7-men-quiz' => [
            'desc' => 'Which Man of God are you? Joshua, David, Solomon, Moses, Peter, Samson, or Elijah — take 5 minutes and see where you fit in the Bible.',
            'img' => $logo
        ],
        'community' => [
            'desc' => 'Join the StayTheWay community — home Bible studies, prayer, fellowship, and a place to grow deeper with believers who walk together.',
            'img' => $logo
        ],
        'connect' => [
            'desc' => 'Connect & serve with StayTheWay. Find your place in worship, prayer, leadership, discipleship, technical, children\'s, men\'s, or women\'s ministry.',
            'img' => $logo
        ],
        'give' => [
            'desc' => 'Support the StayTheWay ministry with secure, tax-deductible giving. Every gift helps equip believers to grow deeper in faith.',
            'img' => $logo
        ],
        'resources' => [
            'desc' => 'Free Bible study handouts, guides, and downloadable resources from StayTheWay. Materials for adults, children, and home groups.',
            'img' => $logo
        ],
        'bridges' => [
            'desc' => 'StayTheWay Bridges — connecting biblical wisdom to real life. Explore BENR healing, functional health, home Bible studies, and community impact.',
            'img' => $logo
        ],
        'beliefs' => [
            'desc' => 'What StayTheWay believes — our doctrinal foundation rooted in Scripture. The Bible, the Trinity, salvation, the Church, and more.',
            'img' => $logo
        ],
    ];

    // Default for homepage
    $desc = 'StayTheWay — a 501(c)(3) service ministry equipping believers to grow deep, think biblically, and build community. 300+ free teachings, worship music, quizzes, and resources.';
    $img = $logo;

    if (is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
        if (isset($meta[$slug])) {
            $desc = $meta[$slug]['desc'];
            $img = $meta[$slug]['img'];
        }
    }

    echo "\n<!-- StayTheWay Open Graph -->\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($img) . '">' . "\n";
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
}, 1);

// Helper: nav active class
function stw_nav_class($slug) {
    if (is_front_page() && $slug === 'home') return ' class="active"';
    if (is_page($slug)) return ' class="active"';
    return '';
}

// AJAX email handler — uses REST API for reliable JSON handling
add_action('rest_api_init', function() {
    register_rest_route('stw/v1', '/email', [
        'methods' => 'POST',
        'callback' => 'stw_rest_email',
        'permission_callback' => '__return_true'
    ]);
    register_rest_route('stw/v1', '/verify-email', [
        'methods' => 'POST',
        'callback' => 'stw_rest_verify_email',
        'permission_callback' => '__return_true'
    ]);
});

// Email verification: sends a 6-digit code
function stw_rest_verify_email($request) {
    $data = $request->get_json_params();
    $email = sanitize_email($data['email'] ?? '');
    if (!$email || !is_email($email)) {
        return new WP_REST_Response(['success' => false, 'message' => 'Invalid email'], 400);
    }

    $code = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    set_transient('stw_verify_' . md5($email), $code, 600); // 10 min expiry

    $headers = ['Content-Type: text/html; charset=UTF-8', 'From: StayTheWay <info@staytheway.com>'];
    $body = "<div style='max-width:500px;margin:0 auto;font-family:sans-serif;color:#222;text-align:center;line-height:1.7'>";
    $body .= "<h2 style='margin-bottom:8px'>Verify Your Email</h2>";
    $body .= "<p>Your StayTheWay verification code is:</p>";
    $body .= "<div style='font-size:2.5rem;font-weight:700;letter-spacing:8px;color:#2563eb;margin:20px 0'>{$code}</div>";
    $body .= "<p style='color:#888;font-size:.85rem'>This code expires in 10 minutes.</p>";
    $body .= "<p style='color:#888;font-size:.85rem'>If you didn't request this, you can ignore this email.</p>";
    $body .= "</div>";

    $sent = wp_mail($email, 'Your StayTheWay Verification Code: ' . $code, $body, $headers);
    return new WP_REST_Response(['success' => $sent]);
}

// Main email handler
function stw_rest_email($request) {
    $data = $request->get_json_params();
    if (!$data || empty($data['type'])) {
        return new WP_REST_Response(['success' => false, 'message' => 'Invalid request'], 400);
    }

    $admin_email = 'info@staytheway.com';
    $headers = ['Content-Type: text/html; charset=UTF-8', 'From: StayTheWay <info@staytheway.com>'];

    if ($data['type'] === 'benr_results') {
        $user_email = sanitize_email($data['email'] ?? '');
        $html = wp_kses_post($data['html'] ?? '');
        $subject = 'Your BENR Assessment Results — StayTheWay';
        $body = '<div style="max-width:600px;margin:0 auto;font-family:Georgia,serif;color:#222;line-height:1.7">';
        $body .= '<h1 style="text-align:center;font-family:sans-serif">Your BENR Assessment Results</h1>';
        $body .= $html;
        $body .= '<p style="text-align:center;margin-top:32px;font-size:.9rem;color:#888">StayTheWay — <a href="https://staytheway.com/benr/">staytheway.com/benr</a></p>';
        $body .= '</div>';

        if ($user_email) { wp_mail($user_email, $subject, $body, $headers); }
        wp_mail($admin_email, '[BENR Results] ' . ($user_email ?: 'Anonymous'), $body, $headers);
        return new WP_REST_Response(['success' => true]);

    } elseif ($data['type'] === 'connect_form') {
        $first = sanitize_text_field($data['firstName'] ?? '');
        $last = sanitize_text_field($data['lastName'] ?? '');
        $email = sanitize_email($data['email'] ?? '');
        $phone = sanitize_text_field($data['phone'] ?? '');
        $ministries = sanitize_text_field($data['ministries'] ?? '');
        $notes = sanitize_textarea_field($data['notes'] ?? '');

        // Verify the code
        $code = sanitize_text_field($data['verifyCode'] ?? '');
        $stored = get_transient('stw_verify_' . md5($email));
        if (!$stored || $stored !== $code) {
            return new WP_REST_Response(['success' => false, 'message' => 'Invalid or expired verification code'], 400);
        }
        delete_transient('stw_verify_' . md5($email));

        // Admin notification
        $admin_body = "<h2>New Ministry Connection</h2>";
        $admin_body .= "<p><strong>Name:</strong> {$first} {$last}</p>";
        $admin_body .= "<p><strong>Email:</strong> {$email} ✓ verified</p>";
        $admin_body .= "<p><strong>Phone:</strong> {$phone}</p>";
        $admin_body .= "<p><strong>Ministries:</strong> {$ministries}</p>";
        $admin_body .= "<p><strong>Notes:</strong> {$notes}</p>";
        $admin_body .= "<p><strong>Date:</strong> " . date('Y-m-d H:i:s') . "</p>";
        wp_mail($admin_email, '[StayTheWay] New Connection — ' . $first . ' ' . $last, $admin_body, $headers);

        // Confirmation to user
        $user_body = "<div style='max-width:600px;margin:0 auto;font-family:sans-serif;color:#222;line-height:1.7'>";
        $user_body .= "<h2>Welcome, {$first}!</h2>";
        $user_body .= "<p>Thank you for connecting with StayTheWay.</p>";
        $user_body .= "<p><strong>You selected:</strong> {$ministries}</p>";
        $user_body .= "<p>Someone from our team will follow up with you soon.</p>";
        $user_body .= "<p>Discover your spiritual gifts: <a href='https://staytheway.com/gifts-quiz/'>Take the Gifts Quiz</a></p>";
        $user_body .= "<br><p>Blessings,<br>StayTheWay Ministry</p></div>";
        wp_mail($email, 'Welcome to StayTheWay — You\'re Connected!', $user_body, $headers);

        // SMS opt-in: save subscriber and send welcome text
        $sms_optin = sanitize_text_field($data['smsOptin'] ?? '');
        if ($sms_optin === 'yes' && $phone) {
            $clean_phone = preg_replace('/[^0-9]/', '', $phone);
            if (strlen($clean_phone) === 10) $clean_phone = '1' . $clean_phone;
            if (strlen($clean_phone) >= 11) {
                stw_save_sms_subscriber($clean_phone, $first, $email);
                stw_send_sms('+' . $clean_phone,
                    "Welcome to StayTheWay, {$first}! You'll receive a weekly Scripture reminder every Monday morning. Reply STOP anytime to unsubscribe. — staytheway.com"
                );
            }
        }

        return new WP_REST_Response(['success' => true]);
    }

    return new WP_REST_Response(['success' => false, 'message' => 'Unknown type'], 400);
}

// ========== TWILIO SMS ==========
// Set credentials via WP-CLI:
// wp option update stw_twilio_sid "YOUR_ACCOUNT_SID"
// wp option update stw_twilio_token "YOUR_AUTH_TOKEN"
// wp option update stw_twilio_from "+1XXXXXXXXXX"

function stw_send_sms($to, $message) {
    $sid = get_option('stw_twilio_sid');
    $token = get_option('stw_twilio_token');
    $from = get_option('stw_twilio_from');
    if (!$sid || !$token || !$from) return false;

    // Rate limit: max 5 SMS per phone per day
    $rate_key = 'stw_sms_rate_' . md5($to);
    $count = (int) get_transient($rate_key);
    if ($count >= 5) return false;
    set_transient($rate_key, $count + 1, DAY_IN_SECONDS);

    $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";
    $response = wp_remote_post($url, [
        'headers' => ['Authorization' => 'Basic ' . base64_encode($sid . ':' . $token)],
        'body' => ['To' => $to, 'MessagingServiceSid' => $from, 'Body' => $message],
        'timeout' => 15
    ]);

    if (is_wp_error($response)) {
        error_log('STW SMS Error: ' . $response->get_error_message());
        return false;
    }
    $code = wp_remote_retrieve_response_code($response);
    if ($code >= 200 && $code < 300) return true;
    error_log('STW SMS Error: HTTP ' . $code . ' — ' . wp_remote_retrieve_body($response));
    return false;
}

// Save SMS subscriber to a WP option (simple list)
function stw_save_sms_subscriber($phone, $name, $email) {
    $subs = get_option('stw_sms_subscribers', []);
    // Check for duplicate
    foreach ($subs as $s) {
        if ($s['phone'] === $phone) return;
    }
    $subs[] = ['phone' => $phone, 'name' => $name, 'email' => $email, 'date' => date('Y-m-d')];
    update_option('stw_sms_subscribers', $subs);
}

// ========== WEEKLY SCRIPTURE REMINDERS (WP-Cron) ==========
// Runs every Monday at ~8 AM server time
add_action('stw_weekly_sms', 'stw_send_weekly_scripture');

// Schedule on theme activation
add_action('after_switch_theme', function() {
    if (!wp_next_scheduled('stw_weekly_sms')) {
        // Next Monday 8 AM UTC
        $next = strtotime('next monday 14:00:00 UTC'); // ~8 AM CT
        wp_schedule_event($next, 'weekly', 'stw_weekly_sms');
    }
});

// Also schedule if not already
if (!wp_next_scheduled('stw_weekly_sms')) {
    $next = strtotime('next monday 14:00:00 UTC');
    wp_schedule_event($next, 'weekly', 'stw_weekly_sms');
}

function stw_send_weekly_scripture() {
    $scriptures = [
        ["Be still, and know that I am God.", "Psalm 46:10"],
        ["Cast your burden on the Lord, and He shall sustain you.", "Psalm 55:22"],
        ["He heals the brokenhearted and binds up their wounds.", "Psalm 147:3"],
        ["Be transformed by the renewing of your mind.", "Romans 12:2"],
        ["God has not given us a spirit of fear, but of power and of love and of a sound mind.", "2 Timothy 1:7"],
        ["Come to Me, all you who labor and are heavy laden, and I will give you rest.", "Matthew 11:28"],
        ["I can do all things through Christ who strengthens me.", "Philippians 4:13"],
        ["The Lord is my shepherd; I shall not want.", "Psalm 23:1"],
        ["Trust in the Lord with all your heart, and lean not on your own understanding.", "Proverbs 3:5"],
        ["If God is for us, who can be against us?", "Romans 8:31"],
        ["You shall know the truth, and the truth shall make you free.", "John 8:32"],
        ["I will never leave you nor forsake you.", "Hebrews 13:5"],
        ["Fear not, for I have redeemed you; I have called you by your name; you are Mine.", "Isaiah 43:1"],
        ["In everything give thanks; for this is the will of God in Christ Jesus for you.", "1 Thessalonians 5:18"],
        ["We are His workmanship, created in Christ Jesus for good works.", "Ephesians 2:10"],
        ["The peace of God, which surpasses all understanding, will guard your hearts and minds.", "Philippians 4:7"],
        ["He who has begun a good work in you will complete it.", "Philippians 1:6"],
        ["If anyone is in Christ, he is a new creation.", "2 Corinthians 5:17"],
        ["The joy of the Lord is your strength.", "Nehemiah 8:10"],
        ["I will restore to you the years that the swarming locust has eaten.", "Joel 2:25"],
        ["He shall cover you with His feathers, and under His wings you shall take refuge.", "Psalm 91:4"],
        ["In quietness and confidence shall be your strength.", "Isaiah 30:15"],
        ["The Lord your God in your midst, the Mighty One, will save; He will rejoice over you with gladness.", "Zephaniah 3:17"],
        ["You are a chosen generation, a royal priesthood, His own special people.", "1 Peter 2:9"],
        ["Peace I leave with you, My peace I give to you.", "John 14:27"],
        ["Delight yourself in the Lord, and He shall give you the desires of your heart.", "Psalm 37:4"],
        ["The Lord is near to all who call upon Him.", "Psalm 145:18"],
        ["I have called you by name; you are Mine.", "Isaiah 43:1"],
        ["His mercies are new every morning; great is His faithfulness.", "Lamentations 3:23"],
        ["He restores my soul.", "Psalm 23:3"],
        ["If the Son makes you free, you shall be free indeed.", "John 8:36"],
        ["I am the way, the truth, and the life.", "John 14:6"],
        ["As each one has received a gift, minister it to one another.", "1 Peter 4:10"],
        ["The Lord is my light and my salvation; whom shall I fear?", "Psalm 27:1"],
        ["Draw near to God and He will draw near to you.", "James 4:8"],
        ["They who wait on the Lord shall renew their strength.", "Isaiah 40:31"],
        ["I have loved you with an everlasting love.", "Jeremiah 31:3"],
        ["Do not be overcome by evil, but overcome evil with good.", "Romans 12:21"],
        ["He makes me lie down in green pastures. He leads me beside still waters.", "Psalm 23:2"],
        ["Your word is a lamp to my feet and a light to my path.", "Psalm 119:105"],
        ["Where the Spirit of the Lord is, there is liberty.", "2 Corinthians 3:17"],
        ["The name of the Lord is a strong tower; the righteous run to it and are safe.", "Proverbs 18:10"],
        ["My grace is sufficient for you, for My strength is made perfect in weakness.", "2 Corinthians 12:9"],
        ["No weapon formed against you shall prosper.", "Isaiah 54:17"],
        ["The Lord will fight for you, and you shall hold your peace.", "Exodus 14:14"],
        ["Blessed are the pure in heart, for they shall see God.", "Matthew 5:8"],
        ["Let us not grow weary while doing good, for in due season we shall reap.", "Galatians 6:9"],
        ["Great is our Lord, and mighty in power; His understanding is infinite.", "Psalm 147:5"],
        ["Whatever you do, do it heartily, as to the Lord.", "Colossians 3:23"],
        ["The Lord bless you and keep you; the Lord make His face shine upon you.", "Numbers 6:24-25"],
        ["Seek first the kingdom of God and His righteousness, and all these things shall be added to you.", "Matthew 6:33"],
        ["We walk by faith, not by sight.", "2 Corinthians 5:7"]
    ];

    // Pick based on week number so it cycles through all 52
    $week = (int) date('W');
    $idx = $week % count($scriptures);
    $verse = $scriptures[$idx];

    $message = "Good morning from StayTheWay!\n\n\"{$verse[0]}\"\n— {$verse[1]} (NKJV)\n\nHave a blessed week. staytheway.com";

    $subs = get_option('stw_sms_subscribers', []);
    foreach ($subs as $sub) {
        stw_send_sms('+' . $sub['phone'], $message);
    }

    // Log it
    error_log('STW Weekly SMS: Sent to ' . count($subs) . ' subscribers — ' . $verse[1]);
}

// ========== TWILIO WEBHOOK: Handle STOP/unsubscribe ==========
add_action('rest_api_init', function() {
    register_rest_route('stw/v1', '/sms-webhook', [
        'methods' => 'POST',
        'callback' => 'stw_sms_webhook',
        'permission_callback' => '__return_true'
    ]);
});

function stw_sms_webhook($request) {
    $body = strtoupper(trim($request->get_param('Body') ?? ''));
    $from = $request->get_param('From') ?? '';
    $clean = preg_replace('/[^0-9]/', '', $from);

    if (in_array($body, ['STOP', 'UNSUBSCRIBE', 'CANCEL', 'END', 'QUIT'])) {
        $subs = get_option('stw_sms_subscribers', []);
        $subs = array_filter($subs, function($s) use ($clean) {
            return $s['phone'] !== $clean;
        });
        update_option('stw_sms_subscribers', array_values($subs));
        error_log('STW SMS: Unsubscribed ' . $from);
    }

    // Twilio expects TwiML response
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8"?><Response></Response>';
    exit;
}
