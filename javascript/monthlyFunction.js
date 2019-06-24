//window.onload = function() {
  var modalMonthly = document.getElementsByClassName("DialogOutMonthly");
  var closeMonthly = document.getElementsByClassName("closeMonthly");
  var monthDIV = document.getElementsByClassName("monthly");
  var monthlyH1 = document.getElementsByClassName("monthlyH1");
  for (var i = 0; i < monthDIV.length-1; i++) {
    monthDIV[i].addEventListener('click', function(event) {
      modalMonthly[i].style.display = "block";
      monthlyH1[i].style.display = "block";
    });
    closeMonthly[i].onclick = function() {
      modalMonthly[i].style.display = "none";
    };

    window.onclick = function() {
      if (event.target == modalMonthly[i]) {
        modalMonthly[i].style.display = "none";
      }
    };
  }
//} // window.onload
