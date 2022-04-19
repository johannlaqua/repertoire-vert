console.log("HELLO");
var slidePosition ={
    'next':0,
    'prev':0
}
var SlideTemoignages = document.querySelectorAll('.carousel__item--next')
//console.log(SlideTemoignages)
var TwofirstSlideTemoignages= [
    SlideTemoignages[slidePosition['next']],
    SlideTemoignages[slidePosition['next']+1]
    ]
//console.log(TwofirstSlideTemoignages)
TwofirstSlideTemoignages.forEach(
    slide=>{
        slide.classList.add('carousel__item--next--visible');
        slide.classList.add('carousel__item--prev--visible');
    }
)

// LES ICONES SVG
var pageTemoignages = document.querySelectorAll('.icon-pagination--next')
firstPageTemoignages = pageTemoignages[slidePosition['next']];

firstPageTemoignages.classList.add('icon-pagination--next--activ');
firstPageTemoignages.classList.add('icon-pagination--prev--activ');
//////////////////////////////////////////////////////////////////////////////////////////////
const next = document.querySelector('.carousel__button--next')
const prev = document.querySelector('.carousel__button--prev')
console.log(next,prev)

next.addEventListener("click", function()
{
    var id = next.id;
    Increment_or_Decrement_Slide(id);
})
prev.addEventListener("click", function()
{
    var id = prev.id;
    Increment_or_Decrement_Slide(id);
})
function Increment_or_Decrement_Slide(id) {

    var totalSlides = document.querySelectorAll('.carousel__item--'+id).length ;
    // console.log('nb de slide total', totalSlides)
    // console.log('Précedente position slide :',slidePosition[id])

    var NbSlideRestantes = totalSlides - slidePosition[id]
     //console.log('Nb de slide restantes :',NbSlideRestantes)

    switch (id) {
        case 'next':
            console.log('On a cliqué sur  ',id);
            console.log('Position slide :',slidePosition[id])
            var decalage;
            if (totalSlides % 2 === 0)
            {
                decalage = 2;
            } else {
                decalage = totalSlides % 2;
            }

            if (slidePosition[id] === totalSlides - decalage  ) {
                console.log('Decalage')
                slidePosition[id] = 0;
                slidePosition['prev'] = 0;
            }
            else if(NbSlideRestantes < 2) {
                slidePosition[id] += 1;
                slidePosition['prev']  +=  1;
            } else{
                slidePosition[id] += 2;
                slidePosition['prev']  +=  2;
            }
            break;
        case 'prev':
            console.log('On a cliqué sur  ',id);
            console.log('Position slide :',slidePosition[id])
            if (slidePosition[id] === 0 ) {
                if (totalSlides % 2 === 0)
                {
                    slidePosition[id] = totalSlides - 2;
                    slidePosition['next'] = totalSlides - 2;
                }else{
                    slidePosition[id] = totalSlides - (totalSlides % 2);
                    slidePosition['next'] = totalSlides - (totalSlides % 2);
                }
            } else {
                slidePosition[id] -= 2;
                slidePosition['next']  -=  2;
            }
            break;
    }
    updateSlidePosition(id);
    updatePagePosition(id);
}
/////////////////////////////////////////////////////////////////////////////////////////
function updateSlidePosition(id) {
    var totalSlides = document.querySelectorAll('.carousel__item--'+id).length ;
    //console.log('nb de slide total', totalSlides)
    // console.log('Position slide :',slidePosition[id])
    var previousSlides = document.querySelectorAll('.carousel__item--'+id+'--visible')
    // console.log('previous slides',previousSlides)
    var slideAff = previousSlides.length;
    var NbSlideRestantes = totalSlides - slidePosition[id] //  - celles qui sont affichées
    //console.log('Nb de slide restantes :',NbSlideRestantes)

    var newSlides = [];

    if (NbSlideRestantes >=2)
    {
        for(let i=0;i<2;i++)
        {
            var newSlide = document.querySelectorAll('.carousel__item--'+id)[slidePosition[id]+i]
            newSlides.push(newSlide)
        }
    }else{
        for(let i=0;i< NbSlideRestantes;i++)
        {
            var newSlide = document.querySelectorAll('.carousel__item--'+id)[slidePosition[id]+i]
            newSlides.push(newSlide)
        }
    }
//console.log('newSlides : ',newSlides)


    // var previousPage = document.querySelector('.icon-pagination--'+id+'--activ');
    //  var newsPage = document.querySelectorAll('.icon-pagination--'+id)[slidePosition[id]];
    switch (id) {
        case 'next':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel__item--prev--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel__item--'+id+'--visible');
                    newSlide.classList.add('carousel__item--prev--visible');
                }
            )


            break;
        case 'prev':
            previousSlides.forEach(
                previousSlide=>{
                    previousSlide.classList.remove('carousel__item--'+id+'--visible');
                    previousSlide.classList.remove('carousel__item--next--visible');
                }
            )
            newSlides.forEach(
                newSlide=>{
                    newSlide.classList.add('carousel__item--'+id+'--visible');
                    newSlide.classList.add('carousel__item--next--visible');
                }
            )
            break;
    }
    console.log('///////////////////////////////////')
}
///////////////////////////////////////////////:::
function updatePagePosition(id){
    console.log(slidePosition[id])
    console.log('position page',(slidePosition[id] / 2) % 3 )
    const previousPage = document.querySelector('.icon-pagination--'+id+'--activ');
    //console.log(previousPage)
    const newsPage = document.querySelectorAll('.icon-pagination--'+id)[(slidePosition[id] / 2) % 3];
    // console.log(newsPage)
    previousPage.classList.remove('.icon-pagination--prev--activ');
    switch (id) {
        case 'next':
            previousPage.classList.remove('icon-pagination--'+id+'--activ');
            previousPage.classList.remove('icon-pagination--prev--activ');
            newsPage.classList.add('icon-pagination--'+id+'--activ');
            newsPage.classList.add('icon-pagination--prev--activ');
            break;
        case 'prev':
            previousPage.classList.remove('icon-pagination--'+id+'--activ');
            previousPage.classList.remove('icon-pagination--next--activ');

            newsPage.classList.add('icon-pagination--'+id+'--activ');
            newsPage.classList.add('icon-pagination--next--activ');
            break;
    }
    newsPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><circle cx="7" cy="7" r="7"/></svg> ';
    previousPage.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><defs><style>.a,.c{fill:none;}.a{stroke:#000;}.b{stroke:none;}</style></defs><g class="a"><circle class="b" cx="7" cy="7" r="7"/><circle class="c" cx="7" cy="7" r="6.5"/></g></svg> ';
}