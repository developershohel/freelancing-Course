const vjHeading = document.getElementById('boss');
const jHeading = $('#boss');

const vjHeadingText = vjHeading.textContent;
console.log(vjHeadingText);
vjHeading.textContent = 'Hello how are you?';
console.log(vjHeading.textContent);

const jHeadingText = jHeading.text();
console.log(jHeadingText);
jHeading.text('This is coming form jquery');
console.log(jHeading.text());

jHeading.attr('title', 'this is title');
jHeading.css({"color": "red", opacity: 0.8, textDecoration: 'underline'});
document.getElementsByClassName('event-button')[0].textContent = 'click me 2';
jQuery('.event-button').text( 'Click me');
console.log(jQuery('#event-button'));

const eventButton = $('#event-button');
const counter = $('#counter');

eventButton.on('click', function(e){
    counter.text(parseInt(counter.text()) + 1)
});

// eventButton.on('mouseover', (e)=>{
//     console.log($(this));

//     $(this).css('display', 'none')
// });

eventButton.on('mouseover', function (e){
    $(this).css({opacity: 0.8})
});

eventButton.on('mouseout', function (e){
    console.log($(this));
    $(this).css({opacity: 1})
});

$(window).on('mousemove', function(e){
    console.log(e);
    
})

jHeading.on('dblclick', function(){
    $(this).hide();
})

$('#hover-event-button').hover(function(){
    $(this).css({backgroundColor: '#00aa00'})
}, function(){
    $(this).css({backgroundColor: "#00ff00"})
})

