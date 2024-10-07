// Single Element select
const singleElementOne = "boss";
let index = 10;
var mixValue = "ok";
console.log(singleElementOne);
console.log(index);
console.log(mixValue);

function optonal(params) {
    const singleElementTwo = "boss 2";
    let indexTwo = 5;
    var mixValueTwo = "ok 2";
    console.log(singleElementTwo);
    console.log(indexTwo);
    console.log(mixValueTwo);
}

optonal();

function withoutParams() {
    const singleElementOne = "boss 3";
    index = 7;
    let mixValue = "ok 3";
    console.log(singleElementOne);
    index = 9;
    console.log(index);
    console.log(mixValue);
}
console.log(index);
withoutParams();


// Single element
const singleValueOne = document.getElementById('name')
const singleValueTwo = document.querySelector('#input')
console.log(singleValueOne)
console.log(singleValueTwo)
// Always select one value
// javascript apply function and style only single value

// All elements 
const allElementOne = document.getElementsByTagName('input')
const allElementTwo = document.getElementsByClassName('any class name')
const allElementThree = document.getElementsByName('password')
const allElementFour = document.querySelectorAll('input[type=text]')
const form = document.querySelector('.singup-form')
const formInput = form.getElementsByTagName('input')
console.log(formInput)
console.log(allElementOne)
const emailField = formInput[3]
emailField.style.color = 'red'

for (let index = 1; index < allElementOne.length; index++) {
    const element = allElementOne[index];
    console.log(element)
    
}

