GREEN FIBER NET WEBSITE - ANDROID SETUP
======================================

Files:
- index.html: public mobile-friendly business website
- worker.js: Cloudflare Worker API
- schema.sql: D1 database table
- wrangler.toml: Worker config sample

Free architecture:
- GitHub: code repository
- Cloudflare Pages: public website hosting
- Cloudflare Workers + D1: backend/API + database

FRONTEND:
1) Cloudflare dashboard > Workers & Pages > Create > Pages > Connect to Git.
2) GitHub authorize karein aur green-fiber-net repository select karein.
3) Framework preset: None; Build command blank; Build output directory: / (root).
4) Save and Deploy. Cloudflare aapko *.pages.dev URL dega.

BACKEND:
1) Cloudflare dashboard > Workers & Pages > Create Worker.
2) worker.js ka code paste karke deploy karein.
3) Storage & Databases > D1 > Create database: green-fiber-net-db.
4) D1 Console mein schema.sql ka SQL run karein.
5) Worker > Settings > Bindings > Add D1 database:
   Variable name: DB
   Database: green-fiber-net-db
6) Worker ko redeploy karein.
7) Worker URL ke end par /api/health khol kar {"ok":true,...} check karein.
8) index.html mein API_BASE = "https://YOUR-WORKER.workers.dev" set karein.
9) Updated index.html GitHub par commit karein; Pages auto-deploy karega.

IMPORTANT BEFORE PUBLIC LAUNCH:
- Package speeds/prices abhi placeholders hain; apni actual list add karein.
- CORS "*" ko apne exact Pages domain tak restrict karein.
- Spam/rate limiting, privacy notice aur consent add karein.
- Starter mein abhi full customer login, admin dashboard ya payment gateway nahi hain.
- Online payments ke liye supported payment provider ka merchant account chahiye.
- Passwords, API keys ya database credentials kabhi index.html mein na rakhein.
