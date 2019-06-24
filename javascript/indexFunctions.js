window.onload = function() {
  var modalSignin = document.getElementById("DialogOutSignin");
  var modalLogin = document.getElementById("DialogOutLogin");
  var closeLogin = document.getElementById("closeLogin");
  var closeSignin = document.getElementById("closeSignin");
  var buttonSignin = document.getElementById("signin");
  var buttonLogin = document.getElementById("login");
    
  buttonSignin.onclick = function() {
    modalSignin.style.display = "block";
  };

  buttonLogin.onclick = function() {
    modalLogin.style.display = "block";
  };

  closeLogin.onclick = function() {
    modalLogin.style.display = "none";
  };

  closeSignin.onclick = function() {
    modalSignin.style.display = "none";
  };
  
  window.onclick = function() {
    if (event.target == modalSignin) {
      modalSignin.style.display = "none";
    }

    if (event.target == modalLogin) {
      modalLogin.style.display = "none";
    }

  };

/* ===== Logic for creating fake Select Boxes ===== */
$('.sel').each(function() {
  $(this).children('select').css('display', 'none');
  
  var $current = $(this);
  
  $(this).find('option').each(function(i) {
    if (i == 0) {
      $current.prepend($('<div>', {
        class: $current.attr('class').replace(/sel/g, 'sel__box')
      }));
      
      var placeholder = $(this).text();
      $current.prepend($('<span>', {
        class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
        text: placeholder,
        'data-placeholder': placeholder
      }));
      
      return;
    }
    
    $current.children('div').append($('<span>', {
      class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
      text: $(this).text()
    }));
  });
});

// Toggling the `.active` state on the `.sel`.
$('.sel').click(function() {
  $(this).toggleClass('active');
});

// Toggling the `.selected` state on the options.
$('.sel__box__options').click(function() {
  var txt = $(this).text();
  var index = $(this).index();
  
  $(this).siblings('.sel__box__options').removeClass('selected');
  $(this).addClass('selected');
  
  var $currentSel = $(this).closest('.sel');
  $currentSel.children('.sel__placeholder').text(txt);
  $currentSel.children('select').prop('selectedIndex', index + 1);
});
};