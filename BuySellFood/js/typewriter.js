

window.onload = function(){
  
var i = 0;
var txt = '';
var txt1='One who cooks.';
var txt2='One who eats.'
var speed = 50;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("demo").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
typeWriter();
  
  
};