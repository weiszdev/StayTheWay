<?php
/**
 * Give page: Givebutter first, then PayPal / Venmo / Cash App.
 * Links and the Givebutter embed live in give-config.php. Edit that file, not this one.
 */
$give    = include get_template_directory() . '/give-config.php';
$give    = is_array($give) ? $give : [];
$embed   = trim((string)($give['givebutter_embed'] ?? ''));
$gbUrl   = trim((string)($give['givebutter_url'] ?? ''));
$paypal  = trim((string)($give['paypal_url'] ?? ''));
$venmo   = preg_replace('/[^A-Za-z0-9_-]/', '', ltrim(trim((string)($give['venmo_handle'] ?? '')), '@'));
$cashtag = preg_replace('/[^A-Za-z0-9_]/', '', ltrim(trim((string)($give['cashtag'] ?? '')), '$'));
$email   = sanitize_email((string)($give['contact_email'] ?? '')) ?: 'info@staytheway.com';

$hasOnline = ($embed !== '' || $gbUrl !== '');
$methods   = [];
if ($paypal !== '')  { $methods[] = ['PayPal', 'Secure and widely trusted payment platform.', $paypal, 'Give via PayPal']; }
if ($venmo !== '')   { $methods[] = ['Venmo', 'Quick and easy peer-to-peer payments. @' . $venmo, 'https://venmo.com/u/' . $venmo, 'Give via Venmo']; }
if ($cashtag !== '') { $methods[] = ['Cash App', 'Fast mobile payments. $' . $cashtag, 'https://cash.app/$' . $cashtag, 'Give via Cash App']; }
$mailto  = 'mailto:' . $email . '?subject=' . rawurlencode('Giving to StayTheWay');
$giveNow = $hasOnline ? '#give-online' : ($methods ? '#other-ways' : $mailto);

get_header();
?>

<!-- HERO -->
<section class="hero reveal">
  <div class="container" style="text-align:center">
    <div class="eyebrow">Support the Ministry</div>
    <h1>Give</h1>
    <p>Every gift goes directly to equipping believers with biblical truth and fostering spiritual community. Your generosity fuels our mission to strengthen faith in Christ.</p>
  </div>
</section>

<!-- GIVE ONLINE (Givebutter) -->
<section class="give-section reveal" id="give-online">
  <div class="give-inner">
    <h2>Give Online</h2>
<?php if ($hasOnline): ?>
    <p>Secure, tax-deductible giving through Givebutter.</p>
    <div class="give-features">
      <ul>
        <li>Give once or set up monthly giving</li>
        <li>Tax-deductible receipt emailed automatically</li>
        <li>Every gift equips believers to grow deeper in faith</li>
      </ul>
    </div>
  <?php if ($embed !== ''): ?>
    <div class="give-embed">
<?php echo $embed; /* pasted as-is from the Givebutter dashboard */ ?>
    </div>
  <?php else: ?>
    <a href="<?php echo esc_url($gbUrl); ?>" target="_blank" rel="noopener" class="btn btn-white">Give Online</a>
  <?php endif; ?>
<?php else: ?>
    <p>Online giving is being set up. To give today, email <a href="<?php echo esc_url($mailto); ?>"><?php echo esc_html($email); ?></a> and we'll help you.</p>
<?php endif; ?>
  </div>
</section>

<?php if ($methods): ?>
<!-- OTHER METHODS -->
<section class="methods-section reveal" id="other-ways">
  <div class="container">
    <h2><?php echo $hasOnline ? 'Other Ways to Give' : 'Ways to Give'; ?></h2>
    <div class="methods-grid">
<?php foreach ($methods as [$name, $desc, $href, $label]): ?>
      <div class="method-card">
        <h3><?php echo esc_html($name); ?></h3>
        <p><?php echo esc_html($desc); ?></p>
        <a href="<?php echo esc_url($href); ?>" target="_blank" rel="noopener" class="btn btn-secondary"><?php echo esc_html($label); ?></a>
      </div>
<?php endforeach; ?>
    </div>
<?php if ($hasOnline): ?>
    <p class="methods-note">Need a tax receipt? Give online above and it's emailed to you automatically.</p>
<?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- WHERE YOUR GIFT GOES -->
<section class="impact-section reveal">
  <div class="container">
    <h2>Where Your Gift Goes</h2>
    <div class="impact-grid">
      <div class="impact-card">
        <h3>Teaching Production</h3>
        <p>Filming, professional equipment, studio resources, and content creation tools that enable high-quality biblical teachings.</p>
      </div>
      <div class="impact-card">
        <h3>Resource Development</h3>
        <p>Creating handouts, study guides, children's materials, and discipleship resources to strengthen Bible study.</p>
      </div>
      <div class="impact-card">
        <h3>Community Outreach</h3>
        <p>Supporting home Bible study groups, empowering bridge leaders, and funding community outreach initiatives.</p>
      </div>
    </div>
  </div>
</section>

<!-- TAX INFO -->
<section class="tax-section reveal">
  <div class="container">
    <div class="tax-inner">
      <h2>Tax Information</h2>
      <div class="tax-grid">
        <div class="tax-item">
          <h3>501(c)(3) Status</h3>
          <p>StayTheWay Ministry is a registered 501(c)(3) nonprofit organization. All contributions are tax-deductible.</p>
        </div>
        <div class="tax-item">
          <h3>Automatic Receipts</h3>
<?php if ($hasOnline): ?>
          <p>When you give online through Givebutter, your tax-deductible receipt is emailed to you automatically.</p>
<?php else: ?>
          <p>Email <a href="<?php echo esc_url($mailto); ?>"><?php echo esc_html($email); ?></a> and we'll send your tax-deductible receipt.</p>
<?php endif; ?>
        </div>
        <div class="tax-item">
          <h3>EIN</h3>
          <p>Our Employer Identification Number (EIN) is available upon request.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="cta-section reveal">
  <div class="container">
    <h2>Make an Impact Today</h2>
    <p>Your generosity directly strengthens believers and builds thriving faith communities.</p>
    <a href="<?php echo esc_url($giveNow); ?>" class="btn btn-primary">Give Now</a>
  </div>
</section>

<?php get_footer(); ?>
