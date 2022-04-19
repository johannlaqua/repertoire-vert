//////////////////////////// INITIALISATION
var SlideNews = document.querySelectorAll('.carousel__item--next1')
var SlideStory = document.querySelectorAll('.carousel__item--next2')

var slidePosition ={
  'next1':0,'next2':0,
  'prev1':0,'prev2':0
}


var firstSlideNews = SlideNews[slidePosition['next1']];
var firstSlideStory = SlideStory[slidePosition['next2']];
firstSlideNews.classList.add('carousel__item--next1--visible');
firstSlideNews.classList.add('carousel__item--prev1--visible');
firstSlideStory.classList.add('carousel__item--next2--visible');
firstSlideStory.classList.add('carousel__item--prev2--visible');
var pageNews = document.querySelectorAll('.icon-pagination--next1')
var pageStory = document.querySelectorAll('.icon-pagination--next2')

firstPageNews = pageNews[slidePosition['next1']];
firstPageStory = pageStory[slidePosition['next1']];

firstPageNews.classList.add('icon-pagination--next1--activ');
firstPageNews.classList.add('icon-pagination--prev1--activ');
firstPageStory.classList.add('icon-pagination--next2--activ');
firstPageStory.classList.add('icon-pagination--prev2--activ');



//firstPageNews.innerHTML = '   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg>    ';
//firstPageStory.innerHTML = '   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg>    ';

////////////////////////////////////////////////////////////////////
// NEXT ///////////////////////////////////////////////////////////
var nexts = document.querySelectorAll('.carousel__button--next');
nexts.forEach(
    next=>{
      next.addEventListener("click", function()
      {
        var id = next.id;
        Increment_or_Decrement_Slide(id);
          var activPage = document.querySelector('.icon-pagination--'+id+'--activ');
          activPage.innerHTML = '   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg>    ';
      });
    }
);

////////////////////////////////////////////////////////////////////
// PREV ///////////////////////////////////////////////////////////
var prevs = document.querySelectorAll('.carousel__button--prev');
prevs.forEach(
    prev=>{
      prev.addEventListener("click", function()
      {
        var id = prev.id;
        Increment_or_Decrement_Slide(id);
       });
    }
);
function updatePagePosition(id){
  const previousPage = document.querySelector('.icon-pagination--'+id+'--activ');
  const newsPage = document.querySelectorAll('.icon-pagination--'+id)[slidePosition[id] % 4];
  previousPage.classList.remove('.icon-pagination--next1--activ');
  previousPage.classList.remove('.icon-pagination--prev1--activ');
  previousPage.innerHTML = '';
  switch (id) {
    case 'next1':
      previousPage.classList.remove('icon-pagination--'+id+'--activ');
      previousPage.classList.remove('icon-pagination--prev1--activ');
      newsPage.classList.add('icon-pagination--'+id+'--activ');
      newsPage.classList.add('icon-pagination--prev1--activ');
      break;
    case 'prev1':
      previousPage.classList.remove('icon-pagination--'+id+'--activ');
      previousPage.classList.remove('icon-pagination--next1--activ');

      newsPage.classList.add('icon-pagination--'+id+'--activ');
      newsPage.classList.add('icon-pagination--next1--activ');
      break;
    case 'next2':
      previousPage.classList.remove('icon-pagination--'+id+'--activ');
      previousPage.classList.remove('icon-pagination--prev2--activ');

      newsPage.classList.add('icon-pagination--'+id+'--activ');
      newsPage.classList.add('icon-pagination--prev2--activ');
      break;
    case 'prev2':
      previousPage.classList.remove('icon-pagination--'+id+'--activ');
      previousPage.classList.remove('icon-pagination--next2--activ');

      newsPage.classList.add('icon-pagination--'+id+'--activ');
      newsPage.classList.add('icon-pagination--next2--activ');

      break;
  }
  newsPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg> ';
  previousPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><defs><style>.a,.c{fill:none;}.a{stroke:#000;}.b{stroke:none;}</style></defs><g class="a"><circle class="b" cx="7" cy="7" r="7"/><circle class="c" cx="7" cy="7" r="6.5"/></g></svg> ';
}

function updateSlidePosition(id) {
  var previousSlide = document.querySelector('.carousel__item--'+id+'--visible')
  var newSlide = document.querySelectorAll('.carousel__item--'+id)[slidePosition[id]];

  var previousPage = document.querySelector('.icon-pagination--'+id+'--activ');
  var newsPage = document.querySelectorAll('.icon-pagination--'+id)[slidePosition[id]];
  switch (id) {
    case 'next1':
        previousSlide.classList.remove('carousel__item--'+id+'--visible');
        previousSlide.classList.remove('carousel__item--prev1--visible');

        newSlide.classList.add('carousel__item--'+id+'--visible');
        newSlide.classList.add('carousel__item--prev1--visible');


        break;
    case 'prev1':
      previousSlide.classList.remove('carousel__item--'+id+'--visible');
      previousSlide.classList.remove('carousel__item--next1--visible');

      newSlide.classList.add('carousel__item--'+id+'--visible');
      newSlide.classList.add('carousel__item--next1--visible');
      break;
    case 'next2':
      previousSlide.classList.remove('carousel__item--'+id+'--visible');
      previousSlide.classList.remove('carousel__item--prev2--visible');

      newSlide.classList.add('carousel__item--'+id+'--visible');
      newSlide.classList.add('carousel__item--prev2--visible');
      break;
    case 'prev2':
      previousSlide.classList.remove('carousel__item--'+id+'--visible');
      previousSlide.classList.remove('carousel__item--next2--visible');

      newSlide.classList.add('carousel__item--'+id+'--visible');
      newSlide.classList.add('carousel__item--next2--visible');
      break;
  }

}

function Increment_or_Decrement_Slide(id) {

  var totalSousSlides = document.querySelectorAll('.carousel__item--'+id).length;
  switch (id) {
    case 'next1':
      if (slidePosition[id] === totalSousSlides - 1 ) {
        slidePosition[id] = 0;
        slidePosition['prev1'] = 0;
      } else {
        slidePosition[id] ++;
        slidePosition['prev1'] ++;
      }
      break;
    case 'prev1':
      if (slidePosition[id] === 0 ) {
        slidePosition[id] = totalSousSlides - 1;
        slidePosition['next1'] = totalSousSlides - 1;
      } else {
        slidePosition[id] --;
        slidePosition['next1'] --;
      }
      break;
    case 'next2':
      if (slidePosition[id] === totalSousSlides - 1 ) {
        slidePosition[id] = 0;
        slidePosition['prev2'] = 0;
      } else {
        slidePosition[id] ++;
        slidePosition['prev2'] ++;
      }
      break;
    case 'prev2':
      if (slidePosition[id] === 0 ) {
        slidePosition[id] = totalSousSlides - 1;
        slidePosition['next2'] = totalSousSlides - 1;
      } else {
        slidePosition[id] --;
        slidePosition['next2'] --;
      }
      break;
  }
  console.log('appel de update page')
  updateSlidePosition(id);
  updatePagePosition(id);
}
