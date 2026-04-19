<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Library App' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <style>
        :root {
            --bg: #f5efe4;
            --paper: rgba(255, 251, 245, 0.8);
            --surface: #fffaf2;
            --surface-strong: #fffdf8;
            --sidebar-width: 18.75rem;
            --sidebar-collapsed-width: 5.25rem;
            --layout-gutter: clamp(1rem, 2vw, 1.65rem);
            --content-offset: var(--sidebar-width);
            --content-inline-padding: var(--layout-gutter);
            --content-block-padding: 2rem;
            --header-offset: var(--sidebar-width);
            --header-inline-padding: var(--layout-gutter);
            --header-block-padding: 1rem;
            --topbar-radius: 24px;
            --topbar-padding-y: .85rem;
            --topbar-padding-x: 1rem;
            --ink: #182433;
            --muted: #6b7483;
            --line: rgba(24, 36, 51, 0.1);
            --brand: #143a52;
            --brand-2: #b98048;
            --brand-3: #e7d3bd;
            --danger: #b54343;
            --success: #2f6c5f;
            --shadow: 0 24px 60px rgba(24, 36, 51, 0.12);
            --shadow-soft: 0 12px 30px rgba(24, 36, 51, 0.08);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Manrope', sans-serif;
            overflow-x: hidden;
            line-height: 1.6;
            background:
                radial-gradient(circle at top left, rgba(185, 128, 72, 0.22), transparent 28%),
                radial-gradient(circle at right 20%, rgba(20, 58, 82, 0.12), transparent 32%),
                linear-gradient(180deg, #fbf6ef 0%, #f2ebdf 100%);
            color: var(--ink);
        }

        h1, h2, h3, h4, .brand-display, .headline-serif {
            font-family: 'Cormorant Garamond', serif;
            letter-spacing: -0.02em;
        }

        .wrapper,
        .content-wrapper,
        .main-footer,
        .main-header {
            background: transparent;
        }

        .main-header {
            border-bottom: 0;
            margin-left: var(--header-offset) !important;
            width: calc(100% - var(--header-offset));
            max-width: calc(100% - var(--header-offset));
            padding: var(--header-block-padding) var(--header-inline-padding) 0;
            background: transparent;
            position: relative;
            z-index: 1030;
            transition: margin-left .2s ease-in-out, width .2s ease-in-out, max-width .2s ease-in-out, padding .2s ease-in-out;
        }

        .main-header .navbar {
            border-radius: var(--topbar-radius);
            min-height: 4.35rem;
        }

        .navbar-white.navbar-light {
            background: rgba(255, 250, 242, 0.72);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow: var(--shadow-soft);
            padding: var(--topbar-padding-y) var(--topbar-padding-x);
        }

        .topbar-toggle {
            width: 2.9rem;
            height: 2.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            color: var(--brand);
            background: rgba(20, 58, 82, 0.06);
            transition: background-color .2s ease, transform .2s ease, color .2s ease;
        }

        .topbar-toggle:hover,
        .topbar-toggle:focus {
            background: rgba(20, 58, 82, 0.12);
            color: #102d40;
        }

        .topbar-actions {
            gap: .8rem;
        }

        .topbar-actions .nav-item {
            display: flex;
            align-items: center;
        }

        .topbar-logout .btn {
            min-width: 0;
            padding: .72rem 1.05rem;
            white-space: nowrap;
        }

        .main-sidebar {
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width) !important;
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(14, 30, 45, 0.96), rgba(19, 43, 64, 0.92)),
                linear-gradient(135deg, rgba(185, 128, 72, 0.35), transparent 45%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 18px 0 42px rgba(10, 18, 28, 0.18);
            z-index: 1038;
            transition: width .2s ease-in-out, min-width .2s ease-in-out, max-width .2s ease-in-out, transform .2s ease-in-out, margin-left .2s ease-in-out;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: .9rem;
            position: relative;
            border-bottom: 0;
            margin-bottom: 0;
            padding: 1.35rem 1.35rem 1.1rem;
            min-height: auto;
        }

        .brand-link::after {
            content: '';
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 0;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,.06), rgba(255,255,255,.16), rgba(255,255,255,.06));
        }

        .brand-symbol {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(185, 128, 72, .95), rgba(255, 220, 175, .75));
            color: #172332;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.35);
            flex-shrink: 0;
        }

        .brand-copy {
            display: inline-flex;
            flex-direction: column;
            line-height: 1.05;
            min-width: 0;
            transition: opacity .18s ease, transform .18s ease;
        }

        .brand-copy small {
            font-family: 'Manrope', sans-serif;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .2em;
            color: rgba(255,255,255,.55);
            margin-bottom: .25rem;
        }

        .brand-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #fff7ef;
        }

        .main-sidebar > .sidebar {
            flex: 1 1 auto;
            min-height: 0;
            padding: 1rem .9rem 1.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            margin-top: .35rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.16) transparent;
        }

        .main-sidebar > .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .main-sidebar > .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.16);
            border-radius: 999px;
        }

        .sidebar-section-label {
            padding: 0 .8rem .8rem;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: rgba(255,255,255,.5);
            transition: opacity .18s ease, transform .18s ease;
        }

        .nav-sidebar {
            gap: .35rem;
        }

        .nav-sidebar > .nav-item {
            position: relative;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: .85rem;
            border-radius: 18px;
            margin-bottom: 0;
            color: rgba(245, 242, 238, .76);
            padding: .92rem 1rem;
            min-height: 3.5rem;
            transition: color .22s ease, background-color .22s ease, box-shadow .22s ease, transform .22s ease;
        }

        .sidebar .nav-link .nav-icon {
            width: 1.15rem;
            margin-right: 0;
            color: rgba(255,255,255,.55);
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar .nav-link p {
            margin: 0;
            min-width: 0;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar .nav-link .right {
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, rgba(57, 69, 84, .96), rgba(46, 58, 74, .98));
            color: #fffdf8;
            transform: translateX(3px);
            box-shadow:
                0 14px 28px rgba(10, 18, 28, .14),
                inset 0 0 0 1px rgba(255,255,255,.08),
                inset 0 1px 0 rgba(255,255,255,.04);
        }

        .sidebar .nav-link:hover .nav-icon,
        .sidebar .nav-link.active .nav-icon {
            color: #ffdbb4;
        }

        .sidebar .nav-link.active {
            border: 1px solid rgba(255,255,255,.08);
        }

        body.sidebar-collapse .main-sidebar {
            width: var(--sidebar-collapsed-width) !important;
            min-width: var(--sidebar-collapsed-width);
            max-width: var(--sidebar-collapsed-width);
        }

        body.sidebar-collapse .brand-link {
            justify-content: center;
            padding-left: .85rem;
            padding-right: .85rem;
        }

        body.sidebar-collapse .brand-symbol {
            margin: 0;
        }

        body.sidebar-collapse .brand-copy,
        body.sidebar-collapse .sidebar-section-label,
        body.sidebar-collapse .sidebar .nav-link p,
        body.sidebar-collapse .sidebar .nav-link .right {
            opacity: 0;
            transform: translateX(-6px);
            pointer-events: none;
        }

        body.sidebar-collapse .brand-copy,
        body.sidebar-collapse .sidebar-section-label {
            max-width: 0;
            overflow: hidden;
        }

        body.sidebar-collapse .sidebar .nav-link {
            justify-content: center;
            padding-left: .9rem;
            padding-right: .9rem;
        }

        body.sidebar-collapse .sidebar .nav-link .nav-icon {
            margin: 0;
        }

        .content-wrapper {
            margin-left: var(--content-offset) !important;
            width: calc(100% - var(--content-offset));
            max-width: calc(100% - var(--content-offset));
            padding: 0 var(--content-inline-padding) var(--content-block-padding);
            min-height: 100vh !important;
            position: relative;
            z-index: 1;
            transition: margin-left .2s ease-in-out, padding .2s ease-in-out;
        }

        .content > .container-fluid > * + * {
            margin-top: 1.25rem;
        }

        .main-footer {
            padding-left: var(--layout-gutter);
            padding-right: var(--layout-gutter);
            position: relative;
            z-index: 1;
            transition: margin-left .2s ease-in-out, padding .2s ease-in-out;
        }

        body:not(.layout-top-nav) .main-header,
        body:not(.layout-top-nav) .main-footer {
            margin-left: var(--sidebar-width) !important;
        }

        body:not(.layout-top-nav) .main-header {
            margin-left: var(--header-offset) !important;
        }

        body:not(.layout-top-nav) .content-wrapper {
            margin-left: var(--content-offset) !important;
        }

        body.sidebar-collapse .main-sidebar {
            width: var(--sidebar-collapsed-width) !important;
        }

        body.sidebar-collapse .main-header,
        body.sidebar-collapse .main-footer {
            margin-left: var(--sidebar-collapsed-width) !important;
        }

        body.sidebar-collapse {
            --header-offset: var(--sidebar-collapsed-width);
            --content-offset: var(--sidebar-collapsed-width);
        }

        .sidebar-overlay {
            background: rgba(10, 18, 28, 0.34);
            backdrop-filter: blur(2px);
            z-index: 1037;
        }

        .content-header {
            padding: 1rem 0 1rem;
        }

        .page-header-shell {
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            padding: 2.15rem 2.15rem 2rem;
            background:
                radial-gradient(circle at top right, rgba(185, 128, 72, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(255, 252, 247, 0.96), rgba(252, 243, 229, 0.88));
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow: var(--shadow);
        }

        .page-header-shell::after {
            content: '';
            position: absolute;
            inset: auto -60px -90px auto;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(20, 58, 82, .12), transparent 70%);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            font-size: .72rem;
            letter-spacing: .22em;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--brand);
            margin-bottom: .75rem;
        }

        .eyebrow::before {
            content: '';
            width: 28px;
            height: 1px;
            background: rgba(20, 58, 82, .4);
        }

        .page-title {
            font-size: clamp(2.5rem, 3vw, 4.4rem);
            margin: 0;
            line-height: .9;
        }

        .page-description {
            max-width: 700px;
            font-size: 1.02rem;
            color: var(--muted);
            margin-top: .95rem;
            margin-bottom: 0;
        }

        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: .7rem;
            padding: .45rem .8rem .45rem .45rem;
            border-radius: 999px;
            background: rgba(20, 58, 82, .08);
            color: var(--brand);
            font-weight: 700;
        }

        .user-pill i {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand), #254e69);
            color: #fff;
        }

        .btn {
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: .01em;
            padding: .78rem 1.08rem;
            border: 0;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease, opacity .2s ease;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn:focus-visible,
        .form-control:focus-visible,
        .custom-select:focus-visible,
        select.form-control:focus-visible,
        .sidebar .nav-link:focus-visible {
            outline: 2px solid rgba(20, 58, 82, .28);
            outline-offset: 2px;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--brand), #2b5876);
            box-shadow: 0 10px 24px rgba(20, 58, 82, .24);
        }
        .btn-primary:hover { background: linear-gradient(135deg, #102d40, #23465e); }
        .btn-success {
            background: linear-gradient(135deg, #2f6c5f, #4b8b7c);
            box-shadow: 0 10px 24px rgba(47, 108, 95, .2);
        }
        .btn-warning {
            background: linear-gradient(135deg, #d7a45a, #f0c16d);
            color: #2f2415;
        }
        .btn-danger {
            background: linear-gradient(135deg, #994141, #c45d5d);
        }
        .btn-outline-danger {
            border: 1px solid rgba(181, 67, 67, .22);
            color: var(--danger);
            background: rgba(181, 67, 67, .06);
        }
        .btn-secondary {
            background: rgba(24, 36, 51, .08);
            color: var(--ink);
        }

        .alert {
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
            padding: 1rem 1.1rem;
        }
        .alert-success { background: rgba(47, 108, 95, .12); color: #1e4f45; }
        .alert-danger { background: rgba(181, 67, 67, .1); color: #7f2828; }

        .card,
        .surface-panel {
            border: 1px solid rgba(255, 255, 255, 0.78);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255,255,255,.78), rgba(255,249,241,.88));
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--line);
            padding: 1.35rem 1.5rem 1.05rem;
        }

        .card-title {
            font-weight: 800;
            color: var(--ink);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-lift:hover,
        .surface-panel:hover {
            transform: translateY(-2px);
            box-shadow: 0 28px 65px rgba(24, 36, 51, 0.13);
            border-color: rgba(255, 255, 255, 0.92);
        }

        .metric-card {
            position: relative;
            min-height: 220px;
            padding: 1.75rem;
            border-radius: 28px;
            overflow: hidden;
            color: #fff8ef;
            box-shadow: var(--shadow);
            transform: translateY(18px);
            opacity: 0;
            transition: opacity .7s cubic-bezier(.22, 1, .36, 1), transform .7s cubic-bezier(.22, 1, .36, 1), box-shadow .25s ease;
        }

        .metric-card::after {
            content: '';
            position: absolute;
            inset: auto -40px -50px auto;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,.2), transparent 65%);
        }

        .metric-card.books { background: linear-gradient(145deg, #153952, #284b65); }
        .metric-card.members { background: linear-gradient(145deg, #704c2d, #b98048); }
        .metric-card.requests { background: linear-gradient(145deg, #22493f, #3f796b); }
        .metric-card.library { background: linear-gradient(145deg, #432f4c, #7a4f7c); }

        .metric-label {
            font-size: .74rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            font-weight: 800;
            opacity: .72;
        }

        .metric-value {
            font-size: clamp(3.4rem, 4.5vw, 5rem);
            line-height: .9;
            margin: .8rem 0 .35rem;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
        }

        .metric-copy {
            max-width: 220px;
            font-size: .95rem;
            line-height: 1.6;
            opacity: .85;
            margin: 0;
        }

        .metric-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.35rem;
            opacity: .82;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 70px rgba(24, 36, 51, 0.18);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 1.2rem;
        }
        .dashboard-grid > *:nth-child(1) { grid-column: span 5; animation-delay: .05s; }
        .dashboard-grid > *:nth-child(2) { grid-column: span 4; animation-delay: .12s; }
        .dashboard-grid > *:nth-child(3) { grid-column: span 3; animation-delay: .19s; }
        .dashboard-grid > *:nth-child(4) { grid-column: span 12; }

        .editorial-panel {
            padding: 1.9rem;
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(260px, .7fr);
            gap: 1.5rem;
            align-items: end;
        }

        .editorial-panel h3 {
            font-size: 2.2rem;
            margin-bottom: .6rem;
        }

        .editorial-panel p {
            color: var(--muted);
            max-width: 630px;
            margin-bottom: 0;
            line-height: 1.8;
        }

        .editorial-meta {
            padding: 1.3rem 1.35rem;
            border-radius: 22px;
            background: rgba(20, 58, 82, 0.06);
            border: 1px solid rgba(20, 58, 82, 0.08);
        }

        .editorial-meta strong {
            display: block;
            font-size: .8rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--brand);
            margin-bottom: .5rem;
        }

        .form-group label {
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--brand);
            margin-bottom: .55rem;
        }

        .form-control,
        .custom-select,
        select.form-control {
            height: auto;
            border-radius: 16px;
            padding: .92rem 1rem;
            border: 1px solid rgba(20, 58, 82, .12);
            background: rgba(255, 255, 255, .82);
            color: var(--ink);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.35);
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        textarea.form-control {
            min-height: 128px;
        }

        .form-control:focus,
        .custom-select:focus,
        select.form-control:focus {
            border-color: rgba(20, 58, 82, .3);
            box-shadow: 0 0 0 .2rem rgba(20, 58, 82, .08);
        }

        .table {
            color: var(--ink);
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 1px solid var(--line);
            border-top: 0;
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 1.05rem .95rem;
        }

        .table td {
            vertical-align: middle;
            border-top: 1px solid rgba(24, 36, 51, .06);
            padding: 1rem .95rem;
        }

        .table-bordered {
            border: 0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(255,255,255,.28);
        }

        .table tbody tr {
            transition: background-color .2s ease, transform .2s ease;
        }

        .table tbody tr:hover {
            background: rgba(20, 58, 82, .04);
        }

        .badge {
            padding: .55rem .8rem;
            border-radius: 999px;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1.1rem;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 12px;
            border: 1px solid rgba(20, 58, 82, .12);
            background: rgba(255,255,255,.8);
            padding: .4rem .7rem;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 1rem;
            color: var(--muted);
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: .8rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 12px !important;
            border: 0 !important;
            margin: 0 .15rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, var(--brand), #23465e) !important;
            color: #fff !important;
        }

        .surface-kicker {
            font-size: .78rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--brand);
            margin-bottom: .7rem;
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .8rem;
        }

        .quick-actions .btn {
            min-width: 170px;
        }

        .reveal-up {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .65s cubic-bezier(.22, 1, .36, 1), transform .65s cubic-bezier(.22, 1, .36, 1);
        }

        .reveal-delay-1 { transition-delay: .08s; }
        .reveal-delay-2 { transition-delay: .16s; }
        .reveal-delay-3 { transition-delay: .24s; }

        .reveal-up.in-view,
        .metric-card.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .data-surface .card-header {
            padding-bottom: 1.15rem;
        }

        .data-surface .card-body {
            padding-top: 1.3rem;
        }

        .card-header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .8rem;
            align-items: center;
            justify-content: space-between;
        }

        .card-header-copy {
            display: grid;
            gap: .4rem;
        }

        .card-description {
            margin: 0;
            color: var(--muted);
            max-width: 650px;
            font-size: .95rem;
            line-height: 1.75;
        }

        .table-shell {
            overflow: hidden;
            border-radius: 22px;
            border: 1px solid rgba(20, 58, 82, .08);
            background: rgba(255,255,255,.36);
            -webkit-overflow-scrolling: touch;
        }

        .table-shell .table {
            min-width: 42rem;
        }

        .table-shell .table.table-wide {
            min-width: 56rem;
        }

        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            align-items: center;
        }

        .table-actions .btn {
            margin-bottom: 0;
            min-width: 5.2rem;
            padding: .62rem .9rem;
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            .reveal-up,
            .metric-card {
                opacity: 1 !important;
                transform: none !important;
            }
        }

        @media (max-width: 991.98px) {
            :root {
                --header-offset: 0px;
                --header-inline-padding: 0px;
                --header-block-padding: 0px;
                --content-offset: 0px;
                --content-inline-padding: 0px;
                --topbar-radius: 0px;
                --topbar-padding-y: .8rem;
                --topbar-padding-x: 1rem;
            }

            body.sidebar-collapse {
                --header-offset: 0px;
                --content-offset: 0px;
            }

            .main-header {
                margin-left: 0 !important;
                width: 100%;
                max-width: 100%;
                padding: 0 !important;
            }

            .main-footer {
                margin-left: 0 !important;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .content-wrapper {
                margin-left: 0 !important;
                width: 100%;
                max-width: 100%;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            body:not(.layout-top-nav) .main-header,
            body:not(.layout-top-nav) .content-wrapper,
            body.sidebar-collapse .main-header,
            body.sidebar-collapse .content-wrapper {
                margin-left: 0 !important;
                width: 100%;
                max-width: 100%;
            }

            .main-header .navbar {
                min-height: 4rem;
                border-left: 0;
                border-right: 0;
                border-top: 0;
            }

            .main-sidebar {
                width: min(var(--sidebar-width), calc(100vw - 1.25rem)) !important;
                min-width: min(var(--sidebar-width), calc(100vw - 1.25rem));
                max-width: min(var(--sidebar-width), calc(100vw - 1.25rem));
                transform: translateX(-100%);
                margin-left: 0 !important;
                box-shadow: 24px 0 56px rgba(10, 18, 28, 0.26);
            }

            body.sidebar-open .main-sidebar {
                transform: translateX(0);
            }

            body.sidebar-collapse .main-sidebar {
                width: min(var(--sidebar-width), calc(100vw - 1.25rem)) !important;
                min-width: min(var(--sidebar-width), calc(100vw - 1.25rem));
                max-width: min(var(--sidebar-width), calc(100vw - 1.25rem));
            }

            body.sidebar-collapse .brand-copy,
            body.sidebar-collapse .sidebar-section-label,
            body.sidebar-collapse .sidebar .nav-link p,
            body.sidebar-collapse .sidebar .nav-link .right {
                opacity: 1;
                max-width: none;
                overflow: visible;
                transform: none;
                pointer-events: auto;
            }

            body.sidebar-collapse .brand-link,
            body.sidebar-collapse .sidebar .nav-link {
                justify-content: flex-start;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            body.sidebar-collapse .brand-symbol,
            body.sidebar-collapse .sidebar .nav-link .nav-icon {
                margin-right: 0;
            }

            .page-header-shell {
                padding: 1.55rem;
                border-radius: 24px;
            }

            .dashboard-grid,
            .editorial-panel {
                display: block;
            }

            .dashboard-grid > * {
                margin-bottom: 1rem;
            }

            .metric-card {
                min-height: 180px;
                padding: 1.45rem;
            }
        }

        @media (max-width: 767.98px) {
            .navbar-white.navbar-light {
                padding: .7rem .85rem;
                box-shadow: 0 12px 28px rgba(24, 36, 51, 0.1);
            }

            .topbar-toggle {
                width: 2.65rem;
                height: 2.65rem;
                border-radius: 12px;
            }

            .topbar-actions {
                gap: .55rem;
            }

            .topbar-logout .btn {
                padding: .68rem .95rem;
                border-radius: 14px;
            }

            .page-header-shell {
                padding: 1.35rem;
                border-radius: 22px;
            }

            .page-header-shell::after {
                width: 170px;
                height: 170px;
                inset: auto -35px -65px auto;
            }

            .eyebrow {
                font-size: .68rem;
                letter-spacing: .18em;
                margin-bottom: .65rem;
            }

            .page-title {
                font-size: clamp(2.1rem, 9vw, 3rem);
                line-height: .94;
            }

            .page-description {
                font-size: .95rem;
                line-height: 1.65;
                margin-top: .7rem;
            }

            .content-header {
                padding-top: .7rem;
                padding-bottom: .8rem;
            }

            .card,
            .surface-panel {
                border-radius: 24px;
            }

            .card-header,
            .card-body,
            .editorial-panel,
            .editorial-meta {
                padding-left: 1.2rem;
                padding-right: 1.2rem;
            }

            .card-header {
                padding-top: 1.15rem;
                padding-bottom: .9rem;
            }

            .card-body {
                padding-top: 1.2rem;
                padding-bottom: 1.2rem;
            }

            .card-header-actions {
                display: grid;
                gap: .9rem;
                justify-content: stretch;
            }

            .card-header-actions > .btn {
                width: 100%;
            }

            .card-description {
                max-width: none;
                font-size: .92rem;
                line-height: 1.65;
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .dashboard-grid > *:nth-child(1),
            .dashboard-grid > *:nth-child(2),
            .dashboard-grid > *:nth-child(3),
            .dashboard-grid > *:nth-child(4) {
                grid-column: span 1;
            }

            .metric-card {
                min-height: 0;
                padding: 1.3rem;
            }

            .metric-value {
                font-size: clamp(2.65rem, 12vw, 3.5rem);
            }

            .metric-copy {
                max-width: none;
                font-size: .92rem;
            }

            .metric-icon {
                top: 1.15rem;
                right: 1.15rem;
            }

            .editorial-panel {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1rem;
                align-items: stretch;
            }

            .editorial-panel h3 {
                font-size: 1.8rem;
                line-height: 1.02;
            }

            .editorial-panel p {
                max-width: none;
                font-size: .94rem;
                line-height: 1.75;
            }

            .editorial-meta {
                padding: 1rem;
                border-radius: 20px;
            }

            .quick-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .quick-actions .btn {
                width: 100%;
                min-width: 0;
            }

            .table-shell {
                overflow-x: auto;
                overflow-y: hidden;
                border-radius: 20px;
            }

            .table-shell .table {
                min-width: 34rem;
            }

            .table-shell .table.table-wide {
                min-width: 40rem;
            }

            .table thead th,
            .table td {
                padding: .82rem .8rem;
                white-space: nowrap;
            }

            .table-actions {
                min-width: 8.5rem;
            }

            .table-actions .btn {
                flex: 1 1 calc(50% - .25rem);
                min-width: 0;
            }

            .dataTables_wrapper .row {
                display: block;
                margin-left: 0;
                margin-right: 0;
            }

            .dataTables_wrapper .row > [class*='col-'] {
                max-width: none;
                padding-left: 0;
                padding-right: 0;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                text-align: left !important;
            }

            .dataTables_wrapper .dataTables_filter input,
            .dataTables_wrapper .dataTables_length select {
                display: block;
                width: 100%;
                margin-left: 0;
                margin-top: .4rem;
                min-height: 2.8rem;
            }

            .dataTables_wrapper .dataTables_paginate {
                display: flex;
                flex-wrap: wrap;
                gap: .35rem;
                justify-content: flex-start;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                margin: 0 !important;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                font-size: .74rem;
                letter-spacing: .1em;
            }

            .form-control,
            .custom-select,
            select.form-control {
                padding: .88rem .95rem;
                font-size: .96rem;
            }
        }

        @media (max-width: 575.98px) {
            .content-header {
                padding-top: .75rem;
            }

            .page-title {
                font-size: 2.35rem;
            }

            .btn {
                width: 100%;
                margin-bottom: .65rem;
            }

            .btn-group .btn,
            .btn-group-sm > .btn {
                width: auto;
                margin-bottom: 0;
            }

            .quick-actions {
                display: block;
            }

            .table-shell .table,
            .table-shell .table.table-wide {
                min-width: 100%;
            }

            .table thead th,
            .table td {
                white-space: normal;
            }

            .table-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .card-header-actions {
                display: block;
            }

            .card-header-actions .btn {
                margin-top: .9rem;
            }

            .card-body,
            .card-header,
            .editorial-panel,
            .editorial-meta {
                padding-left: 1.15rem;
                padding-right: 1.15rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link topbar-toggle" data-widget="pushmenu" href="#" role="button" aria-label="Toggle sidebar" aria-controls="app-sidebar"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto align-items-center topbar-actions">
            <li class="nav-item mr-3 d-none d-md-block">
                <div class="user-pill">
                    <i class="fas fa-user"></i>
                    <span>{{ auth('admin')->user()?->name ?? auth('member')->user()?->name }}</span>
                </div>
            </li>
            <li class="nav-item topbar-logout">
                @if(auth('admin')->check())
                    <form action="{{ route('admin.logout') }}" method="POST">
                @else
                    <form action="{{ route('member.logout') }}" method="POST">
                @endif
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar elevation-4" id="app-sidebar">
        <a href="{{ auth('admin')->check() ? route('admin.dashboard') : route('member.dashboard') }}" class="brand-link">
            <span class="brand-symbol"><i class="fas fa-book-open"></i></span>
            <span class="brand-copy">
                <small>Empora Library</small>
                <span class="brand-text">Archive</span>
            </span>
        </a>
        <div class="sidebar">
            <div class="sidebar-section-label">Workspace</div>
            <nav class="mt-2" aria-label="Sidebar navigation">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    @if(auth('admin')->check())
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Master Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index') }}" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.loan-requests.index') }}" class="nav-link {{ request()->routeIs('admin.loan-requests.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Pengajuan Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.loans.index') }}" class="nav-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Peminjaman Buku</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('member.dashboard') }}" class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.loan-requests.create') }}" class="nav-link {{ request()->routeIs('member.loan-requests.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>Ajukan Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.loans.index') }}" class="nav-link {{ request()->routeIs('member.loans.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book-reader"></i>
                                <p>List Peminjaman</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid px-0">
                <div class="page-header-shell reveal-up">
                    <div class="eyebrow">Library Workspace</div>
                    <h1 class="page-title">{{ $header ?? ($title ?? 'Library App') }}</h1>
                    <p class="page-description">
                        @yield('page_description', 'Kelola katalog, anggota, dan pengajuan peminjaman dalam satu workspace yang lebih rapi, cepat dibaca, dan nyaman dipresentasikan.')
                    </p>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid px-0">
                @if(session('success'))
                    <div class="alert alert-success reveal-up reveal-delay-1">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger reveal-up reveal-delay-1">
                        <ul class="mb-0 pl-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    function bindAjaxDelete(selector, tableSelector) {
        $(document).on('click', selector, function () {
            const url = $(this).data('url');
            const label = $(this).data('label') || 'data ini';

            if (!confirm(`Hapus ${label}?`)) {
                return;
            }

            $.ajax({
                url,
                type: 'DELETE',
                success: function (response) {
                    alert(response.message);
                    $(tableSelector).DataTable().ajax.reload(null, false);
                },
                error: function (xhr) {
                    alert(xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.');
                }
            });
        });
    }

    function initResponsiveDataTable(selector, config) {
        const options = {
            processing: true,
            serverSide: true,
            autoWidth: false,
            scrollX: true,
            ...config
        };

        const table = $(selector).DataTable(options);
        const mediaMobile = window.matchMedia('(max-width: 575.98px)');
        const mediaTablet = window.matchMedia('(max-width: 767.98px)');
        const responsiveColumns = config.responsiveColumns || {};

        function setColumnVisibility(indices, isVisible) {
            (indices || []).forEach(function (index) {
                if (table.column(index).visible() !== isVisible) {
                    table.column(index).visible(isVisible, false);
                }
            });
        }

        function applyResponsiveColumns() {
            const allTracked = Array.from(new Set([
                ...(responsiveColumns.mobile || []),
                ...(responsiveColumns.tablet || [])
            ]));

            setColumnVisibility(allTracked, true);

            if (mediaMobile.matches) {
                setColumnVisibility(allTracked, false);
                setColumnVisibility(responsiveColumns.mobileKeep || [], true);
            } else if (mediaTablet.matches) {
                setColumnVisibility(responsiveColumns.tablet || [], false);
            }

            table.columns.adjust().draw(false);
        }

        applyResponsiveColumns();

        const onResize = function () {
            applyResponsiveColumns();
        };

        if (typeof mediaMobile.addEventListener === 'function') {
            mediaMobile.addEventListener('change', onResize);
            mediaTablet.addEventListener('change', onResize);
        } else {
            mediaMobile.addListener(onResize);
            mediaTablet.addListener(onResize);
        }

        return table;
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.querySelectorAll('.reveal-up, .metric-card').forEach(function (element) {
                element.classList.add('in-view');
            });
            return;
        }

        const animatedElements = document.querySelectorAll('.reveal-up, .metric-card');
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        animatedElements.forEach(function (element) {
            observer.observe(element);
        });
    });
</script>
@stack('scripts')
</body>
</html>
