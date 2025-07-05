<?php
require_once '../includes/session_config.php';
require_once '../includes/config.php';

// Initialize session
initSession();

try {
    $con = getDBConnection();
} catch (Exception $e) {
    error_log($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Beauty of Skin</title>
    <link rel="stylesheet" href="stylee.css" />
</head>
<body>
<!-- Navbar -->
<header>
    <nav class="navbar">
        <div class="logo">VOGUE MART</div>
        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <!--<li><a href="about">About</a></li>
            <li><a href="#contact">Contact</a></li>-->
            <li><a href="signup.php">Sign up</a></li>
            <li><a href="userlogin.php">Login</a></li>
            <li><a href="../login.php">Admin</a></li>
            
        </ul>
        <div class="nav-search">
            <input type="text" placeholder="What are you looking for?" />
            <img src="search.png" alt="Search" />
        </div>
        <div class="nav-icons">
            
           <!-- <a href="Wishlist.html"> <li><img src="Wishlist.png" alt="Wishlist" /></li></a>
            <a href="cart.html"> <li><img src="Cart1.png" alt="Cart" /></li></a>
            <a href="Profile.html"><li><img src="user.png" alt="User" /></li></a> -->
        </div>
    </nav>
</header>

<!-- Main Content: Home / About / Contact / Signup -->
<main>
    <!-- Home Section -->
    <section id="home" class="page active">
        <div class="hero">
            <div class="hero-text">
                <h1>Reveal The Beauty Of Skin</h1>
                <p>Elevate your natural beauty with our premium cosmetic products carefully curated to enhance your radiance</p>
                <a href="userlogin.php" class="herobtn">Shop Now</a>
            </div>
            <div class="hero-image">
                <img src="2147 1-Photoroom.png" alt="Hero Jar Splash" />
            </div>
        </div>

        <div class="categories">
            <h2>Shop By Category</h2>
            <div class="category-list">
                <div class="category-item">
                    <img src="cat1.png" alt="Foundation" />
                    <h3>Foundation</h3>
                    <p>Elevate Your Natural Beauty</p>
                    <button class="btn" onclick="window.location.href='userlogin.php'">Shop Now</button>
                </div>
                <div class="category-item">
                    <img src="cat2.png" alt="Lip Serum" />
                    <h3>Lip Serum</h3>
                    <p>Elevate Your Natural Beauty</p>
                    <button class="btn" onclick="window.location.href='userlogin.php'">Shop Now</button>
                </div>
                <div class="category-item">
                    <img src="cat3.png" alt="Sunscreen" />
                    <h3>Sunscreen</h3>
                    <p>Elevate Your Natural Beauty</p>
                    <button class="btn" onclick="window.location.href='userlogin.php'">Shop Now</button>
                </div>
            </div>
        </div>

        <div class="best-seller">
            <h2>Best Seller</h2>
            <div class="product-scroll">
            <!-- Repeat product-card as needed -->
                <div class="product-card">
                    <img src="1.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <div class="product-card">
                    <img src="2.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <div class="product-card">
                    <img src="3.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <div class="product-card">
                    <img src="4%201.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <div class="product-card">
                    <img src="5.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <div class="product-card">
                    <img src="6.png" alt="Combo relax sensitive" />
                    <h4>Combo relax sensitive</h4>
                    <p>
                        $32.00 <span class="old-price">$40.00</span>
                        <span class="discount">-20%</span>
                    </p>
                    <p class="rating">⭐ 4.8 (129 Reviews)</p>
                    <p class="delivery">Free delivery</p>
                    <div class="product-actions">
                        <button>-</button>
                        <input type="number" value="1" min="1" />
                        <button>+</button>
                        <button class="add-cart">
                            <img src="shopping-cart-03.png" alt="Add to cart" />
                        </button>
                    </div>
                </div>
                <!-- ... more -->
            </div>
        </div>

        <div class="new-collection">
            <h2>New Collection</h2>
            <div class="collection-banner">
                <img src="image 19.png" alt="New Collection" />
                <button class="herobtn">Explore More</button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="page about-section">
        <div class="about-container">
            <div class="about-text">
                <h2>Our Story</h2>
                <p>
                    Launced in 2015, Exclusive is South Asia’s premier online shopping makterplace with an active presense in Bangladesh.
                    Supported by wide range of tailored marketing, data and service solutions, Exclusive has 10,500 sallers and 300 brands
                    and serves 3 millioons customers across the region.
                </p>
                <p>
                    Exclusive has more than 1 Million products to offer, growing at a very fast. Exclusive offers a diverse assotment in
                    categories ranging from consumer.
                </p>
            </div>
            <div class="about-image">
                <img src="2147_1-removebg-preview.png" alt="About Us" />
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="page">
        <div class="contact-container">
            <div class="contact-info">
                <h3>Call To Us</h3>
                <p>We are available 24/7</p>
                <p>Phone: +94 711 234 316</p>
                <h3>Write To Us</h3>
                <p>customer@exclusive.com</p>
                <p>support@exclusive.com</p>
            </div>
            <form class="contact-form">
                <input type="text" placeholder="Your Name *" required />
                <input type="email" placeholder="Your Email *" required />
                <input type="tel" placeholder="Your Phone *" required />
                <textarea placeholder="Your Message" rows="5"></textarea>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Sign Up Section -->
    <section id="signup" class="page">
        <div class="signup-page">
            <img src="2147 1-Photoroom.png" alt="Sign Up" />

            <div class="signup-content">
                <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">Create An Account</h2>
                <p style="margin-bottom: 1.5rem; color: #555;">Enter your details below</p>

                <form class="signup-form">
                    <input type="text" placeholder="Name" required />
                    <input type="email" placeholder="Email or Phone Number" required />
                    <input type="password" placeholder="Password" required />
                    <button type="submit" class="btn">Create Account</button>
                </form>

                <div class="google-signup" style="margin-top: 1rem;">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" />
                    <span>Sign up with Google</span>
                </div>

                <div class="signup-footer">
                    Already have account? <a href="#">Log in</a>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-logo">
                <h2>Vogue Mart</h2>
                <p>Elevate your natural beauty</p>
            </div>

            <div class="footer-subscribe">
                <h2>Subscribe To Get 15% Off</h2>
                <div class="subscribe-form">
                    <input type="email" placeholder="Please enter your email" />
                    <button>Subscribe</button>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-column">
                    <h4>Resources</h4>
                    <ul>
                        <li>Documentation</li>
                        <li>Free Demo</li>
                        <li>Press Conference</li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Legal</h4>
                    <ul>
                        <li>Terms of Service</li>
                        <li>Privacy Policy</li>
                        <li>Cookies Policy</li>
                        <li>Data Processing</li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Contact</h4>
                    <ul>
                        <li>070 7774 1690</li>
                        <li>347 Portobello, London</li>
                        <li class="social-icons">
                            <img src="Facebook.png" alt="Facebook" />
                            <img src="Instagram.png" alt="Instagram" />
                            <img src="Twitter.png" alt="Twitter/X" />
                            <img src="Linkedin.png" alt="LinkedIn" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy;  All right reserved.</p>
            <div class="footer-phone">
                <img src="Phone.png" alt="Phone" />
                <span>+1234–456–7890</span>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
