<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="landing.css" />
    <title>FinBooster Marketing</title>
  </head>

  <body class="container">
    <header class="header">
      <a href="#" class="header__logo">
        <img
          loading="lazy"
          class="logo-light"
          src="images/all_pictures/logo-white.png"
          alt="Light version of logo"
        />

        <img
          loading="lazy"
          class="logo-dark"
          src="images/all_pictures/logo.png"
          alt="dark version of logo"
        />
      </a>

      <nav class="header__nav">
        <ul class="header__nav--links">
          <li class="header__nav--links__link">
            <a href="#">Home</a>
          </li>
          <li class="header__nav--links__link">
            <a href="#services">Services</a>
          </li>
          <li class="header__nav--links__link">
            <a href="#about">About Us</a>
          </li>
          <li class="header__nav--links__link">
            <a href="#join">Join Us</a>
          </li>
          <li class="header__nav--links__link">
            <a href="#team">Team</a>
          </li>
          <!-- <li class="header__nav--links__link">
            <a href="#contact">Contact Us</a>
          </li> -->
          <li class="header__nav--links__link">
            <a href="user/login.php">Login</a>
          </li>
        </ul>
      </nav>

      <div class="hamburger">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
      </div>
    </header>

    <section class="hero">
      <h1 class="hero__title">
        Revolutionizing Marketing with
        <div>Sohpisticated Marketing Made Easy</div>
      </h1>

      <p class="hero__para">
        Our professional workflows are designed to help you automate repetitive
        tasks and focus on high-level strategy.
      </p>

      <a href="user/CreateAccount.php" class="hero__link">Get Started</a>

      <div class="hero__img">
        <img
          loading="lazy"
          src="images/showcase/hero-img.png"
          alt="The image of a laptop"
        />
      </div>
    </section>

    <section id="services" class="features section__padding">
      <h2 class="features__title section__title">
        <span>Explore</span> Our Services
      </h2>

      <div class="features__cards">
        <div class="features__cards--card-1 features__card">
          <div class="features__cards--card-1__icons features__card--icons">
            <img
              loading="lazy"
              src="images/features/main-shape.svg"
              alt="triangle with rounded corners"
            />

            <img
              loading="lazy"
              src="images/features/shape-1.svg"
              alt="triangle with rounded corners"
            />

            <i class="fa-solid fa-crop"></i>
          </div>

          <h3 class="features__cards--card-1__title features__card--title">
            Data Analytics
          </h3>

          <p
            class="features__cards--card-1__para features__card--para section__para"
          >
            Our data analytics platform provides comprehensive insights into
            your audience, allowing you to make informed marketing decisions.
            Our targeted advertising solutions ensure that your message reaches
            the right people at the right time.
          </p>

          <a
            href="#"
            class="features__cards--card-1__link features__card--link section__sub-link"
            ><span>Learn More <i class="fa-solid fa-angle-right"></i></span
          ></a>
        </div>

        <div class="features__cards--card-2 features__card">
          <div class="features__cards--card-2__icons features__card--icons">
            <img
              loading="lazy"
              src="images/features/main-shape.svg"
              alt="triangle with rounded corners"
            />

            <img
              loading="lazy"
              src="images/features/shape-2.svg"
              alt="triangle with rounded corners"
            />

            <i class="fa-solid fa-gear"></i>
          </div>

          <h3 class="features__cards--card-2__title features__card--title">
            B2B Marketing
          </h3>

          <p
            class="features__cards--card-2__para features__card--para section__para"
          >
            Intimidatingly good marketing comes from strong, honest
            relationships. We love being challenged by clients and we love
            challenging back. We ask a lot of annoying questions. Frankly, we’re
            a pain. But the results are worth it by an order of magnitude.
          </p>

          <a
            href="#"
            class="features__cards--card-2__link features__card--link section__sub-link"
            ><span>Learn More <i class="fa-solid fa-angle-right"></i></span
          ></a>
        </div>

        <div class="features__cards--card-3 features__card">
          <div class="features__cards--card-3__icons features__card--icons">
            <img
              loading="lazy"
              src="images/features/main-shape.svg"
              alt="triangle with rounded corners"
            />

            <img
              loading="lazy"
              src="images/features/shape-3.svg"
              alt="triangle with rounded corners"
            />

            <i class="fa-solid fa-bolt-lightning"></i>
          </div>

          <h3 class="features__cards--card-3__title features__card--title">
            SEO Focus
          </h3>

          <p
            class="features__cards--card-3__para features__card--para section__para"
          >
            Our email marketing campaigns are designed to drive conversions and
            build customer loyalty. Our search engine optimization services
            ensure that your website ranks highly on search engines, increasing
            your visibility and driving traffic to your site.
          </p>

          <a
            href="#"
            class="features__cards--card-3__link features__card--link section__sub-link"
            ><span>Learn More <i class="fa-solid fa-angle-right"></i></span
          ></a>
        </div>
      </div>

      <video autoplay muted loop id="myVideo">
        <source src="video/file.mp4" />
      </video>
    </section>

    <section id="about" class="about section__padding">
      <div class="about__pt-1 about__pt">
        <div class="about__pt-1--content about__pt--content">
          <h2
            class="about__pt-1--content__title about__pt--content__title section__title"
          >
            <span>About</span> FinBooster Marketing
          </h2>

          <p
            class="about__pt-1--content__para about__pt--content__para section__para"
          >
            At FinBooster Marketing, we offer a suite of expert marketing solutions
            to help your business thrive. From data analytics to targeted
            advertising, we have everything you need to succeed in the digital
            marketplace. ​ We create experiences. We believe in building
            long-term partnerships with our clients, offering a consultative and
            holistic approach to business. Our data-driven technology, powerful
            platform, and exceptional team enable us to stand apart from the
            competition. Let us help you build your brand experience.
          </p>

          <a
            href="user/CreateAccount.php"
            class="about__pt-1--content__link about__pt--content__link"
            >Join Us</a
          >
        </div>

        <div class="about__pt-1--img about__pt--img">
          <img loading="lazy" src="images/about/about-1.svg" alt="Template" />
        </div>
      </div>

      <div class="about__pt-2 about__pt">
        <div class="about__pt-2--img about__pt--img">
          <img loading="lazy" src="images/about/about-2.svg" alt="Template" />
        </div>

        <div class="about__pt-2--content about__pt--content">
          <h2
            class="about__pt-2--content__title about__pt--content__title section__title"
          >
            <span> Revolutionizing Marketing </span>
          </h2>

          <p
            class="about__pt-2--content__para about__pt--content__para section__para"
          >
          FinBooster Marketing - the expert marketing cycle. Our vision is to
            make sophisticated marketing simple. Re-launched in 2019, leverages
            advanced artificial intelligence (AI) and trillion of consumer
            signals to make it easier for marketers to acquire, grow, and retain
            customers more efficiently and effectively. ​ We are differentiated
            in that it is the largest omnichannel marketing platform with
            identity data at its core. It unifies identity, intelligence, and
            omnichannel activation into a single platform - powered by one of
            the industry's largest proprietary opt-in databases and AI.
          </p>

          <a
            href="user/CreateAccount.php"
            class="about__pt-2--content__link about__pt--content__link"
            >Join Us</a
          >
        </div>
      </div>

      <div class="about__pt-3 about__pt">
        <div class="about__pt-3--content about__pt--content">
          <h2
            class="about__pt-3--content__title about__pt--content__title section__title"
          >
            Cool facts<span> about our platform </span>
          </h2>

          <p
            class="about__pt-3--content__para about__pt--content__para section__para"
          >
            Our 400+ scaled enterprise customers (defined as customers from
            which we generated at least $100,000 in revenue on a trailing
            twelve-month basis) are diversified across multiple verticals and
            empowered to personalize experiences with consumers at an individual
            level across addressable channels (including email, social media,
            web, SMS text, connected TV, video and others), delivering better
            results for marketing programs.
          </p>

          <a
            href="user/CreateAccount.php"
            class="about__pt-3--content__link about__pt--content__link"
            >Join Us</a
          >
        </div>

        <div class="about__pt-3--img about__pt--img">
          <img loading="lazy" src="images/about/about-3.svg" alt="Template" />
        </div>
      </div>
    </section>

    <section id="join" class="why section__padding">
      <div class="why__img">
        <img loading="lazy" src="images/why/img.png" alt="why choose us" />

        <img loading="lazy" src="images/why/dots.svg" alt="dots" />
      </div>

      <div class="why__content">
        <h2 class="why__content--title section__title">
          <span>Why</span> Choose Us
        </h2>

        <p class="why__content--para section__para">
          B2B ETL marketing is not only used for merchant marketing and
          promotional purposes, but also provides a lucrative part-time income
          for those who have spare time to participate in our marketing
          programs. ​ Earn extra income with our platform B2B marketing tool to
          gain profit daily!
        </p>

        <div class="why__content--facts">
          <div class="why__content--facts__fact">
            <p>125K</p>
            <p>Downloads</p>
          </div>

          <div class="why__content--facts__fact">
            <p>87K</p>
            <p>Users</p>
          </div>

          <div class="why__content--facts__fact">
            <p>4.8</p>
            <p>Rating</p>
          </div>
        </div>
      </div>
    </section>

    <section id="team" class="folks section__padding">
      <h2 class="folks__title section__title">
        Folks We <span>Work With</span>
      </h2>
      <p class="section__para">
        One of the joys of this job is the mix of weird and wonderful B2B
        marketers we get to hang out with. Here are just a few of the brands
        we’ve helped.
      </p>

      <div class="folks__content video-background">
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-04.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-05.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-07.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-08.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-09.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-10.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-11.webp"
          alt=""
        />
        <img
          class="logo-class"
          src="images/logos/BVelocity LOGO-12.webp"
          alt=""
        />
      </div>
    </section>

    <footer id="contact" class="footer section__padding">
      <div class="footer__newsletter">
        <h2 class="footer__newsletter--title section__title">
          <span>Subscribe to our Newsletter,</span> get regular updates
        </h2>

        <form class="footer__newsletter--form">
          <input type="email" placeholder="Enter Email" />
          <input type="submit" value="Subscribe" />
        </form>
      </div>

      <div class="footer__main-info">
        <div class="footer__main-info--description">
          <img
            loading="lazy"
            class="footer__main-info--description__img"
            src="images/all_pictures/logo-white.png"
            alt="logo light version"
          />

          <p class="footer__main-info--description__para section__para">
            Our smart analytics tools provide valuable insights into your online
            marketing strategies. With our platform, you can track your progress
            and make data-driven decisions.
          </p>
        </div>

        <div class="footer__main-info--resources">
          <h3 class="footer__main-info--resources__title">Resources</h3>

          <ul class="footer__main-info--resources__links">
            <li class="footer__main-info--resources__links--link">
              <a href="#">Home</a>
            </li>
            <li class="footer__main-info--resources__links--link">
              <a href="#services">Services</a>
            </li>
            <li class="footer__main-info--resources__links--link">
              <a href="#about">About Us</a>
            </li>
            <!-- <li class="footer__main-info--resources__links--link">
              <a href="#contact">Contact</a>
            </li> -->
          </ul>
        </div>

        <div class="footer__main-info--contact">
          <h3 class="footer__main-info--contact__title">Contact Us</h3>

          <ul class="footer__main-info--contact__links">
            <li class="footer__main-info--contact__links--link">
              contact@finboostermarketing.com ​
            </li>
            <li class="footer__main-info--contact__links--link">
              1490 Tiny Town Rd, Clarksville,
            </li>
            <li class="footer__main-info--contact__links--link">
              TN 37042, United States
            </li>
          </ul>
        </div>
      </div>

      <div class="footer__author">
        <p>© <?php echo  date('Y') ?> FinBooster. All right reserved</p>
      </div>
    </footer>

    <script src="landing.js"></script>
  </body>
</html>
