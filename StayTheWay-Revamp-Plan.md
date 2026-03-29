# StayTheWay Digital Ministry Revamp — Master Plan

## Mission Alignment Check

**What StayTheWay IS:** A 501(c)(3) service ministry that equips believers to grow deeper in faith, build home-based Bible studies (Acts 2:42), become pillars in their communities, and bridge biblical wisdom to functional health.

**What StayTheWay is NOT:** An independent church competing for members. It serves ALL believers across denominations.

**Core Message:** *"Learn how to think, not what to think."*

---

## Current Site Audit — Key Findings

### What Exists (staytheway.com)
- WordPress + Divi theme (causes styling headaches, hard to inject code)
- Hero: "Helping You Grow Your Faith" — generic, doesn't communicate the unique mission
- Sunday Services embed, About Us (501c3), "Visiting" section with church photo
- Email signup + social links (Facebook, Instagram, YouTube)
- Pages: /armor/, /armor-quiz/, /quiz/, /video/, /blog/, /julia/
- No navigation menu (header hidden via CSS)
- No teaching repository or organized content library
- No donation system
- No resource downloads (handouts, guides)

### Problems
1. **Feels like a traditional church site** — doesn't reflect the "service to all believers" mission
2. **No content organization** — 304 YouTube videos with only 6 playlists (21 videos organized, 283 unorganized)
3. **No resource hub** — no handouts, study guides, quizzes, or downloadable materials in one place
4. **No way to give** — no donation integration at all
5. **No community connection** — no link to a private Facebook group for prayer/support
6. **Divi is fragile** — creates styling issues (white border bug), hard to maintain
7. **No clear user journey** — visitors don't know where to start or how to go deeper

---

## Platform Recommendation: Hybrid Approach

### Keep WordPress for:
- Domain authority (staytheway.com)
- Email signup / landing page
- Blog posts (if used)
- SEO presence

### Build the Teaching Hub on GitHub Pages:
- **URL:** weiszdev.github.io/StayTheWay/ (or custom subdomain: learn.staytheway.com)
- **Why:** Full design control, fast loading, no Divi headaches, easy to update via GitHub, free hosting
- **How:** Clean HTML/CSS/JS with Tailwind CSS for styling, YouTube embeds, organized by series/topic
- WordPress homepage links to the hub as the primary destination

---

## New Site Architecture

### Main Navigation
```
HOME  |  TEACHINGS  |  RESOURCES  |  QUIZZES  |  COMMUNITY  |  GIVE
```

### Page Structure

#### 1. HOME (index.html)
- Hero: Mission statement — "Equipping Believers to Grow Deep, Think Biblically, and Build Community"
- Quick links to latest teaching, featured series, getting started path
- "How It Works" section (Acts 2:42 model — study, fellowship, worship, prayer)
- Testimonials / community highlights
- Call to action: Join private Facebook group, subscribe to YouTube

#### 2. TEACHINGS (teachings.html)
- **The Crown Jewel** — organized video library
- Filter/search by: Series, Topic, Book of Bible, Date
- Suggested categories based on your 304 videos:
  - **Sunday Teachings** (chronological archive)
  - **Topical Series** (Armor of God, Marriage, Spiritual Warfare, End Times, etc.)
  - **Midweek Mashups** (shorter, discussion-style)
  - **Worship Sessions**
  - **Devotionals** (Grace Upon Grace marriage series, etc.)
  - **Functional Health & Faith** (the Bible-to-health bridge content)
- Each teaching card shows: thumbnail, title, duration, series tag, date
- Click opens a teaching detail page with: YouTube embed + related handout download + quiz link

#### 3. RESOURCES (resources.html)
- **Adult Handouts** — PDF downloads organized by teaching series
- **Children's Handouts** — age-appropriate materials for family studies
- **Study Guides** — multi-week study plans for home groups
- **How to Start a Home Bible Study** — step-by-step guide (Acts 2:42 model)
- **Recommended Reading** — books and resources for going deeper
- All downloadable as PDFs, organized in clean card grid

#### 4. QUIZZES (quizzes.html)
- Interactive quizzes tied to teaching series
- 7 Pillars of Freedom quiz (already built)
- Armor of God quiz (already built)
- Future quizzes for each major series
- Results page encourages sharing and deeper study

#### 5. COMMUNITY (community.html)
- Private Facebook Group link + what to expect
- How to start/join a home study group
- Prayer request connection
- Monthly community highlights
- Social media links (YouTube, Facebook, Instagram)

#### 6. GIVE (give.html)
- Clean, simple giving page
- Primary: **Zeffy** (100% free — zero fees, tax-deductible receipts)
- Secondary options: PayPal, Venmo, Cash App for familiarity
- Transparency section: "Where your gift goes"
- Tax info: 501(c)(3) status, EIN for receipts

---

## Donation Platform Recommendations

| Platform | Fees | Tax Receipts | Ease of Use | Best For |
|----------|------|-------------|-------------|----------|
| **Zeffy** | **$0 (100% free)** | Yes, automatic | Very easy | **Primary — RECOMMENDED** |
| Donorbox | 2.95% + processing | Yes | Easy | Alternative if Zeffy doesn't fit |
| PayPal | 2.89% + $0.49 | Manual | Very familiar | People who prefer PayPal |
| Venmo | 1.9% + $0.10 | No | Very familiar | Younger givers |
| Cash App | Free for personal | No | Very familiar | Quick/casual giving |

**Recommendation:** Use **Zeffy** as your primary giving platform (embed on the Give page). Add PayPal.me, Venmo, and Cash App links as alternatives. Zeffy handles tax-deductible receipts automatically and charges absolutely nothing.

---

## Design Direction

### Visual Identity
- **Dark theme** with warm accents (navy/charcoal base, gold/amber highlights)
- Clean, modern, content-focused — not "churchy"
- Professional but approachable — think Bible study meets knowledge platform
- Mobile-first responsive design
- StayTheWay logo + "The Word of God" tagline prominently featured

### UI Inspiration
- Content organization like a learning platform (Coursera/Udemy style cards)
- Video library like a curated Netflix-for-teachings
- Resource downloads clean and easy like a digital library

### Tech Stack
- **HTML5 + Tailwind CSS** (via CDN — no build tools needed)
- **Vanilla JavaScript** (search/filter, no frameworks)
- **YouTube embeds** (no API key needed for basic embeds)
- **GitHub Pages hosting** (free, fast, version controlled)
- **Zeffy embed** for donations
- **Google Fonts** (Inter for body, Playfair Display for headings)

---

## Content Organization Plan for YouTube

### Immediate Playlist Reorganization (304 videos → organized)
1. **Sunday Teachings** — all Sunday service recordings by year
2. **Armor of God Series** — related armor teachings
3. **Spiritual Warfare** — protection, spiritual war topics
4. **Marriage & Family** — devotionals, marriage series
5. **End Times & Prophecy** — eschatological teachings
6. **Midweek Studies** — midweek mashups and discussions
7. **Worship** — worship sessions (already exists, 10 videos)
8. **Topical Deep Dives** — standalone topic teachings
9. **Faith & Health** — the functional health bridge content
10. **Getting Started** — recommended first teachings for new viewers

---

## Facebook Strategy

### Private Group: "StayTheWay Community"
- **Purpose:** Prayer, encouragement, discussion, accountability
- **Rules:** No politics, no soliciting, grace-first communication
- **Features:** Weekly prayer thread, discussion questions tied to latest teaching, resource sharing
- **Link prominently** from website community page and video descriptions

---

## Implementation Phases

### Phase 1: Foundation (Week 1-2)
- Build core HTML templates (home, teachings, resources, quizzes, community, give)
- Set up GitHub repository and Pages hosting
- Configure Zeffy donation account
- Create Facebook private group

### Phase 2: Content Migration (Week 2-4)
- Reorganize YouTube playlists (10 categories)
- Populate teachings page with video embeds organized by series
- Upload existing handouts/PDFs to resources page
- Link existing quizzes

### Phase 3: Polish & Launch (Week 4-5)
- Mobile responsiveness testing
- Update WordPress homepage to redirect/link to new hub
- Add analytics (Google Analytics or Plausible)
- Social media announcement

### Phase 4: Ongoing Growth
- Add new teachings weekly
- Create study guides for each series
- Build more interactive quizzes
- Grow Facebook community
- Monthly email newsletter via existing WordPress signup

---

## Files to Build

1. `index.html` — Homepage
2. `teachings.html` — Video teaching library with search/filter
3. `resources.html` — Downloadable handouts and study materials
4. `quizzes.html` — Interactive quiz hub
5. `community.html` — Facebook group + home study guide
6. `give.html` — Donation page with Zeffy + alternatives
7. `styles.css` — Custom styles (supplement Tailwind)
8. `app.js` — Search, filter, and interactive functionality
9. `teaching-detail.html` — Template for individual teaching pages

---

*Plan created March 29, 2026 — StayTheWay Ministry Revamp*
