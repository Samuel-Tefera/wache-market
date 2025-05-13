<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wache-Market - Campus E-Commerce</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="#" class="logo">
                    <i class="fas fa-shopping-bag"></i>
                    Wache-Market
                </a>
            </div>
            <div class="nav-center">
                <ul class="nav-links">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <a href="pages/login.php" class="btn btn-outline">Login</a>
                <a href="pages/signup.php" class="btn">Sign Up</a>
            </div>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Buy & Sell Within Wachemo University</h1>
                <p>The campus marketplace connecting students and staff to trade books, electronics, clothing and more.
                </p>
                <div class="hero-buttons">
                    <a href="pages/signup.php" class="btn">Start Trading</a>
                    <a href="#features" class="btn btn-secondary">Learn More &downarrow;</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="assets/images/bg.png"
                    alt="Students on campus using smartphones">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Why Choose Wache-Market</h2>
            <p class="section-subtitle">The best platform for campus buying and selling</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Campus Community</h3>
                    <p>Buy and sell exclusively within the Wachemo University community of verified students and staff.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Safe Transactions</h3>
                    <p>Meet on campus for secure exchanges with verified university members.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h3>Dual Mode</h3>
                    <p>Switch between buyer and seller modes with just one click.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Quick Listings</h3>
                    <p>Sell items in minutes with our simple listing process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
        <div class="container">
            <h2 class="section-title">Trending on Campus</h2>
            <p class="section-subtitle">Popular items currently being traded</p>

            <div class="products-grid">
                <!-- Books -->
                <div class="product-card">
                    <div class="product-badge">Books</div>
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Textbooks" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Books</h3>
                        <div class="product-price">ETB 250 - 500</div>
                        <div class="product-meta">New, Used, Good Condition</div>
                    </div>
                </div>

                <!-- Electronics -->
                <div class="product-card">
                    <div class="product-badge">Electronics</div>
                    <img src="https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Laptop" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Electronics</h3>
                        <div class="product-price">ETB 8,000 - 15,000</div>
                        <div class="product-meta">Various Models Available</div>
                    </div>
                </div>

                <!-- Clothing -->
                <div class="product-card">
                    <div class="product-badge">Clothing</div>
                    <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Clothing" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Clothing</h3>
                        <div class="product-price">ETB 500 - 800</div>
                        <div class="product-meta">Official WU Merch</div>
                    </div>
                </div>

                <!-- Misc -->
                <div class="product-card">
                    <div class="product-badge">Other</div>
                    <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Dorm Items" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Dorm Essentials</h3>
                        <div class="product-price">ETB 200 - 1,500</div>
                        <div class="product-meta">Furniture, Kitchenware</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <h2 class="section-title">How Wache-Market Works</h2>
            <p class="section-subtitle">Get started in just 4 simple steps</p>

            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Create Your Account</h3>
                        <p>Sign up with your Wachemo University email to verify your status as student or staff.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Browse or List Items</h3>
                        <p>Search for items you need or easily list items you want to sell with photos and details.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Connect On Campus</h3>
                        <p>Message sellers/buyers and arrange to meet at safe campus locations for exchanges.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Switch Modes Anytime</h3>
                        <p>Toggle between buyer and seller modes with one click to buy or sell as needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Users Say</h2>
            <p class="section-subtitle">Hear from the Wachemo University community</p>

            <div class="testimonials-slider">
                <div class="testimonial active">
                    <img src="assets/images/person-img/henock.jpg" alt="Student"
                        class="testimonial-avatar">
                    <p class="testimonial-text">"Sold all my old textbooks in just 2 days! So much better than dealing
                        with bookstores."</p>
                    <h4 class="testimonial-author">Henock Negash</h4>
                    <p class="testimonial-role">3rd Year Computer Science</p>
                </div>

                <div class="testimonial">
                    <img src="assets/images/person-img/selam.jpg" alt="Student" class="testimonial-avatar">
                    <p class="testimonial-text">"Found the perfect laptop for my studies at half the price of a new one.
                        Lifesaver!"</p>
                    <h4 class="testimonial-author">Selam Abebe</h4>
                    <p class="testimonial-role">Graduate Student</p>
                </div>

                <div class="testimonial">
                    <img src="assets/images/person-img/dr-lemma.jpg" alt="Staff" class="testimonial-avatar">
                    <p class="testimonial-text">"As staff, I love being able to buy quality items from students and
                        support the campus economy."</p>
                    <h4 class="testimonial-author">Dr. Lemma Ababu</h4>
                    <p class="testimonial-role">Administrative Staff</p>
                </div>

                <div class="testimonial">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Student" class="testimonial-avatar">
                    <p class="testimonial-text">"Made ETB 3,500 last semester just selling things I wasn't using
                        anymore. Easy money!"</p>
                    <h4 class="testimonial-author">Yohannes Assefa</h4>
                    <p class="testimonial-role">2nd Year Business</p>
                </div>

                <div class="testimonial-nav">
                    <div class="testimonial-dot active" data-index="0"></div>
                    <div class="testimonial-dot" data-index="1"></div>
                    <div class="testimonial-dot" data-index="2"></div>
                    <div class="testimonial-dot" data-index="3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="cta">
        <div class="container">
            <h2>Join Wachemo's Marketplace Today</h2>
            <p>Connect with fellow students and staff to buy and sell campus essentials in a trusted community.</p>
            <div class="cta-buttons">
                <a href="pages/signup.php" class="btn">Sign Up Free</a>
                <a href="#features" class="btn btn-outline">Take a Tour</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Wache-Market</h3>
                    <p>The official marketplace of Wachemo University. Connecting students and staff to buy and sell
                        campus essentials.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul class="footer-links">
                        <li><a href="#">Textbooks</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Clothing</a></li>
                        <li><a href="#">Dorm Items</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt"></i> Wachemo University</li>
                        <li><i class="fas fa-envelope"></i> support@wache-market.com</li>
                        <li><i class="fas fa-phone"></i> +251 XXX XXX XXX</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Wache-Market. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms
                        of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>

</html>