(function () {
  'use strict';

  var body = document.body;
  var toggle = document.querySelector('.menu-toggle');
  var nav = document.querySelector('#site-navigation');

  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var isOpen = body.classList.toggle('nav-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  var faqButtons = document.querySelectorAll('.faq-question');
  faqButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var item = button.closest('.faq-item');
      if (!item) {
        return;
      }
      var isOpen = item.classList.toggle('is-open');
      button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  });

  var certificateViewer = document.querySelector('.certificate-viewer');
  if (certificateViewer) {
    if (certificateViewer.parentNode !== document.body) {
      document.body.appendChild(certificateViewer);
    }
    var viewerImage = certificateViewer.querySelector('.certificate-viewer__image');
    var closeTriggers = certificateViewer.querySelectorAll('[data-action="close"]');
    var certificateStrips = document.querySelectorAll('.certificates__strip');

    var openViewer = function (img, link) {
      if (!viewerImage) {
        return;
      }
      var fullSrc = link ? link.getAttribute('href') : '';
      viewerImage.src = fullSrc || img.getAttribute('src') || '';
      viewerImage.alt = img.getAttribute('alt') || 'Сертификат';
      certificateViewer.classList.add('is-open');
      certificateViewer.setAttribute('aria-hidden', 'false');
      body.classList.add('certificate-viewer-open');
    };

    var closeViewer = function () {
      certificateViewer.classList.remove('is-open');
      certificateViewer.setAttribute('aria-hidden', 'true');
      body.classList.remove('certificate-viewer-open');
      if (viewerImage) {
        viewerImage.src = '';
      }
    };

    certificateStrips.forEach(function (strip) {
      strip.addEventListener('click', function (event) {
        var link = event.target.closest('.certificates__item');
        if (!link) {
          return;
        }
        var img = link.querySelector('img');
        if (!img) {
          return;
        }
        event.preventDefault();
        openViewer(img, link);
      });
    });

    closeTriggers.forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        closeViewer();
      });
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && certificateViewer.classList.contains('is-open')) {
        closeViewer();
      }
    });
  }
})();
