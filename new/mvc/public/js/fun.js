function changepage1() {
  document.getElementsByClassName('first-page')[0].style.display = "none";
  document.getElementsByClassName('second-page')[0].style.display = "block";
  document.getElementsByClassName('register-page')[0].style.display = "none";
  document.getElementsByClassName('selector')[0].style.display = "none";
  document.getElementsByClassName('full-menu')[0].style.display = "none";
}

function changepage2() {
  document.getElementsByClassName('first-page')[0].style.display = "block";
  document.getElementsByClassName('second-page')[0].style.display = "none";
  document.getElementsByClassName('register-page')[0].style.display = "none";
  document.getElementsByClassName('selector')[0].style.display = "none";
  document.getElementsByClassName('full-menu')[0].style.display = "none";
}
function changepageregister() {
  document.getElementsByClassName('first-page')[0].style.display = "none";
  document.getElementsByClassName('second-page')[0].style.display = "none";
  document.getElementsByClassName('register-page')[0].style.display = "block";
  document.getElementsByClassName('selector')[0].style.display = "none";
  document.getElementsByClassName('full-menu')[0].style.display = "none";
}
function changetologin(){
  document.getElementsByClassName('form-container')[0].style.display = "block";
  document.getElementsByClassName('userdetails')[0].style.display = "none";

}
function changefromlogin(){
  document.getElementsByClassName('form-container')[0].style.display = "none";
  document.getElementsByClassName('userdetails')[0].style.display = "block";

}
function changepage3() {
  document.getElementsByClassName('first-page')[0].style.display = "none";
  document.getElementsByClassName('second-page')[0].style.display = "none";
  document.getElementsByClassName('register-page')[0].style.display = "none";
  document.getElementsByClassName('selector')[0].style.display = "block";
  document.getElementsByClassName('full-menu')[0].style.display = "none";
}
function menufunction() {
  var y=document.getElementsByClassName('first-page')[0];
  var z=document.getElementsByClassName('second-page')[0];
  var q=document.getElementsByClassName('register-page')[0];
  var r=document.getElementsByClassName('selector')[0];
  
    var x = document.getElementsByClassName("full-menu")[0];
    if (x.style.display === "none" ) {
      x.style.display = "block";
      y.style.display = "none";
      z.style.display = "none";
      q.style.display = "none";
      r.style.display = "none";
    } else {
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
      q.style.display = "none";
      r.style.display = "none";
    }
  
}
    