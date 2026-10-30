<div align="center">

<img src="web/img/ARXATEC.png" alt="ARXATEC logo" width="110">

# ARXATEC MVP

**Online legal advice: the 2024 MVP where ARXATEC started.**

[![Open the live demo](https://img.shields.io/badge/Live_demo-Open-3f3ab8?style=for-the-badge&logo=googlechrome&logoColor=white)](https://arxatec-engine.github.io/arxatec-mvp/)

![PHP 8](https://img.shields.io/badge/PHP-8-777BB4?logo=php&logoColor=white) ![MySQL / MariaDB](https://img.shields.io/badge/MySQL-MariaDB-003545?logo=mariadb&logoColor=white) ![Bootstrap 5](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?logo=javascript&logoColor=black) ![SQLite demo](https://img.shields.io/badge/Demo-SQLite_in_the_browser-003B57?logo=sqlite&logoColor=white) ![Archived MVP](https://img.shields.io/badge/Status-Archived_MVP-8a8f98) [![MIT License](https://img.shields.io/badge/License-MIT-2ea44f)](LICENSE)

</div>

<br>

![Login page of the live demo, with the demo panel open](docs/screenshots/login.png)

## 📖 The story

ARXATEC started in 2024 as this MVP: a platform where people could get legal advice online, book a video consultation with a lawyer or ask a question by message. The code is preserved exactly as it was written, as a record of the project's first steps.

## ✨ What it does

| | Role | Features |
| :---: | --- | --- |
| 🌐 | **Visitor** | Public website with services, plans, testimonials and team. Sign-up as a client. |
| 🙋 | **Client** | Requests video or message consultations, tracks their status and reviews past consultations. |
| ⚖️ | **Lawyer** | Screens for public and private consultations, meetings and incidents (designed, not yet connected to the database). |
| 🛡️ | **Admin** | Registers admins and lawyers, lists every user and manages their profile: photo, password and personal data. |

> [!NOTE]
> The interface is in Spanish, as it was for its users in Peru.

## 🖼️ Screenshots

<table>
  <tr>
    <td width="50%"><img src="docs/screenshots/public-website.png" alt="Public website"><p align="center"><sub>Public website</sub></p></td>
    <td width="50%"><img src="docs/screenshots/admin-dashboard.png" alt="Admin dashboard"><p align="center"><sub>Admin dashboard</sub></p></td>
  </tr>
  <tr>
    <td width="50%"><img src="docs/screenshots/client-video-calls.png" alt="Client video consultations"><p align="center"><sub>Client · video consultations</sub></p></td>
    <td width="50%"><img src="docs/screenshots/client-messages.png" alt="Client message consultations"><p align="center"><sub>Client · message consultations</sub></p></td>
  </tr>
</table>

## 🚀 Live demo

The demo runs entirely in the browser, with no server and no shared database.

| | |
| :---: | --- |
| 🧩 | **Same interface.** Every page is the HTML rendered by the original PHP app, with its own CSS, JavaScript and images. |
| 🗄️ | **SQLite in the browser.** A small runtime replaces the PHP backend and runs the same queries on [sql.js](https://sql.js.org). |
| 🔒 | **Private by design.** Data is saved in each visitor's browser (IndexedDB) and never leaves it. **Reset demo data** restores the initial state. |

**Demo accounts.** The **Demo** tab on the right edge of every page signs in with one click.

| Role | Email | Password |
| --- | --- | --- |
| 🛡️ Admin | `admin@gmail.com` | `admin` |
| 🙋 Client | `cliente@gmail.com` | `cliente` |
| ⚖️ Lawyer | `abogado@gmail.com` | `abogado` |

<details>
<summary><b>Differences from the original app</b></summary>

<br>

- The client's status and history pages include sample consultations so they are not empty.
- *Create plan* and the admin's *personal data* form save their changes; in the original app their handlers were never finished.
- Forms that post to scripts missing from the original app, such as the support form, show a notice instead of an error page.

</details>

## 🗂️ Project structure

```text
arxatec-mvp/
├── auth/          Login, registration and password recovery
├── projects/
│   ├── admin/     Admin panel
│   ├── customer/  Client panel
│   ├── lawyer/    Lawyer panel
│   └── shared/    Shared assets and profile images
├── web/           Public website
├── database/      mysqli connection and schema with seed data (sql.txt)
├── demo/          Static live demo: captured pages, SQLite runtime and build scripts
└── docker/        PHP + MariaDB environment used to capture the demo
```

> [!WARNING]
> This code is not meant for production: passwords are stored in plain text, some queries concatenate user input and a few forms point to scripts that were never written.

<details>
<summary><b>🛠️ Rebuilding the demo</b></summary>

<br>

Only needed after changing the PHP views. Requires Docker and Node.js 20+.

```bash
# 1. Capture the pages from a temporary copy of the app with a fresh database
cd docker
WEB_PORT=8092 DB_PORT=3308 docker compose -p arxatec-capture up -d --build db web
cd ..
node demo/capture.mjs http://localhost:8092
docker compose -f docker/docker-compose.yml -p arxatec-capture down -v

# 2. Build and preview at http://localhost:8095
node demo/build.mjs
node demo/serve.mjs
```

The **Deploy demo to GitHub Pages** workflow publishes `demo/dist` when started manually from the Actions tab.

</details>

## 👤 Author

<table>
  <tr>
    <td><img src="https://github.com/yemisparedez.png?size=160" alt="Yemis Paredez" width="72"></td>
    <td><b>Yemis Paredez</b><br>Designed and built ARXATEC MVP.<br>🔗 <a href="https://linktr.ee/yemis_paredez">linktr.ee/yemis_paredez</a></td>
  </tr>
</table>

## 📄 License

[MIT](LICENSE) © 2024 Yemis Paredez. The demo bundles [sql.js](https://github.com/sql-js/sql.js) (MIT); UI templates and images belong to their respective authors.
