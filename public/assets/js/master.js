// select skills selector

let MySkills = document.querySelector(".skills");

window.onscroll = function(){

    // skills offset Top

    let skillsOffsetTop = MySkills.offsetTop;

    //skills outer height

    let skillsOuterHeight = MySkills.offsetHeight;

    // Window Height

    let windowHeight = this.innerHeight;

    // window scroll top

    let windowScrollTop = this.pageYOffset;

    if (windowScrollTop > (skillsOffsetTop  + skillsOuterHeight - windowHeight))  {

        let allSkills = document.querySelectorAll(".skill-box .skill-progress span");

        allSkills.forEach(skill => {

            skill.style.width = skill.dataset.progress;
        });


    }

};

// create popup with the the image

let ourGallery = document.querySelectorAll(".gallery img");
ourGallery.forEach(img =>{

    img.addEventListener('click',(e)=>{

        //cretate overlay element
        let overlay = document.createElement("div");

        //add class to overlay
        overlay.className = 'popup-overlay';

        //append overlay to body
        document.body.appendChild(overlay);

        //create popup
        let popupBox =document.createElement("div");
        popupBox.className ='popup-box';

        if (img.alt !== null) {

            //create heading
            let imgHeading =document.createElement("h3");

            // create text for heading
            let imgText = document.createTextNode(img.alt);

            //appent the text to the heading
            imgHeading.appendChild(imgText);

            //Append the heading to the popup box
            popupBox.appendChild(imgHeading);


        }
        //create the image
        let popupImage =document.createElement("img");

        //set image source
        popupImage.src = img.src;

        //add image to popup box
        popupBox.appendChild(popupImage);

        //append the popupBox to the body
        document.body.appendChild(popupBox);

        //create the close Span
        let closeButton = document.createElement("span");

        //create the closeButtonText
        let closeButtonText = document.createTextNode("x");

        //append the text to the close button
        closeButton.appendChild(closeButtonText);

        //add class to the close button
        closeButton.className = 'close-button';

        // add close button to the popup box

        popupBox.appendChild(closeButton);

    });

});
// close popup
document.addEventListener("click",function(e){

    if (e.target.className =='close-button') {

        //remove the current popup
        e.target.parentNode.remove();

        //remove overlay
        document.querySelector(".popup-overlay").remove();
    }

});

// Toggle menu

let togglebtn = document.querySelector(".toggle-menu");
let tlinks = document.querySelector(".links");

togglebtn.onclick = function (e)
{
    e.stopPropagation();
    this.classList.toggle("menu-active");
    tlinks.classList.toggle("open");

};

// click Anywhere outside menu and toggle button
document.addEventListener("click",(e)=>{

    if (e.target!==togglebtn && e.target !== tlinks) {
        //check if menu is open
        if (tlinks.classList.contains("open")) {
            togglebtn.classList.toggle("menu-active");
            tlinks.classList.toggle("open");
        }
    }


});
tlinks.onclick =function (e) {
    e.stopPropagation();
};

// select all links

let allLinks = document.querySelectorAll(".links a , button a");

// select all bullets

let allBullets = document.querySelectorAll(".nav-bullets .bullet");

function ScrollToSomeWhere(elements) {
    // select all links

elements.forEach(ele =>{

  ele.addEventListener("click",(e)=>{

    e.preventDefault();

    document.querySelector(e.target.dataset.section).scrollIntoView({

        behavior :'smooth'


    });
  });
});


}

ScrollToSomeWhere(allLinks);
ScrollToSomeWhere(allBullets);

// handle active states

function handleActive(ev) {


    ev.target.parentElement.querySelectorAll(".active").forEach(element =>{

        element.classList.remove("active");
    });


        ev.classList.add("active");
}

// randomly background

//select landing-nav element

let landingNav = document.querySelector(".landing-nav");

// get array of images

