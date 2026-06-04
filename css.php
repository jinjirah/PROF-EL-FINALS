<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --bg-overlay: rgba(14, 12, 15, 0.82);
        --nav-bg: linear-gradient(180deg, #320608 0%, #1a0203 100%);
        --accent-gold: #ffc107;
        --accent-glow: rgba(255, 193, 7, 0.3);
        --text-main: #ffffff;
        --text-muted: #b5b3bc;
        --border-subtle: rgba(255, 255, 255, 0.08);
        --card-radius: 16px;
        --input-radius: 10px;
    }

    body {
        background: linear-gradient(var(--bg-overlay), var(--bg-overlay)), 
                    url('images/radiator_springs_bg.jpg') no-repeat center top fixed;
        background-size: cover;
        color: var(--text-main);
        font-family: 'Plus Jakarta Sans', sans-serif;
        min-height: 100vh;
        letter-spacing: -0.01em;
    }

    
    .custom-navbar {
        background: var(--nav-bg) !important;
        border-bottom: 2px solid #4a0a0d;
        padding: 12px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
    }
    .navbar-brand img {
        height: 38px;
        width: auto;
    }
    .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 6px 0 !important;
        margin: 0 14px;
        position: relative;
        transition: color 0.2s ease;
    }
    .nav-link:hover {
        color: var(--text-main) !important;
    }
    .nav-link.active {
        color: var(--accent-gold) !important;
        font-weight: 600;
    }
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: var(--accent-gold);
    }

    .hero-banner {
        width: 100%;
        max-height: 380px;
        overflow: hidden;
        border-bottom: 1px solid var(--border-subtle);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        margin-bottom: 40px;
    }
    .hero-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }


    .showcase-title {
        color: var(--accent-gold);
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 6px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .showcase-subtitle {
        color: #e5e7eb;
        font-size: 1.05rem;
        font-weight: 400;
        margin-bottom: 25px;
        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    }
    .center-showcase-card {
        background: transparent;
        border: none;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.7);
        margin-bottom: 40px;
    }
    .center-showcase-card img {
        width: 100%;
        border-radius: var(--card-radius);
        display: block;
    }

   
    .display-card {
        background-color: rgba(20, 18, 24, 0.75);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--border-subtle);
        border-radius: var(--card-radius);
        transition: transform 0.25s ease, border-color 0.25s ease;
    }
    .display-card:hover {
        transform: translateY(-4px);
        border-color: rgba(255, 193, 7, 0.3);
    }
    .card-meta {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--accent-gold);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .card-heading {
        font-weight: 700;
        color: var(--text-main);
    }

    
    .form-control, .form-select {
        background-color: rgba(18, 14, 14, 0.85);
        border: 1px solid var(--border-subtle);
        color: var(--text-main);
        border-radius: var(--input-radius);
        padding: 10px 14px;
    }
    .form-control:focus, .form-select:focus {
        background-color: #131216;
        border-color: var(--accent-gold);
        color: var(--text-main);
        box-shadow: 0 0 0 4px var(--accent-glow);
    }
    .btn-primary-action {
        background-color: #9e1c20;
        color: #ffffff;
        font-weight: 600;
        border-radius: var(--input-radius);
        padding: 9px 20px;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-primary-action:hover {
        background-color: #bd2429;
        color: #ffffff;
    }
    .btn-action-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(255,255,255,0.05);
        color: var(--text-muted);
        border: 1px solid var(--border-subtle);
    }
    .btn-action-icon:hover {
        color: var(--text-main);
        background: rgba(255,255,255,0.1);
    }
</style>