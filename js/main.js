!function(e){"function"!=typeof e.matches&&(e.matches=e.msMatchesSelector||e.mozMatchesSelector||e.webkitMatchesSelector||function(e){for(var t=this,o=(t.document||t.ownerDocument).querySelectorAll(e),n=0;o[n]&&o[n]!==t;)++n;return Boolean(o[n])}),"function"!=typeof e.closest&&(e.closest=function(e){for(var t=this;t&&1===t.nodeType;){if(t.matches(e))return t;t=t.parentNode}return null})}(window.Element.prototype);


document.addEventListener('DOMContentLoaded', function() {

   var modalButtons = document.querySelectorAll('.js-open-modal'),
       overlay      = document.querySelector('.js-overlay-modal'),
       closeButtons = document.querySelectorAll('.js-modal-close');


       modalButtons.forEach(function(item){
        item.addEventListener('click', function(e) {
          e.preventDefault();
      
          var modalId = this.getAttribute('data-modal'),
              modalElem = document.querySelector('.modal[data-modal="' + modalId + '"]');
      
          modalElem.classList.add('active');
          overlay.classList.add('active');
      
          // Добавляем стиль, чтобы запретить прокрутку
          document.body.style.overflow = 'hidden';
        });
      });
      
      closeButtons.forEach(function(item){
        item.addEventListener('click', function(e) {
          var parentModal = this.closest('.modal');
      
          parentModal.classList.remove('active');
          overlay.classList.remove('active');
      
          // Убираем стиль, чтобы разрешить прокрутку
          document.body.style.overflow = '';
        });
      });


    document.body.addEventListener('keyup', function (e) {
        var key = e.keyCode;

        if (key == 27) {

            document.querySelector('.modal.active').classList.remove('active');
            document.querySelector('.overlay').classList.remove('active');
        };
    }, false);

    overlay.addEventListener('click', function() {
      document.querySelector('.modal.active').classList.remove('active');
      this.classList.remove('active');
      
      // Убираем стиль, чтобы разрешить прокрутку
      document.body.style.overflow = '';
      
      // Убираем класс .tooltiptextvisi
      var tooltips = document.querySelectorAll('.tooltiptextvisi');
      tooltips.forEach(function(tooltip) {
          tooltip.classList.remove('tooltiptextvisi');
      });
    });

    // Добавляем обработчик клика на .js-modal-close
    closeButtons.forEach(function(item) {
      item.addEventListener('click', function(e) {
          var parentModal = this.closest('.modal');
          parentModal.classList.remove('active');
          overlay.classList.remove('active');
          // Убираем класс .tooltiptextvisi
          var tooltip = parentModal.querySelector('.tooltiptextvisi');
          if (tooltip) {
              tooltip.classList.remove('tooltiptextvisi');
          }
      });
  });

});


//-----------------------------------------------------

window.onload = function () {
  showContentWithAnimation();
};

function showContentWithAnimation() {
  const body = document.body;

  if (!body) {
    console.error("Body element not found");
    return;
  }

  body.classList.add('loaded_hiding');
  body.classList.remove('hidden');

  setTimeout(function () {
    body.classList.add('loaded');
    body.classList.remove('loaded_hiding');
  }, 500);
}

//-----------------------------------------------------

function copyTo(button) {
  var copyText = button.parentElement.querySelector(".intut");
  copyText.select();
  copyText.setSelectionRange(0, 99999);

  if (navigator.clipboard) {
    navigator.clipboard.writeText(copyText.value)
      .then(function() {
        var tooltip = button.querySelector(".tooltiptext");
        tooltip.classList.add("tooltiptextvisi");
      })
      .catch(function(error) {
        console.error("Failed to copy text: ", error);
      });
  } else {
    console.error("Clipboard API is not supported");
  }
}

