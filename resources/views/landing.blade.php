@extends('layout.layout')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --dark: #0f0f1a;
        --navy: #1a1a2e;
        --accent: #e63946;
        --gold: #f4a261;
        --light: #f8f9fa;
        --muted: #6c757d;
    }

    .landing-page {
        font-family: 'DM Sans', sans-serif;
        background: var(--light);
        overflow-x: hidden;
    }

    /* ====== HERO ====== */
    .hero {
        min-height: 92vh;
        background: var(--dark);
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    /* Animated background dots */
    .hero:before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        animation: bgMove 20s linear infinite;
    }

    @keyframes bgMove {
        0% { transform: translate(0,0); }
        100% { transform: translate(40px, 40px); }
    }

    /* Glowing orbs */
    .hero:after {
        content: '';
        position: absolute;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(230,57,70,0.15) 0%, transparent 70%);
        top: -100px; right: -100px;
        border-radius: 50%;
        animation: pulse 4s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.7; }
        50% { transform: scale(1.1); opacity: 1; }
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(244,162,97,0.15);
        border: 1px solid rgba(244,162,97,0.3);
        color: var(--gold);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 24px;
        animation: fadeInUp 0.6s ease both;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 68px;
        font-weight: 900;
        color: #fff;
        line-height: 1.05;
        margin-bottom: 24px;
        animation: fadeInUp 0.6s ease 0.1s both;
    }

    .hero-title span {
        color: var(--accent);
        position: relative;
    }

    .hero-title span:after {
        content: '';
        position: absolute;
        bottom: 2px; left: 0;
        width: 100%; height: 3px;
        background: var(--accent);
        border-radius: 2px;
    }

    .hero-subtitle {
        font-size: 18px;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        margin-bottom: 40px;
        font-weight: 300;
        animation: fadeInUp 0.6s ease 0.2s both;
    }

    .hero-buttons {
        display: flex;
        gap: 16px;
        animation: fadeInUp 0.6s ease 0.3s both;
    }

    .btn-primary-hero {
        background: var(--accent);
        color: #fff;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid var(--accent);
        letter-spacing: 0.3px;
    }

    .btn-primary-hero:hover {
        background: transparent;
        color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(230,57,70,0.3);
    }

    .btn-outline-hero {
        background: transparent;
        color: #fff;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        border: 2px solid rgba(255,255,255,0.3);
        transition: all 0.3s ease;
    }

    .btn-outline-hero:hover {
        border-color: #fff;
        background: rgba(255,255,255,0.08);
        transform: translateY(-2px);
    }

    /* Hero right - floating cards */
    .hero-visual {
        position: relative;
        animation: fadeInRight 0.8s ease 0.2s both;
    }

    .floating-card {
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 16px;
        transition: transform 0.3s ease;
    }

    .floating-card:hover { transform: translateX(8px); }

    .floating-card:nth-child(2) {
        margin-left: 30px;
        animation: float 3s ease-in-out 0.5s infinite alternate;
    }

    .floating-card:nth-child(3) {
        animation: float 3s ease-in-out 1s infinite alternate;
    }

    @keyframes float {
        from { transform: translateY(0) translateX(0); }
        to { transform: translateY(-8px) translateX(5px); }
    }

    .card-user {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .card-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--gold));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .card-name { color: #fff; font-size: 14px; font-weight: 500; }
    .card-time { color: rgba(255,255,255,0.4); font-size: 12px; }
    .card-text { color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.5; }

    .card-likes {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        color: var(--accent);
        font-size: 13px;
    }

    /* ====== STATS ====== */
    .stats-section {
        background: var(--navy);
        padding: 50px 0;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        text-align: center;
    }

    .stat-item h3 {
        font-family: 'Playfair Display', serif;
        font-size: 48px;
        color: var(--accent);
        margin-bottom: 6px;
    }

    .stat-item p {
        color: rgba(255,255,255,0.5);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ====== FEATURES ====== */
    .features-section {
        padding: 100px 0;
        background: #fff;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .section-label {
        display: inline-block;
        color: var(--accent);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 46px;
        color: var(--dark);
        margin-bottom: 60px;
        line-height: 1.2;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
    }

    .feature-card {
        padding: 36px 32px;
        border-radius: 16px;
        border: 1px solid #eee;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card:before {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 100%; height: 3px;
        background: var(--accent);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        border-color: transparent;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        transform: translateY(-4px);
    }

    .feature-card:hover:before { transform: scaleX(1); }

    .feature-icon {
        width: 52px; height: 52px;
        background: rgba(230,57,70,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .feature-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .feature-card p {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
    }

    /* ====== CTA ====== */
    .cta-section {
        background: var(--dark);
        padding: 100px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section:before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(230,57,70,0.1) 0%, transparent 70%);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
    }

    .cta-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        color: #fff;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .cta-section p {
        color: rgba(255,255,255,0.5);
        font-size: 18px;
        margin-bottom: 40px;
        position: relative;
        z-index: 1;
    }

    .cta-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<div class="landing-page">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-left">
                <div class="hero-badge">
                    💡 Share • Like • Connect
                </div>
                <h1 class="hero-title">
                    Your <span>Ideas</span><br>Matter
                </h1>
                <p class="hero-subtitle">
                    A platform where curious minds share thoughts,<br>
                    spark conversations, and inspire each other daily.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn-primary-hero">Get Started Free</a>
                    <a href="{{ route('login') }}" class="btn-outline-hero">Sign In</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="floating-card">
                    <div class="card-user">
                        <div class="card-avatar">😊</div>
                        <div>
                            <div class="card-name">Anand Kumar</div>
                            <div class="card-time">2 min ago</div>
                        </div>
                    </div>
                    <div class="card-text">AI will change the way we learn forever. Education needs to evolve now.</div>
                    <div class="card-likes">❤️ 24 likes</div>
                </div>

                <div class="floating-card">
                    <div class="card-user">
                        <div class="card-avatar">🚀</div>
                        <div>
                            <div class="card-name">Amit Yadav</div>
                            <div class="card-time">5 min ago</div>
                        </div>
                    </div>
                    <div class="card-text">Small consistent actions beat big occasional efforts every single time.</div>
                    <div class="card-likes">❤️ 18 likes</div>
                </div>

                <div class="floating-card">
                    <div class="card-user">
                        <div class="card-avatar">✨</div>
                        <div>
                            <div class="card-name">Priya Singh</div>
                            <div class="card-time">12 min ago</div>
                        </div>
                    </div>
                    <div class="card-text">The best ideas come when you stop trying too hard to think.</div>
                    <div class="card-likes">❤️ 31 likes</div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Ideas Shared</p>
            </div>
            <div class="stat-item">
                <h3>100+</h3>
                <p>Active Users</p>
            </div>
            <div class="stat-item">
                <h3>1000+</h3>
                <p>Likes Given</p>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features-section">
        <div class="section-container">
            <span class="section-label">Why Ideas App?</span>
            <h2 class="section-title">Everything you need<br>to share your mind</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">💡</div>
                    <h3>Share Ideas</h3>
                    <p>Post your thoughts, insights, and ideas instantly. No filters, no algorithms — just pure expression.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">❤️</div>
                    <h3>Like & Engage</h3>
                    <p>Show appreciation with a heart. Watch your ideas get noticed and inspire others in real time.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Follow People</h3>
                    <p>Connect with like-minded thinkers. Follow people who inspire you and build your network.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⭐</div>
                    <h3>Give Feedback</h3>
                    <p>Share honest feedback and help improve the community. Every voice counts here.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure & Private</h3>
                    <p>Your account is protected. Login safely and share ideas with complete peace of mind.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌐</div>
                    <h3>Always Free</h3>
                    <p>No subscriptions, no hidden fees. Ideas App is completely free — forever.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <h2>Ready to share your idea?</h2>
        <p>Join hundreds of thinkers already on Ideas App</p>
        <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn-primary-hero">Create Free Account</a>
            <a href="{{ route('login') }}" class="btn-outline-hero">I have an account</a>
        </div>
    </section>

</div>

@endsection