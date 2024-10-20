const formToggleButton = document.getElementById('show-form')
const result = document.getElementById('result')
// Main Method one
const form = document.getElementById('myForm')
formToggleButton.addEventListener('click', function(e){
    e.preventDefault()
    // Method two
    // if(form.classList.contains('open')){
    //     form.classList.remove('open')
    // }else{
    //     form.classList.add('open')
    // }
    // Method Two
    // form.classList.toggle('open')
    // Method three
    if(form.style.display === 'block'){
        form.style.display = 'none'
    }else{
        form.style.display = 'block'
    }
})

const formSubmitButton = document.getElementById('form-submit')
// mouse events
formSubmitButton.addEventListener('mouseenter', function(){
    this.style.backgroundColor = '#1223ff'
})
formSubmitButton.addEventListener('mouseleave', function(){
    this.style.backgroundColor = ''
})

// formSubmitButton.addEventListener('mouseover', function(){
//     this.style.backgroundColor = '#1223ff'
// })

// formSubmitButton.addEventListener('mouseout', function(){
//     this.style.backgroundColor = ''
// })

// formSubmitButton.addEventListener('mousemove', function(){
//     this.style.backgroundColor = '#1223ff'
// })
// formSubmitButton.addEventListener('mousedown', function(){
//     this.style.backgroundColor = ''
// })

const iceCream = form.querySelector('.ice-cream')

iceCream.addEventListener('change', handleIceCream, true)

function handleIceCream(e){
    console.log(this.value);
    console.log(e.target.value)
    // result.append(e.target.value)
    result.innerHTML = `<p>${this.value}</p>`
}

const inputField = document.getElementById('myInput')
// Inpupt event
// Event one
inputField.addEventListener('change', handleIceCream)
inputField.addEventListener('input', handleInputEvent)
function handleInputEvent(e){
    result.innerHTML = `<p>${this.value}</p>`
}

// focus
formSubmitButton.addEventListener('click', function(e){
    e.preventDefault()
    if(inputField.value === ''){
        inputField.focus()
        return false;
    }
    console.log('afer return')
})
inputField.addEventListener('focus', function(e){
    handleFormStyle(e.target, [{type: 'border', value:'1px solid blue'}, {type: 'display', value: 'flex'}])
})

function handleFormStyle(element, value = []){
    if(value.length > 0){
        for (let index = 0; index < value.length; index++) {
            if(value[index].type === 'border'){
                element.style.border = value[index].value
            }
        }
    }
}

// Create element
const inputEmail = document.createElement('input') // only tag name
handleFormAttribute(inputEmail, [{attr: 'type', val: 'email'},{attr: 'id', val: 'emial'}, {attr: 'class', val: 'form-control'}])
inputField.after(inputEmail)

function handleFormAttribute(element, value = []){
    if(value.length > 0){
        for (let index = 0; index < value.length; index++) {
            element.setAttribute(value[index].attr, value[index].val)
        }
    }
}