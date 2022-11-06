// const navbar = document.querySelector('.nav-fixed');
// window.onscroll = () => {
//     if (window.scrollY > 300) {
//         navbar.classList.add('nav-active');
//     } else {
//         navbar.classList.remove('nav-active');
//     }
// };


// function changebg(){
//     var navbar =document.getElementById('navbar');
//     var scrollvalue=window.screenY;
//     if (scrollValue <150){
//         navbar.classList.remove('bgcolor');
//     }else
// {
//     navbar.classList.add('bgcolor');    
//     }
// }
// window.addEventListener('scroll',changebg);
const navbar = document.querySelector('.nav');
window.onscroll = () => {
    if (window.scrollY > 300) {
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};

// var navbar = document.querySelector('.nav')

// window.onscroll = function() {

//   // pageYOffset or scrollY
//   if (window.pageYOffset > 0) {
//     navbar.classList.add('scrolled')
//   } else {
//     navbar.classList.remove('scrolled')
//   }
// }




function scrollToTop() {
    window.scrollTo(0, 0);
}





$(".showme").click(function(){
  $(".ab").animate({
      left:"0"
  },0)
})
$(".close").click(function(){
  $(".ab").animate({
      left :"-100%"
  },0)
})
