const toggleButton = document.getElementById("toggle-button");
const mainMenu = document.querySelector(".main-menu");
const dropBox = document.querySelector(".dropbox");
// function handleNavMenu(){
//     // if(mainMenu.classList.contains('show-menu')){
//     //     mainMenu.classList.remove('show-menu')
//     // }else{
//     //     mainMenu.classList.add('show-menu')
//     // }
//     mainMenu.classList.toggle('show-menu')
// }

// Events
console.log(document.getElementById('name'))
document.getElementById('name').addEventListener('input', (e)=>{
    console.log(e);
    console.log(e.target.value);
})
toggleButton.addEventListener("click", (event) => {
    console.log(event);
    mainMenu.classList.toggle("show-menu");
});
// document.querySelector('form').addEventListener('submit', (e)=>{
//     // e.preventDefault();
//     console.log(e);
//     e.target.submit()
// })
document.getElementById('form-submit').addEventListener('click', (e)=>{
    e.preventDefault()
    console.log(e);
    document.getElementById('form-submit').click()
    e.stopPropagation()
})
toggleButton.addEventListener("mouseover", (event) => {
    console.log("mosueover");
    console.log(event);
});
toggleButton.addEventListener("mouseout", (event) => {
    console.log("mosueover");
    console.log(event);
});
toggleButton.addEventListener("mouseup", (event) => {
    console.log("mouseup");
    console.log(event);
});
toggleButton.addEventListener("mousemove", (event) => {
    console.log("mousemove");
    console.log(event);
});
toggleButton.addEventListener("mousedown", (event) => {
    console.log("mousedown");
    console.log(event);
});
toggleButton.addEventListener("focus", (event) => {
    console.log("focus");
    console.log(event);
});
toggleButton.addEventListener("blur", (event) => {
    console.log("blur");
    console.log(event);
});
toggleButton.addEventListener("submit", (event) => {
    console.log("submit");
    console.log(event);
});

toggleButton.addEventListener("keydown", (event) => {
    console.log("keydown");
    console.log(event);
});
toggleButton.addEventListener("keyup", (event) => {
    console.log("keyup");
    console.log(event);
});
toggleButton.addEventListener("resize", (event) => {
    console.log("resize");
    console.log(event);
});
toggleButton.addEventListener("load", (event) => {
    console.log("load");
    console.log(event);
});
toggleButton.addEventListener("unload", (event) => {
    console.log("unload");
    console.log(event);
});
toggleButton.addEventListener("change", (event) => {
    console.log("change");
    console.log(event);
});
toggleButton.addEventListener("keypress", (event) => {
    console.log("keypress");
    console.log(event);
});
toggleButton.addEventListener("bind", (event) => {
    console.log("bind");
    console.log(event);
});
toggleButton.addEventListener("dblclick", (event) => {
    console.log("dblclick");
    console.log(event);
});

toggleButton.addEventListener("fullscreenchange", (event) => {
    console.log("fullscreenchange");
    console.log(event);
});
toggleButton.addEventListener("wheel", (event) => {
    console.log("wheel");
    console.log(event);
});
document.getElementById('toggle-button2').addEventListener("drag", (event) => {
    console.log("drag");
    console.log(event);
});
dropBox.addEventListener("drop", (event) => {
    console.log("drop");
    console.log(event);
});
dropBox.addEventListener("dragenter", (event) => {
    console.log("change");
    console.log(event);
    dropBox.style.backgroundColor = "red";
});
dropBox.addEventListener("dragleave", (event) => {
    console.log("keypress");
    console.log(event);
    dropBox.style.backgroundColor = "";
});
toggleButton.addEventListener("dragover", (event) => {
    console.log("bind");
    console.log(event);
});
toggleButton.addEventListener("dragstart", (event) => {
    console.log("dragstart");
    console.log(event);
});
toggleButton.addEventListener("dragend", (event) => {
    console.log("dragend");
    console.log(event);
});
toggleButton.addEventListener("input", (event) => {
    console.log("input");
    console.log(event);
});
toggleButton.addEventListener("sroll", (event) => {
    console.log("sroll");
    console.log(event);
});
