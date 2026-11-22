
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Complete Point-of-Sale System</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1d1f !important;
            color: #dcddde;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: #23272a !important;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            border-right: 1px solid rgba(255,255,255,0.02);
            box-shadow: 4px 0 15px rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
            background-color: #1a1d1f !important;
        }

        .sidebar-brand {
            padding: 28px 24px;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            background-color: #1a1d1f;
            border-bottom: 1px solid #2d3236;
            color: #38bdf8 !important;
            text-align: center;
        }

        .sidebar-nav {
            margin-top: 20px;
            flex-grow: 1;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            color: #b9bbbe !important;
            text-decoration: none !important;
            padding: 14px 20px;
            margin: 6px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            border: 1px solid transparent;
        }

        .sidebar-link:hover {
            color: #ffffff !important;
            background-color: #2b3035 !important;
            border-color: rgba(0,188,212,0.15);
            transform: translateX(4px);
        }

        .pos-card {
            background: #23272a !important;
            border: 1px solid rgba(255,255,255,0.02);
            border-radius: 16px;
            box-shadow: 10px 10px 20px #111314,
                        -10px -10px 20px #2a2f33;
            padding: 30px;
            color: #ffffff !important;
        }

        .sidebar-footer-session {
            padding: 20px;
            background-color: #1a1d1f;
            border-top: 1px solid #2d3236;
            text-align: center;
        }

        .txt-staff-label {
            color: #8e9297;
            font-size: 13px;
            margin-bottom: 12px;
            display: block;
        }

        .txt-staff-user {
            color: #ffffff;
            font-weight: 700;
        }

        .btn-premium-logout {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            padding: 10px;
            background-color: #ff4500;
            color: #ffffff !important;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(255,69,0,0.25);
            transition: all 0.2s ease;
            border: none;
        }

        .btn-premium-logout:hover {
            background-color: #e03e00;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

@if(session('isLoggedIn'))
    <div class="sidebar">

        <div class="sidebar-brand">
            System Dashboard
        </div>

        <div class="sidebar-nav">
            <a class="sidebar-link" href="/">Dashboard Overview</a>
            <a class="sidebar-link" href="/products">Product Inventory</a>
            <a class="sidebar-link" href="/customers">Customer Directory</a>
            <a class="sidebar-link" href="/users">Staff Profiles</a>
            <a class="sidebar-link" href="/sales/record">Record New Sale</a>
            <a class="sidebar-link" href="/sales/history">Sales History Logs</a>
        </div>

        <div class="sidebar-footer-session">
            <span class="txt-staff-label">
                Staff Account:
                <strong class="txt-staff-user">
                    {{ session('username') }}
                </strong>
            </span>

            <a class="btn-premium-logout" href="/logout">
                Log Out Session
            </a>
        </div>

    </div>
@endif

<div class="{{ session('isLoggedIn') ? 'main-content' : 'container mt-5' }}">
