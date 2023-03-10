jQuery(document).ready(function() {

	//AOS.init({
	//	disable: false,
	//});

	nbspBeforeSingleLetterWord();

	var $toggleButton = jQuery('.toggle-button:not(.click)'),

		$article = jQuery('.single #primary > main > article'),
		$hasThumbnail = $article.hasClass('has-post-thumbnail'),
		$isFrontpage = document.body.classList.contains('page-template-template-homepage'),
		$isShopPage = document.body.classList.contains('post-type-archive-product'),
		$isProductPage = document.body.classList.contains('single-product');


	$toggleButton.click(function(event){
		event.stopPropagation();
		jQuery(this).toggleClass('button-open');
		var $menuWrap = jQuery('.slide-out-pane.hidden').children('.menu-wrap')
		jQuery('.slide-out-pane.hidden').toggleClass('menu-show');
		$menuWrap.toggleClass('menu-show');
	});

	jQuery('.slide-out-pane').click(function(event){
		event.stopPropagation();
	});

	if($hasThumbnail || $isFrontpage){
		jQuery('.site-header').addClass('transparent');
	}

	jQuery('li.product a').on('hover', function() {
		jQuery(this).parent().toggleClass('hover');
	});

	jQuery(document).on('click', '.variations .value input[type=radio]', function(e) {
		var parent = jQuery(this).parents('.value')
		parent.find('label').removeClass('selected');
		jQuery(this).next('label').addClass('selected');
	});

	jQuery(document).on('click', '.reset_variations', function(e) {
		var parent = jQuery(this).parents('.value')
		parent.find('label').removeClass('selected');
	});
	
	jQuery('.back-to-top').click(function (){
		jQuery('html, body').animate({
			scrollTop: jQuery('#page').offset().top
		}, 300);
	});

	if($isProductPage){
		// Get the modal
		var modal = document.getElementById("sizeTableModal");
		// Get the button that opens the modal
		let btn = document.getElementById("sizeTableButton");
		// Get the <span> element that closes the modal
		let span = document.getElementById("closeSizeTable");
		// When the user clicks on the button, open the modal
		if(btn !== null){
			btn.onclick = function() {
				modal.style.display = "flex";
				document.body.classList.add('modal-open');
				modal.classList.add("show");
			}
		}
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.classList.remove("show");
			document.body.classList.remove('modal-open');
			modal.style.display = "none";
		}

	}

		// Get the modal
		var modalNewsletter = document.getElementById("newsletterModal");
		// Get the button that opens the modal
		//var btn = document.getElementById("sizeTableButton");
		// Get the <span> element that closes the modal
		var span = document.getElementById("close");
		var closeSuccess = document.getElementById("close-success");
		// When the user clicks on the button, open the modal
		var submit = document.getElementsByClassName("submit")[0];

		var newsletterButton = document.getElementById("newsletterButton");

		var nonactive;
		var fired = false;
		var override = false;

		
		['mousemove', 'touchmove', 'scroll'].forEach(function(e){
			if(!$isFrontpage && !$isShopPage){
				document.addEventListener(e,()=>{if (fired == false) showNewsletterModal(override, 5000)},false);
			}
		});

		if(newsletterButton !== null){
			newsletterButton.onclick = function(){
			override = true
			showNewsletterModal(override, 0);
		}}



		
		function showNewsletterModal(override, delay){
			
			var display_newsletter = localStorage["mb2020_newsletter"];
			if(!display_newsletter || override){
			console.log('active');
			clearTimeout(nonactive);
			nonactive = setTimeout(()=>{
				console.log('user is not active');
				modalNewsletter.style.display = "flex";
				document.body.classList.add('modal-open');
				modalNewsletter.classList.add("show");
				fired = true;
			}, delay);
			}
		}



		// When the user clicks on <span> (x), close the modal
		if(span) {
			span.onclick = function() {
				modalNewsletter.classList.remove("show");
				modalNewsletter.style.display = "none";
				document.body.classList.remove('modal-open');
				localStorage["mb2020_newsletter"]=0;
			}
		}
		// When the user clicks on <span> (x), close the modal
		if(closeSuccess) {
			closeSuccess.onclick = function() {
				modalNewsletter.classList.remove("show");
				modalNewsletter.style.display = "none";
				document.body.classList.remove('modal-open');
				localStorage["mb2020_newsletter"]=0;
			}
		}
		if(submit) {
			submit.onclick = function() {
				localStorage["mb2020_newsletter"]=0;
				//add hiding of modal after timeout
			}
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.classList.remove("show");
				document.body.classList.remove('modal-open');
				modal.style.display = "none";
			} else if (event.target == modalNewsletter) {
				modalNewsletter.classList.remove("show");
				modalNewsletter.style.display = "none";
				document.body.classList.remove('modal-open');

				localStorage["mb2020_newsletter"]=0;
			}
		}
	
});

function nbspBeforeSingleLetterWord() {
	var letters = ["a", "A", "i", "I", "o", "O", "u", "U", "w", "W", "z", "Z", "e", "E", "a??", "A??", "bo", "Bo", "by", "By", "i??", "I??", "ni", "Ni", "??e", "??e", "do", "Do", "ku", "Ku", "na", "Na", "od", "Od", "po", "Po", "we", "We", "za", "Za", "ze", "Ze", "h??", "H??", "no", "No", "ot", "Ot", "aa", "Aa", "aj", "Aj", "am", "Am", "au", "Au", "ba", "Ba", "ee", "Ee", "eh", "Eh", "ej", "Ej", "fe", "Fe", "fi", "Fi", "fi", "Fi", "fu", "Fu", "ha", "Ha", "he", "He", "ho", "Ho", "ii", "Ii", "oj", "Oj", "oo", "Oo", "ot", "Ot", "o??", "O??", "pa", "Pa", "uf", "Uf", "uu", "Uu", "co", "Co", "ki", "Ki", "se", "Se", "ja", "Ja", "ty", "Ty", "ci", "Ci", "on", "On", "mu", "Mu", "go", "Go", "o??", "O??", "j??", "J??", "my", "My", "wy", "Wy", "im", "Im", "je", "Je", "ma", "Ma", "m??", "M??", "me", "Me", "??w", "??w", "ta", "Ta", "t??", "T??", "t??", "T??", "to", "To", "te", "Te", "tu", "Tu", "al", "Al", "ar", "Ar", "as", "Aa", "at", "At", "bi", "Bi", "er", "Er", "es", "Es", "ew", "Ew", "ez", "Ez", "go", "Go", "id", "Id", "i??", "I??", "iw", "Iw", "li", "Li", "ok", "Ok", "om", "Om", "op", "Op", "or", "Or", "os", "Os", "o??", "O??", "oz", "Oz", "??d", "??d", "??s", "??s", "su", "Su", "ud", "Ud", "ul", "Ul", "ut", "Ut", "je", "Je", "ma", "Ma", "s??", "S??", "lub", "Lub", "ale", "Ale", "czy", "Czy", "nad", "Nad", "pod", "Pod", "bez", "Bez", "nie", "Nie", "tak", "Tak", "albo", "Albo", "wi??c", "Wi??c", "lecz", "Lecz", "przez", "Przez", "niech", "Niech", "tylko", "Tylko"];
	for (var i=0,  total = letters.length; i < total; i++) {
		var char = (letters[i]); 
		jQuery('p').each(function() {
			var text = jQuery(this).html();
			jQuery(this).html(text.replace(new RegExp(' '+char+' ', 'g') , ' '+char+'&nbsp;'));
		});
	}
}