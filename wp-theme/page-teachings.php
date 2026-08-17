<?php get_header(); ?>

<!-- ========== FEATURED HERO ========== -->
<style>
/* A pillarboxed thumbnail must never show its hard seams through the backdrop. */
.hero-bg { filter: blur(22px) brightness(.32) saturate(1.1) !important; transform: scale(1.18) !important; }
</style>
<section class="featured-hero" id="featuredHero">
  <div class="hero-bg" id="heroBg"></div>
  <div class="hero-content">
    <div class="featured-inner">
      <div class="featured-thumb" id="featuredThumb">
        <img id="featuredImg" src="" alt="">
        <div class="play-overlay"><div class="play-circle"></div></div>
      </div>
      <div class="featured-text">
        <div class="label">Latest Teaching</div>
        <h2 id="featuredTitle"></h2>
        <p class="desc" id="featuredDesc"></p>
        <div class="date" id="featuredDate"></div>
      </div>
    </div>
  </div>
</section>

<!-- ========== STATS STRIP ========== -->
<div class="stats-strip reveal">
  <div class="stats-row">
    <div class="stat-item"><div class="stat-num" id="statVideos">—</div><div class="stat-label">Teachings</div></div>
    <div class="stat-item"><div class="stat-num" id="statViews">—</div><div class="stat-label">Total Views</div></div>
    <div class="stat-item"><div class="stat-num" id="statSubs">—</div><div class="stat-label">Subscribers</div></div>
  </div>
</div>

<!-- ========== SERIES & INTERACTIVE RESOURCES ========== -->
<section style="padding:56px 0;border-bottom:1px solid #1a1a1a">
  <div class="container">
    <div style="text-align:center;margin-bottom:12px">
      <div class="section-label">Series &amp; Interactive Resources</div>
      <h2 class="section-title">Teaching Packages</h2>
      <p style="color:#a3a3a3;max-width:600px;margin:0 auto 16px;font-size:.95rem">Each teaching comes with interactive resources — quizzes, Bible bingo, prayer, and kids activities. Tap any card to explore.</p>
    </div>

    <!-- FEATURED: Latest Teaching -->
    <a href="<?php echo esc_url(home_url('/teachings/hebrews-4/')); ?>" style="display:block;text-decoration:none;color:inherit;background:linear-gradient(135deg,rgba(37,99,235,0.08),rgba(37,99,235,0.02));border:1px solid rgba(37,99,235,0.2);border-radius:14px;padding:28px 32px;margin-bottom:24px;transition:border-color .3s,transform .3s" onmouseover="this.style.borderColor='#2563eb';this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='rgba(37,99,235,0.2)';this.style.transform='none'">
      <div style="display:flex;gap:22px;align-items:flex-start;flex-wrap:wrap">
      <div style="flex:0 0 300px;max-width:100%;position:relative;border-radius:12px;overflow:hidden;aspect-ratio:16/9;background:#0b1730;border:1px solid rgba(37,99,235,0.3)">
        <img src="https://i.ytimg.com/vi/WJSYGNo8PsI/maxresdefault.jpg" alt="Hebrews 4 teaching" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block">
        <span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:54px;height:54px;border-radius:50%;background:rgba(37,99,235,.92);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 26px rgba(0,0,0,.5)"><span style="width:0;height:0;border-style:solid;border-width:9px 0 9px 15px;border-color:transparent transparent transparent #fff;margin-left:3px"></span></span>
      </div>
      <div style="flex:1 1 260px;min-width:0">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px">
        <span style="font-size:.7rem;font-weight:700;color:#fff;background:#2563eb;padding:3px 10px;border-radius:100px;letter-spacing:.06em;text-transform:uppercase">New</span>
        <span style="font-size:.75rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Aug 16, 2026</span>
      </div>
      <h3 style="color:#fff;font-size:1.3rem;margin-bottom:6px">Hebrews 4 &mdash; The Rest, The Word, The High Priest</h3>
      <p style="color:#a3a3a3;font-size:.9rem;margin-bottom:8px">A promise still standing, a warning still sounding, a Word still cutting to the thoughts and intents of the heart &mdash; and a throne of grace still open.</p>
      <div style="display:flex;gap:6px;flex-wrap:wrap">
        <span style="font-size:.7rem;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(37,99,235,0.1);color:#60a5fa;letter-spacing:.04em;text-transform:uppercase">Quiz</span>
        <span style="font-size:.7rem;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(37,99,235,0.1);color:#60a5fa;letter-spacing:.04em;text-transform:uppercase">Bingo</span>
        <span style="font-size:.7rem;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(37,99,235,0.1);color:#60a5fa;letter-spacing:.04em;text-transform:uppercase">Prayer</span>
        <span style="font-size:.7rem;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(37,99,235,0.1);color:#60a5fa;letter-spacing:.04em;text-transform:uppercase">Kids</span>
        </div>
      </div>
    </div>
    </a>


    <a href="https://podcasts.apple.com/us/podcast/stay-the-way/id1187607030" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:14px;text-decoration:none;color:inherit;background:linear-gradient(135deg,rgba(255,143,163,0.10),rgba(255,143,163,0.02));border:1px solid rgba(255,143,163,0.28);border-radius:14px;padding:16px 20px;margin-bottom:24px;transition:border-color .3s,transform .3s" onmouseover="this.style.borderColor='#FF8FA3';this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='rgba(255,143,163,0.28)';this.style.transform='none'">
      <span style="font-size:1.7rem">&#127911;</span>
      <div>
        <div style="color:#fff;font-weight:700;font-size:1rem">Prefer to listen? Stay The Way Podcast</div>
        <div style="color:#a3a3a3;font-size:.86rem">Every teaching as audio &mdash; 500+ episodes on Apple Podcasts</div>
      </div>
    </a>

    <!-- RECENT TEACHINGS -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
      <h3 style="color:#fff;font-size:1.1rem;margin:0">Recent Teachings <span style="color:#888;font-weight:400;font-size:.85rem">&mdash; standalone studies</span></h3>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-bottom:32px">
      <a href="<?php echo esc_url(home_url('/teachings/hebrews-4/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Aug 16, 2026</span>
        <span class="lc-text" style="font-size:.88rem">Hebrews 4</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/7-marriages-god-blessed/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Jul 5, 2026</span>
        <span class="lc-text" style="font-size:.88rem">7 Marriages God Blessed</span>
      </a>
    </div>

    <!-- SERIES: Walking By the Spirit -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
      <h3 style="color:#fff;font-size:1.1rem;margin:0">Walking By the Spirit <span style="color:#888;font-weight:400;font-size:.85rem">— 7-Week Series</span></h3>
      <a href="<?php echo esc_url(home_url('/teachings/walking-by-the-spirit/')); ?>" style="font-size:.85rem;font-weight:600;color:#60a5fa">View series &rarr;</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-bottom:32px">
      <a href="<?php echo esc_url(home_url('/teachings/7-pillars-man/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 1</span>
        <span class="lc-text" style="font-size:.88rem">7 Pillars — Man</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/7-pillars-woman/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 2</span>
        <span class="lc-text" style="font-size:.88rem">7 Pillars — Woman</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/7-women-god-met/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 3</span>
        <span class="lc-text" style="font-size:.88rem">7 Wives, 7 Husbands</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/7-fake-christians/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 4</span>
        <span class="lc-text" style="font-size:.88rem">7 Fake Christians</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/romans-7/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 5</span>
        <span class="lc-text" style="font-size:.88rem">Romans 7</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/romans-8/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 6</span>
        <span class="lc-text" style="font-size:.88rem">Romans 8</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/fruit-or-flesh/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 7</span>
        <span class="lc-text" style="font-size:.88rem">Fruit or Flesh</span>
      </a>
      <a href="<?php echo esc_url(home_url('/teachings/be-still/')); ?>" class="link-card" style="flex-direction:column;align-items:flex-start;gap:6px;padding:16px 18px;border-color:rgba(37,99,235,0.4)">
        <span style="font-size:.7rem;font-weight:600;color:#2563eb;letter-spacing:.06em;text-transform:uppercase">Week 8</span>
        <span class="lc-text" style="font-size:.88rem">Be Still &amp; Know</span>
      </a>
    </div>

    <!-- SECTION LABEL FOR VIDEO LIST -->
    <div style="text-align:center;margin-top:8px">
      <div class="section-label">Full Library</div>
      <h2 class="section-title" style="margin-bottom:0">All Teachings</h2>
    </div>
  </div>
</section>

<!-- ========== SEARCH & FILTER ========== -->
<section class="search-section">
  <div class="container-wide">
    <div class="search-bar">
      <input type="text" class="search-input" id="searchInput" placeholder="Search teachings by title or topic...">
    </div>
    <div class="search-count" id="searchCount"></div>
    <div class="filters" id="filterWrap">
      <button class="filter-btn active" data-playlist="all">All</button>
    </div>
  </div>
</section>

<!-- ========== VIDEO GRID ========== -->
<section style="padding-top:0">
  <div class="container-wide">
    <div class="video-list" id="videoGrid"></div>
    <div class="no-results" id="noResults" style="display:none">
      <h3>No teachings found</h3>
      <p>Try a different search term or clear your filters.</p>
    </div>
    <div class="load-more-wrap" id="loadMoreWrap">
      <button class="btn btn-secondary" id="loadMoreBtn" style="display:none" onclick="renderNextBatch()">Load More Teachings</button>
      <div class="loading-spinner" id="loadingSpinner"></div>
    </div>
  </div>
</section>

<!-- ========== CTA ========== -->
<section class="cta-section reveal">
  <div class="container">
    <h2>Want to Go Deeper?</h2>
    <p>Join a home fellowship, download study guides, or start the 7 Pillars of Freedom series.</p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/community/')); ?>" class="btn btn-primary">Join Community</a>
      <a href="<?php echo esc_url(home_url('/resources/')); ?>" class="btn btn-secondary">Study Resources</a>
    </div>
  </div>
</section>

<!-- ========== VIDEO LIGHTBOX ========== -->
<div class="lightbox" id="lightbox">
  <div class="lightbox-inner">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <iframe id="lightboxIframe" src="" allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>

<?php get_footer(); ?>

<script>
(function(){
"use strict";

const API_KEY = 'AIzaSyDroXdYqCxQDBXOzp1Ha9wIHJhg36iPUbw';
const CHANNEL_ID = 'UCmL874CrrKEa6l7fXWdePUQ';
const CHANNEL_HANDLE = 'weStayTheWay';
const UPLOADS_PLAYLIST = 'UUmL874CrrKEa6l7fXWdePUQ';
const BATCH_SIZE = 10;

let allVideos = [];
let filteredVideos = [];
let renderedCount = 0;
let activePlaylist = 'all';
let searchTerm = '';
let playlists = []; // { id, title, videoIds }

function formatDate(iso) {
  const d = new Date(iso);
  return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function formatCount(n) {
  n = parseInt(n);
  if (n >= 1000000) return (n/1000000).toFixed(1) + 'M';
  if (n >= 1000) return (n/1000).toFixed(n >= 10000 ? 0 : 1) + 'K';
  return n.toLocaleString();
}

// ========== FETCH PLAYLISTS ==========
async function fetchPlaylists() {
  let result = [];
  let pageToken = '';
  while (true) {
    const url = `https://www.googleapis.com/youtube/v3/playlists?part=snippet&channelId=${CHANNEL_ID}&maxResults=50&key=${API_KEY}` + (pageToken ? `&pageToken=${pageToken}` : '');
    try {
      const res = await fetch(url);
      const data = await res.json();
      if (!data.items) break;
      for (const item of data.items) {
        // Skip the auto-generated uploads playlist
        if (item.id === UPLOADS_PLAYLIST) continue;
        result.push({
          id: item.id,
          title: item.snippet.title,
          videoIds: new Set()
        });
      }
      pageToken = data.nextPageToken;
      if (!pageToken) break;
    } catch (e) {
      console.warn('Playlist fetch error:', e);
      break;
    }
  }
  // Sort alphabetically
  result.sort((a, b) => a.title.localeCompare(b.title));
  return result;
}

// ========== FETCH VIDEO IDS FOR EACH PLAYLIST ==========
async function fetchPlaylistVideoIds(playlist) {
  let pageToken = '';
  while (true) {
    const url = `https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=${playlist.id}&maxResults=50&key=${API_KEY}` + (pageToken ? `&pageToken=${pageToken}` : '');
    try {
      const res = await fetch(url);
      const data = await res.json();
      if (!data.items) break;
      for (const item of data.items) {
        if (item.snippet && item.snippet.resourceId) {
          playlist.videoIds.add(item.snippet.resourceId.videoId);
        }
      }
      pageToken = data.nextPageToken;
      if (!pageToken) break;
    } catch (e) {
      console.warn('Playlist items fetch error:', e);
      break;
    }
  }
}

// ========== BUILD FILTER BUTTONS ==========
function buildFilterButtons() {
  const wrap = document.getElementById('filterWrap');
  // Keep the "All" button, add playlist buttons
  for (const pl of playlists) {
    if (pl.videoIds.size === 0) continue; // skip empty playlists
    const btn = document.createElement('button');
    btn.className = 'filter-btn';
    btn.dataset.playlist = pl.id;
    btn.textContent = pl.title;
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activePlaylist = pl.id;
      applyFilters();
    });
    wrap.appendChild(btn);
  }

  // Wire up the "All" button
  document.querySelector('.filter-btn[data-playlist="all"]').addEventListener('click', function() {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    activePlaylist = 'all';
    applyFilters();
  });
}

// ========== LIVE STREAM CHECK ==========
async function checkLiveStream() {
  try {
    const url = `https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=${CHANNEL_ID}&eventType=live&type=video&key=${API_KEY}`;
    const res = await fetch(url);
    const data = await res.json();
    if (data.items && data.items.length > 0) {
      const live = data.items[0];
      return {
        id: live.id.videoId,
        title: live.snippet.title,
        desc: live.snippet.description || '',
        thumb: (live.snippet.thumbnails.maxres || live.snippet.thumbnails.high || live.snippet.thumbnails.medium).url,
        isLive: true
      };
    }
  } catch (e) { console.warn('Live check failed:', e); }
  return null;
}

function renderLiveFeatured(live) {
  document.getElementById('featuredImg').src = live.thumb;
  document.getElementById('featuredImg').alt = live.title;
  document.getElementById('heroBg').style.backgroundImage = `url(${live.thumb})`;
  document.getElementById('featuredTitle').textContent = live.title;
  document.getElementById('featuredDesc').textContent = live.desc.split('\n').slice(0,3).join(' ').slice(0,300);
  const label = document.querySelector('.featured-text .label');
  label.innerHTML = '<span class="live-badge"><span class="live-dot"></span>LIVE NOW</span>';
  document.getElementById('featuredDate').textContent = 'Streaming live — join now';
  document.getElementById('featuredThumb').onclick = () => openLightbox(live.id);
}

// ========== FETCH ALL VIDEOS ==========

/* ------------------------------------------------------------------
   Shorts / vertical-video exclusion.
   YouTube gives no "isShort" flag, and this channel does not tag titles
   with #shorts, so title matching never worked. videos?part=player DOES
   return the true embed dimensions, which is a reliable format signal:
     Short   -> 405 x 720  (portrait)
     Teaching-> 1280 x 720 (wide)
   We enrich every video with aspect + duration, then keep only wide ones.
------------------------------------------------------------------- */
/* A YouTube Short is BOTH vertical AND <= 3 minutes. Orientation alone is not
   enough: this channel streams many full teachings in portrait (a 3.4-hour
   Armor of God study, several Sunday services). Filtering on aspect alone
   hid 77 real teachings, so both conditions are required. */
const STW_SHORT_MAX_SECONDS = 180;  // YouTube's own Shorts ceiling
const STW_PORTRAIT_ASPECT   = 1.0;  // width/height < 1 = vertical
const STW_MIN_FEATURED      = 300;  // featured slot must be >= 5 minutes

function stwIsoToSeconds(iso) {
  const m = /^P(?:(\d+)D)?T(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?$/.exec(iso || '');
  if (!m) return 0;
  const [, d, h, mi, sec] = m.map(x => parseInt(x || 0, 10));
  return (d || 0) * 86400 + (h || 0) * 3600 + (mi || 0) * 60 + (sec || 0);
}

async function enrichVideoFormat(videos) {
  const byId = {};
  videos.forEach(v => { byId[v.id] = v; });
  const ids = videos.map(v => v.id);
  const chunks = [];
  for (let i = 0; i < ids.length; i += 50) chunks.push(ids.slice(i, i + 50));

  await Promise.all(chunks.map(async chunk => {
    try {
      const url = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails,player'
                + '&maxHeight=720&id=' + chunk.join(',') + '&key=' + API_KEY;
      const data = await (await fetch(url)).json();
      (data.items || []).forEach(it => {
        const v = byId[it.id];
        if (!v) return;
        const html = (it.player && it.player.embedHtml) || '';
        const w = /width="(\d+)"/.exec(html);
        const h = /height="(\d+)"/.exec(html);
        v.aspect = (w && h && +h[1]) ? (+w[1] / +h[1]) : null;
        v.durationSec = stwIsoToSeconds(it.contentDetails && it.contentDetails.duration);
      });
    } catch (e) {
      console.warn('[STW] format enrich failed for a chunk', e);
    }
  }));
  return videos;
}

/* Unknown values (API hiccup) fail OPEN — we never hide a real teaching. */
function stwIsVertical(v) {
  return v.aspect !== null && v.aspect !== undefined && v.aspect < STW_PORTRAIT_ASPECT;
}
function stwIsShort(v) {
  return stwIsVertical(v)
      && v.durationSec !== undefined
      && v.durationSec > 0
      && v.durationSec <= STW_SHORT_MAX_SECONDS;
}
function stwNotShort(v) { return !stwIsShort(v); }

/* Featured: long enough to be a teaching. Wide is preferred (the channel often
   posts a wide and a portrait cut of the same message), but a portrait
   long-form teaching is still better than nothing. */
function stwFeaturedPick(list) {
  const longEnough = list.filter(v => (v.durationSec === undefined || v.durationSec >= STW_MIN_FEATURED));
  return longEnough.find(v => !stwIsVertical(v)) || longEnough[0] || list[0];
}

async function fetchAllVideos() {
  let videos = [];
  let pageToken = '';
  while (true) {
    const url = `https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=${UPLOADS_PLAYLIST}&maxResults=50&key=${API_KEY}` + (pageToken ? `&pageToken=${pageToken}` : '');
    try {
      const res = await fetch(url);
      const data = await res.json();
      if (!data.items) break;
      for (const item of data.items) {
        const s = item.snippet;
        if (!s.thumbnails || !s.resourceId) continue;
        videos.push({
          id: s.resourceId.videoId,
          title: s.title,
          desc: s.description || '',
          date: s.publishedAt,
          thumb: (s.thumbnails.maxres || s.thumbnails.high || s.thumbnails.medium).url,
          thumbMed: (s.thumbnails.medium || s.thumbnails.high).url,
          playlists: [] // will be filled after playlist fetch
        });
      }
      pageToken = data.nextPageToken;
      if (!pageToken) break;
    } catch (e) {
      console.error('Fetch error:', e);
      break;
    }
  }
  return videos;
}

async function fetchChannelStats() {
  try {
    const url = `https://www.googleapis.com/youtube/v3/channels?part=statistics&forHandle=${CHANNEL_HANDLE}&key=${API_KEY}`;
    const res = await fetch(url);
    const data = await res.json();
    if (data.items && data.items[0]) {
      const s = data.items[0].statistics;
      document.getElementById('statVideos').textContent = formatCount(s.videoCount);
      document.getElementById('statViews').textContent = formatCount(s.viewCount);
      document.getElementById('statSubs').textContent = formatCount(s.subscriberCount);
    }
  } catch (e) { console.warn('Stats fetch failed:', e); }
}

// ========== ASSIGN PLAYLISTS TO VIDEOS ==========
function assignPlaylistsToVideos() {
  for (const video of allVideos) {
    video.playlists = [];
    for (const pl of playlists) {
      if (pl.videoIds.has(video.id)) {
        video.playlists.push(pl.id);
      }
    }
  }
}

// ========== GET DISPLAY TAG FOR VIDEO ==========
function getVideoTag(video) {
  if (video.playlists.length > 0) {
    const pl = playlists.find(p => p.id === video.playlists[0]);
    return pl ? pl.title : 'Teaching';
  }
  return 'Teaching';
}

// ========== RENDER ==========
function renderFeatured(video) {
  document.getElementById('featuredImg').src = video.thumb;
  document.getElementById('featuredImg').alt = video.title;
  document.getElementById('heroBg').style.backgroundImage = `url(${video.thumb})`;
  document.getElementById('featuredTitle').textContent = video.title;
  document.getElementById('featuredDesc').textContent = video.desc.split('\n').slice(0,3).join(' ').slice(0,300);
  document.getElementById('featuredDate').textContent = formatDate(video.date);
  document.getElementById('featuredThumb').onclick = () => openLightbox(video.id);
}

function createVideoCard(video) {
  const row = document.createElement('div');
  row.className = 'video-row';
  row.innerHTML = `
    <div class="row-play"></div>
    <span class="row-title">${video.title}</span>
    <span class="row-tag">${getVideoTag(video)}</span>
    <span class="row-date">${formatDate(video.date)}</span>
  `;
  row.addEventListener('click', () => openLightbox(video.id));
  requestAnimationFrame(() => {
    setTimeout(() => row.classList.add('revealed'), 50);
  });
  return row;
}

window.renderNextBatch = function() {
  const grid = document.getElementById('videoGrid');
  const end = Math.min(renderedCount + BATCH_SIZE, filteredVideos.length);
  for (let i = renderedCount; i < end; i++) {
    const card = createVideoCard(filteredVideos[i]);
    grid.appendChild(card);
    setTimeout(() => card.classList.add('revealed'), (i - renderedCount) * 60);
  }
  renderedCount = end;
  updateLoadMore();
};

function updateLoadMore() {
  const btn = document.getElementById('loadMoreBtn');
  const spinner = document.getElementById('loadingSpinner');
  spinner.style.display = 'none';
  if (renderedCount < filteredVideos.length) {
    btn.style.display = 'inline-flex';
    btn.textContent = `Load More (${filteredVideos.length - renderedCount} remaining)`;
  } else {
    btn.style.display = 'none';
  }
}

function applyFilters() {
  searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
  filteredVideos = allVideos.filter(v => {
    const matchPlaylist = activePlaylist === 'all' || v.playlists.includes(activePlaylist);
    const matchSearch = !searchTerm || v.title.toLowerCase().includes(searchTerm) || v.desc.toLowerCase().includes(searchTerm);
    return matchPlaylist && matchSearch;
  });
  const grid = document.getElementById('videoGrid');
  grid.innerHTML = '';
  renderedCount = 0;
  document.getElementById('searchCount').textContent =
    filteredVideos.length === allVideos.length
      ? `${allVideos.length} teachings`
      : `${filteredVideos.length} of ${allVideos.length} teachings`;
  document.getElementById('noResults').style.display = filteredVideos.length === 0 ? 'block' : 'none';
  if (filteredVideos.length > 0) renderNextBatch();
  else updateLoadMore();
}

window.openLightbox = function(videoId) {
  const lb = document.getElementById('lightbox');
  document.getElementById('lightboxIframe').src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
};

window.closeLightbox = function() {
  const lb = document.getElementById('lightbox');
  lb.classList.remove('open');
  document.getElementById('lightboxIframe').src = '';
  document.body.style.overflowY = '';
};

document.getElementById('lightbox').addEventListener('click', function(e) {
  if (e.target === this) closeLightbox();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

// ========== INIT ==========
async function init() {
  document.getElementById('loadingSpinner').style.display = 'block';

  // Fetch playlists, videos, live stream, and stats in parallel
  const [playlistData, liveStream, videos] = await Promise.all([
    fetchPlaylists(),
    checkLiveStream(),
    fetchAllVideos()
  ]);
  fetchChannelStats();

  playlists = playlistData;
  await enrichVideoFormat(videos);
  const stwHidden = videos.filter(v => !stwNotShort(v)).length;
  if (stwHidden) console.log('[STW] hiding ' + stwHidden + ' YouTube Shorts (vertical and <= 3 min)');
  allVideos = videos.filter(stwNotShort);

  // Fetch video IDs for each playlist (in parallel)
  await Promise.all(playlists.map(pl => fetchPlaylistVideoIds(pl)));

  // Assign playlist memberships to each video
  assignPlaylistsToVideos();

  // Build filter buttons from playlist names
  buildFilterButtons();

  // Render featured
  if (liveStream) {
    renderLiveFeatured(liveStream);
  } else {
    const featured = stwFeaturedPick(allVideos);
    if (featured) renderFeatured(featured);
  }

  filteredVideos = [...allVideos];
  document.getElementById('searchCount').textContent = `${allVideos.length} teachings`;
  renderNextBatch();

  // Search listener
  let searchTimer;
  document.getElementById('searchInput').addEventListener('input', () => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(applyFilters, 250);
  });
}

init();

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.15, rootMargin: '-40px' });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

})();
</script>
