let divInput = document.getElementsByClassName("div-input");
let inputSpan = document.getElementsByClassName("input-span");
let spannedInput = document.getElementsByClassName("spanned-input");
let entrar = document.getElementById("entrar");
let warning = document.getElementsByClassName("warning");

if(!spannedInput[0].value){
	inputSpan[0].style.top = "14px";
	inputSpan[0].style.fontSize = "16px";
}


if(!spannedInput[1].value){
	inputSpan[1].style.top = "14px";
	inputSpan[1].style.fontSize = "16px";
}

spannedInput[0].addEventListener("animationstart", function(){
    inputSpan[0].style.top = "2px";
	inputSpan[0].style.fontSize = "10px";
	
	inputSpan[1].style.top = "2px";
	inputSpan[1].style.fontSize = "10px";
})

spannedInput[0].addEventListener("input", spannedInputInput);
spannedInput[1].addEventListener("input", spannedInputInput);


entrar.addEventListener("mousedown", entrarDown);
entrar.addEventListener("mouseup", entrarUp);
entrar.addEventListener("touchstart", entrarDown);
entrar.addEventListener("touchend", entrarUp);
entrar.submitForm = document.getElementById("access-form");

for(let i = 0; i < divInput.length; i++){
	divInput[i].input = spannedInput[i];
	divInput[i].addEventListener("click", clickDivInput);

	spannedInput[i].span = inputSpan[i];
	spannedInput[i].warning = warning[i];
	spannedInput[i].addEventListener("focus", spannedInputFocusin);
	spannedInput[i].addEventListener("blur", spannedInputFocusout);
	spannedInput[i].addEventListener("click", removeWarning);
}

function clickDivInput(event){
	event.currentTarget.input.focus();
}

function spannedInputFocusin(event){
	let input = event.currentTarget;

	input.span.style.top = "2px";
	input.span.style.fontSize = "10px";
}

function spannedInputFocusout(event){
	let input = event.currentTarget;

	if(!input.value)
	{
		input.span.style.top = "14px";
		input.span.style.fontSize = "16px";
	}
}

function entrarDown(event){
	let entrar = event.currentTarget;

	entrar.style.backgroundColor = "rgba(30, 185, 160, 1)";
	entrar.style.fontSize = "14px";
}

function entrarUp(event){
	let entrar = event.currentTarget;

	entrar.style.backgroundColor = "rgba(170, 230, 230, 1)";
	entrar.style.fontSize = "16px";
	entrar.submitForm.submit();
}

function spannedInputInput(event)
{
	let input = event.currentTarget;

	if(input.value){
		input.span.style.top = "2px";
		input.span.style.fontSize = "10px";
	}
	else
	{
		input.span.style.top = "14px";
		input.span.style.fontSize = "16px";
	}
}