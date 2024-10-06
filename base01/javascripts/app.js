// Get an element
// How many way we get an element
const method1 = document.getElementById("root");
const method2 = document.getElementsByTagName("div");
const method3 = document.getElementsByClassName("update-components-carousel-job__content");
const method4 = document.getElementsByName("name");
const method5 = document.querySelector("#name");
const method6 = document.querySelectorAll("[type=email]");
const method7 = document.querySelectorAll("input");
console.log(method1);
console.log(method2);
console.log(method3);
console.log(method4);
console.log(method5);
console.log(method6);

method1.style.backgroundColor = "red";
// method2.style.color = 'blue' // app.js:17 Uncaught TypeError: Cannot set properties of undefined (setting 'color') at app.js:17:21
method2[0].style.color = "blue"; // NO error
console.log(method2.length);
for (let index = 0; index < method2.length; index++) {
    const element = method2[index];
    console.log(element)
    element.style.border = '1px solid black'
}
console.log(typeof method3);
const method3type = Object.entries(method3);
Object.entries(method3).forEach((element) => {
  // element => {} es6 method
  console.log(element);
});
console.log(method3type);
const list = ["ok", "boss"];
list.forEach((element) => {
  // element => {} es6 method
  console.log(element);
});

Object.entries(method3).map((element, i) => {
  console.log(element, i);
});
Object.values(method3).map(function (element, i) {
      console.log(element, i);
});


