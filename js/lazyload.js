document.addEventListener("DOMContentLoaded", function() {
    const lazyBackgrounds = document.querySelectorAll(".parallax-main");
  
    const lazyLoad = target => {
      const obs = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const bg = entry.target;
            const bgImage = bg.getAttribute("data-bg");
            bg.style.backgroundImage = `url(${bgImage})`;
            observer.disconnect();
          }
        });
      });
      obs.observe(target);
    };
  
    lazyBackgrounds.forEach(lazyLoad);
  });
  