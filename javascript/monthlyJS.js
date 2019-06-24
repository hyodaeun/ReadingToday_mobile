window.onload = function() {
  function fillGradient(monthlyID) {
    document.getElementById(monthlyID).style.backgroundImage = "linear-gradient(to right, "+feels.toString()+")";
  }

  function fillColor(monthlyID){
    document.getElementById(monthlyID).style.backgroundColor = feels.toString();
  }
}
