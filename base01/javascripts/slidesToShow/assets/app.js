const carousel = document.querySelector(".carousel");
const nextButton = document.querySelector(".angle-right");
const prevButton = document.querySelector(".angle-left");
const dragging = function (e) {
    carousel.scrollLeft = e.pageX;
};
carousel.addEventListener("mousemove", dragging);
Object.values(carousel.children).map(function (item) {
    item.addEventListener("mouseenter", function () {
        const prevActiveClass = item.parentElement.querySelectorAll(".active");
        Object.values(prevActiveClass).map(function (item) {
            item.classList.remove("active");
        });
        this.classList.add("active");
        nextButton.removeAttribute("disabled");
        prevButton.removeAttribute("disabled");
    });
});

nextButton.addEventListener("click", (e) => {
    const activeImg = carousel.querySelector(".active");
    const currentCsPos = carousel.scrollLeft;
    const x = activeImg.clientWidth;
    carousel.scrollLeft = currentCsPos + x;
    activeImg.classList.remove("active");
    console.log(activeImg.nextElementSibling);
    if (activeImg.nextElementSibling) {
        activeImg.nextElementSibling.classList.add("active");
    } else {
        nextButton.setAttribute("disabled", true);
    }
});

prevButton.addEventListener("click", (e) => {
    const activeImg = carousel.querySelector(".active");
    const currentCsPos = carousel.scrollLeft;
    const x = activeImg.clientWidth;
    const currentX= currentCsPos - x;
    carousel.scrollTo({left: currentX, behavior: 'smooth'})
    activeImg.classList.remove("active");
    console.log(activeImg.nextElementSibling);
    if (activeImg.nextElementSibling) {
        activeImg.nextElementSibling.classList.add("active");
    } else {
        nextButton.setAttribute("disabled", true);
    }
});
