var slidePosition2 ={
    'next3':0,'next4':0,
    'prev3':0,'prev4':0
}

var SlideInscrits = document.querySelectorAll('.carousel2__item--next3')
var SlideRate = document.querySelectorAll('.carousel2__item--next4')


var ThreefirstSlideInscrits = [
    SlideInscrits[slidePosition2['next3']],
    SlideInscrits[slidePosition2['next3']+1],
    SlideInscrits[slidePosition2['next3']+2]
    ]
;

ThreefirstSlideInscrits.forEach(
    slide=>{
        slide.classList.add('carousel2__item--next3--visible');
        slide.classList.add('carousel2__item--prev3--visible');
    }
)

var ThreefirstSlideRate = [
    SlideRate[slidePosition2['next3']],
    SlideRate[slidePosition2['next3']+1],
    SlideRate[slidePosition2['next3']+2]
    ]
;

ThreefirstSlideRate.forEach(
    slide=>{
        slide.classList.add('carousel2__item--next4--visible');
        slide.classList.add('carousel2__item--prev4--visible');
    }
)

var pageInscrits = document.querySelectorAll('.icon-pagination2--next3')
var pageRate = document.querySelectorAll('.icon-pagination2--next4')

firstPageInscrits = pageInscrits[slidePosition2['next3']];
firstPageRate = pageRate[slidePosition2['next4']];

firstPageInscrits.classList.add('icon-pagination2--next3--activ');
firstPageInscrits.classList.add('icon-pagination2--prev3--activ');
firstPageRate.classList.add('icon-pagination2--next4--activ');
firstPageRate.classList.add('icon-pagination2--prev4--activ');
//////////////////////////////////////////////////////////////////////////////////////////////
const nexts2 = document.querySelectorAll('.carousel2__button--next')
const prevs2 = document.querySelectorAll('.carousel2__button--prev')

nexts2.forEach(
    next=>{
      next.addEventListener("click", function()
      {
          var id = next.id;
          Increment_or_Decrement_Slide2(id);
      })
    }
);

prevs2.forEach(
    prev=>{
      prev.addEventListener("click", function()
      {
        var id = prev.id;
        Increment_or_Decrement_Slide2(id);

      })
    }
);


function Increment_or_Decrement_Slide2(id) {

    var totalSlides = document.querySelectorAll('.carousel2__item--'+id).length ;
   // console.log('nb de slide total', totalSlides)
   // console.log('Précedente position slide :',slidePosition2[id])

    var NbSlideRestantes = totalSlides - slidePosition2[id]
   // console.log('Nb de slide restantes :',NbSlideRestantes)

    switch (id) {
        case 'next3':
            var decalage;
            if (totalSlides % 3 === 0)
            {
                 decalage = 3;
            } else {
                decalage = totalSlides % 3;
            }
            if (slidePosition2[id] === totalSlides - decalage  ) {
                console.log('ok')
                slidePosition2[id] = 0;
                slidePosition2['prev3'] = 0;
            }
            else if(NbSlideRestantes < 3) {
                slidePosition2[id] += 1;
                slidePosition2['prev3']  +=  1;
            } else{
                slidePosition2[id] += 3;
                slidePosition2['prev3']  +=  3;
            }
            break;
        case 'prev3':
            if (slidePosition2[id] === 0 ) {
                if (totalSlides % 3 === 0)
                {
                    slidePosition2[id] = totalSlides - 3;
                    slidePosition2['next3'] = totalSlides - 3;
                }else{
                    slidePosition2[id] = totalSlides - (totalSlides % 3);
                    slidePosition2['next3'] = totalSlides - (totalSlides % 3);
                }
            } else {
                slidePosition2[id] -= 3;
                slidePosition2['next3']  -=  3;
            }
           // console.log('slidePosition',slidePosition2[id],slidePosition2['next3'])
            break;
        case 'next4':
            var decalage;
            if (totalSlides % 3 === 0)
            {
                decalage = 3;
            } else {
                decalage = totalSlides % 3;
            }
            if (slidePosition2[id] === totalSlides - decalage  ) {
                console.log('ok')
                slidePosition2[id] = 0;
                slidePosition2['prev4'] = 0;
            }
            else if(NbSlideRestantes < 3) {
                slidePosition2[id] += 1;
                slidePosition2['prev4']  +=  1;
            } else{
                slidePosition2[id] += 3;
                slidePosition2['prev4']  +=  3;
            }
            break;
        case 'prev4':
            if (slidePosition2[id] === 0 ) {
                if (totalSlides % 3 === 0)
                {
                    slidePosition2[id] = totalSlides - 3;
                    slidePosition2['next4'] = totalSlides - 3;
                }else{
                    slidePosition2[id] = totalSlides - (totalSlides % 3);
                    slidePosition2['next4'] = totalSlides - (totalSlides % 3);
                }
            } else {
                slidePosition2[id] -= 3;
                slidePosition2['next4']  -=  3;
            }
            // console.log('slidePosition',slidePosition2[id],slidePosition2['next3'])
            break;
    }

    updateSlidePosition2(id);
    updatePagePosition2(id);
}

/////////////////////////////////////////////////////////////////////////////////////////
function updateSlidePosition2(id) {
    var totalSlides = document.querySelectorAll('.carousel2__item--'+id).length ;
    //console.log('nb de slide total', totalSlides)
   // console.log('Position slide :',slidePosition2[id])
    var previousSlides = document.querySelectorAll('.carousel2__item--'+id+'--visible')
   // console.log('previous slides',previousSlides)
    var slideAff = previousSlides.length;
    var NbSlideRestantes = totalSlides - slidePosition2[id] //  - celles qui sont affichées
    //console.log('Nb de slide restantes :',NbSlideRestantes)

    var newSlides = [];

    if (NbSlideRestantes >=3)
    {
        for(let i=0;i<3;i++)
        {
            var newSlide = document.querySelectorAll('.carousel2__item--'+id)[slidePosition2[id]+i]
            newSlides.push(newSlide)
        }
    }else{
        for(let i=0;i< NbSlideRestantes;i++)
        {
            var newSlide = document.querySelectorAll('.carousel2__item--'+id)[slidePosition2[id]+i]
            newSlides.push(newSlide)
        }
    }
//console.log('newSlides : ',newSlides)


   // var previousPage = document.querySelector('.icon-pagination--'+id+'--activ');
  //  var newsPage = document.querySelectorAll('.icon-pagination--'+id)[slidePosition[id]];
    switch (id) {
        case 'next3':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel2__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel2__item--prev3--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel2__item--'+id+'--visible');
                    newSlide.classList.add('carousel2__item--prev3--visible');
                }
            )


            break;
        case 'prev3':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel2__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel2__item--next3--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel2__item--'+id+'--visible');
                    newSlide.classList.add('carousel2__item--next3--visible');
                }
            )
            break;
        case 'next4':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel2__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel2__item--prev4--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel2__item--'+id+'--visible');
                    newSlide.classList.add('carousel2__item--prev4--visible');
                }
            )
            break;
        case 'prev4':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel2__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel2__item--next4--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel2__item--'+id+'--visible');
                    newSlide.classList.add('carousel2__item--next4--visible');
                }
            )
            break;
    }
    //console.log('///////////////////////////////////')
}



function updatePagePosition2(id){
    console.log(slidePosition2[id])
    console.log('position page',(slidePosition2[id] / 3) % 4 )
    const previousPage = document.querySelector('.icon-pagination2--'+id+'--activ');
   //console.log(previousPage)
    const newsPage = document.querySelectorAll('.icon-pagination2--'+id)[(slidePosition2[id] / 3) % 4];
   // console.log(newsPage)
    previousPage.classList.remove('.icon-pagination2--prev3--activ');
    switch (id) {
        case 'next3':
            previousPage.classList.remove('icon-pagination2--'+id+'--activ');
            previousPage.classList.remove('icon-pagination2--prev3--activ');
            newsPage.classList.add('icon-pagination2--'+id+'--activ');
            newsPage.classList.add('icon-pagination2--prev3--activ');
            break;
        case 'prev3':
            previousPage.classList.remove('icon-pagination2--'+id+'--activ');
            previousPage.classList.remove('icon-pagination2--next3--activ');

            newsPage.classList.add('icon-pagination2--'+id+'--activ');
            newsPage.classList.add('icon-pagination2--next3--activ');
            break;
        case 'next4':
            previousPage.classList.remove('icon-pagination2--'+id+'--activ');
            previousPage.classList.remove('icon-pagination2--prev4--activ');

            newsPage.classList.add('icon-pagination2--'+id+'--activ');
            newsPage.classList.add('icon-pagination2--prev4--activ');
            break;
        case 'prev4':
            previousPage.classList.remove('icon-pagination2--'+id+'--activ');
            previousPage.classList.remove('icon-pagination2--next4--activ');

            newsPage.classList.add('icon-pagination2--'+id+'--activ');
            newsPage.classList.add('icon-pagination2--next4--activ');

            break;
    }
    newsPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg> ';
    previousPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><defs><style>.a,.c{fill:none;}.a{stroke:#000;}.b{stroke:none;}</style></defs><g class="a"><circle class="b" cx="7" cy="7" r="7"/><circle class="c" cx="7" cy="7" r="6.5"/></g></svg> ';
}