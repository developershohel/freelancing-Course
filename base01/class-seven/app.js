// Select by ID	
//document.getElementById("id")	//$("#id")
document.getElementById("toggle-button").style.display = 'block';
document.getElementById("toggle-button").style.color = '#ff00ff';
const toggleButton = document.getElementById('toggle-button');
toggleButton.style.fontSize = '30px';
console.log(toggleButton);

//Select First Match	
const button2 = document.querySelector('.toggle-button');
button2.style.padding = '15px';
console.log(button2);

//Select All Matches	
const allElement = document.querySelectorAll(".menu-link")	// $(".class")
console.log(allElement);

for(let s=0; s < allElement.length; s++){
    const menuLink = allElement[s];
    menuLink.style.padding = '4px 24px';
    menuLink.style.background = '#ffff00';
    menuLink.style.color = '#000000';
}

// document.querySelector(".class")	// $(".class").first()
// Select by Class	
let button3 = document.getElementsByClassName('navigation');
console.log(button3);

//document.getElementsByClassName("class")	//$(".class")
// Select by Tag	
const header = document.getElementsByTagName("div")	//$("tag")
console.log(header);
const togglebutton4 = header[1];
header[1].style.background = '#ff0000';

togglebutton4.style.margin = '5px';


const meta = $("[name=viewport]");
console.log(meta.attr('content'));
