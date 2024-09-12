<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="/css/footer.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <main>
    <!-- Main content would go here -->
  </main>

  <footer>
    <section aria-labelledby="footerCorporate">
      <h2 id="footerCorporate">Corporate</h2>
      <p><a href="tel:+19512809960">(951) 280-9960</a></p>
    </section>
    <section aria-labelledby="footerVisit">
      <h2 id="footerVisit">Visit Us</h2>
      <address>
        <a
          href="https://www.google.com/maps/place/411+Jenks+Cir,+Corona,+CA+92878"
          rel="noreferrer"
          target="_blank"
        >
          411 Jenks Circle, Suite 205, Corona, CA 92878
        </a>
      </address>
    </section>
    <section aria-labelledby="footerConnect">
      <h2 id="footerConnect">Connect</h2>
      <nav>
        <a href="https://www.facebook.com/calvadasurveyinginc/" target="_blank">
          <img src="/images/icons/facebook.png" alt="Facebook" />
        </a>
        <a
          href="https://www.linkedin.com/company/calvada-surveying/"
          target="_blank"
        >
          <img src="/images/icons/linkedin.png" alt="LinkedIn" />
        </a>
        <a href="https://www.instagram.com/calvadasurveying/" target="_blank">
          <img src="/images/icons/instagram.png" alt="Instagram" />
        </a>
      </nav>
    </section>
  </footer>
  <div class="copyright">
    <p>
      Copyright &copy; Calvada Surveying, Inc. 2024 ~
      <a href="/pdf/Website_Accessibility.pdf" target="_blank"
        >Accessibility Statement</a
      ><br />
    </p>
  </div>
  <a href="#" class="scrollToTop">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
  </a>

  <script>
    $(document).ready(function () {
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
          $(".scrollToTop").fadeIn();
        } else {
          $(".scrollToTop").fadeOut();
        }
      });
      $(".scrollToTop").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
      });
    });
  </script>
</html>
