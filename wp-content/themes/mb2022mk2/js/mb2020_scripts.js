jQuery(document).ready(function() {

	AOS.init({
		disable: false,
	});

	nbspBeforeSingleLetterWord();

	var $toggleButton = jQuery('.toggle-button:not(.click)'),
		$toggleFilterButton = jQuery('.toggle-filter-button'),
		$menuWrap = jQuery('.slide-out-pane.right'),
		$body = jQuery('body'),
		$article = jQuery('.single #primary > main > article'),
		$hasThumbnail = $article.hasClass('has-post-thumbnail'),
		$isFrontpage = document.body.classList.contains('page-template-template-homepage'),
		$isBio = document.body.classList.contains('page-template-template-bio'),
		$isContact = document.body.classList.contains('page-template-template-contact'),
		$isShopPage = document.body.classList.contains('post-type-archive-product'),
		$isProductPage = document.body.classList.contains('single-product');

	if (window.screen.availWidth <= 768) {
		console.log('smaller than 768px');
		$toggleFilterButton.css('display', 'block');
		jQuery('.slide-out-pane.right .menu-wrap').css('overflow', 'hidden');
		$menuWrap.detach().appendTo('.storefront-sorting');
	}

	$toggleButton.click(function(event){
		event.stopPropagation();
		jQuery(this).toggleClass('button-open');
		var $menuWrap = jQuery('.slide-out-pane.hidden').children('.menu-wrap')
		jQuery('.slide-out-pane.hidden').toggleClass('menu-show');
		$menuWrap.toggleClass('menu-show');
	});

	$toggleFilterButton.on('click', function() {
		console.log('mouse clicked toggle button');
		jQuery('.slide-out-pane.right').slideToggle("slow", function() {
			// Animation complete.
		});		
		$menuWrap.toggleClass('menu-show');
	});
	
	$toggleFilterButton.click(function(event){
		event.stopPropagation();
	});

	jQuery('.slide-out-pane').click(function(event){
		event.stopPropagation();
	});

	if($hasThumbnail || $isFrontpage){
		jQuery('.site-header').addClass('transparent');
	}

	if(!$isFrontpage && !$isBio && !$isContact && !is_touch_device4()){
		jQuery('.menu-wrap').addClass('menu-show');
		jQuery('.toggle-button').addClass('button-open');
	}

	if($isFrontpage){
		videoFallback();
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
    
    jQuery('.cookies-more-info').click(function() {
		alert("Strona korzysta z plików cookie. Wykorzystywane są one m.in. do zapamiętywania ustawień oraz zbierania danych statystycznych. Jeśli nie chcesz korzystać z plików cookie, proszę opuść tę stronę.");
    }); 
 
    jQuery('.cookies-close').click(function() {
		localStorage["mb2020_cookies"]=0;
		cookies_info();
    });    

	cookies_info();

	jQuery('.ebook-close, .ebook-link').click(function() {
		localStorage["mb2020_ebook"]=0;
		ebook_info();
    });    

	ebook_info();

	jQuery('.ebook').on('mouseover', function() {
		jQuery(this).addClass('showing');
		jQuery(this).removeClass('hidding');

	});

	jQuery('.ebook').on('mouseout', function() {
		var display_ebook = localStorage["mb2020_ebook"];
		if(display_ebook==0){
			setTimeout(function(){ 		
				jQuery('#ebook-link').removeClass('showing');
				jQuery('#ebook-link').addClass('hidding');	
			}, 1500);
		}

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
	var letters = ["a", "A", "i", "I", "o", "O", "u", "U", "w", "W", "z", "Z", "e", "E", "aż", "Aż", "bo", "Bo", "by", "By", "iż", "Iż", "ni", "Ni", "że", "Że", "do", "Do", "ku", "Ku", "na", "Na", "od", "Od", "po", "Po", "we", "We", "za", "Za", "ze", "Ze", "hę", "Hę", "no", "No", "ot", "Ot", "aa", "Aa", "aj", "Aj", "am", "Am", "au", "Au", "ba", "Ba", "ee", "Ee", "eh", "Eh", "ej", "Ej", "fe", "Fe", "fi", "Fi", "fi", "Fi", "fu", "Fu", "ha", "Ha", "he", "He", "ho", "Ho", "ii", "Ii", "oj", "Oj", "oo", "Oo", "ot", "Ot", "oż", "Oż", "pa", "Pa", "uf", "Uf", "uu", "Uu", "co", "Co", "ki", "Ki", "se", "Se", "ja", "Ja", "ty", "Ty", "ci", "Ci", "on", "On", "mu", "Mu", "go", "Go", "oń", "Oń", "ją", "Ją", "my", "My", "wy", "Wy", "im", "Im", "je", "Je", "ma", "Ma", "mą", "Mą", "me", "Me", "ów", "Ów", "ta", "Ta", "tę", "Tę", "tą", "Tą", "to", "To", "te", "Te", "tu", "Tu", "al", "Al", "ar", "Ar", "as", "Aa", "at", "At", "bi", "Bi", "er", "Er", "es", "Es", "ew", "Ew", "ez", "Ez", "go", "Go", "id", "Id", "ił", "Ił", "iw", "Iw", "li", "Li", "ok", "Ok", "om", "Om", "op", "Op", "or", "Or", "os", "Os", "oś", "Oś", "oz", "Oz", "ód", "Ód", "ós", "Ós", "su", "Su", "ud", "Ud", "ul", "Ul", "ut", "Ut", "je", "Je", "ma", "Ma", "są", "Są", "lub", "Lub", "ale", "Ale", "czy", "Czy", "nad", "Nad", "pod", "Pod", "bez", "Bez", "nie", "Nie", "tak", "Tak", "albo", "Albo", "więc", "Więc", "lecz", "Lecz", "przez", "Przez", "niech", "Niech", "tylko", "Tylko"];
	for (var i=0,  total = letters.length; i < total; i++) {
		var char = (letters[i]); 
		jQuery('p').each(function() {
			var text = jQuery(this).html();
			jQuery(this).html(text.replace(new RegExp(' '+char+' ', 'g') , ' '+char+'&nbsp;'));
		});
	}
}

function is_touch_device4() {
    
	var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
	
	var mq = function (query) {
		return window.matchMedia(query).matches;
	}

	if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
		return true;
	}

	// include the 'heartz' as a way to have a non matching MQ to help terminate the join
	// https://git.io/vznFH
	var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
	return mq(query);
}

function cookies_info(){
	var display_cookies = localStorage["mb2020_cookies"];
	if(display_cookies==0){
		document.getElementById('cookies-info').classList.add('hidding');
	}
	else {
		jQuery('.cookies').css('display','flex');
	}
}

function ebook_info(){
	var display_ebook = localStorage["mb2020_ebook"];
	if(display_ebook==0){
		//document.getElementById('ebook-link').classList.add('hidden');
		if(jQuery('.ebook').hasClass('showing')){
			jQuery('.ebook').addClass('hidding');
			jQuery('.ebook').removeClass('showing');
		}

	}
	else {
		jQuery('.ebook').addClass('showing');
	}
}

function videoFallback(){
	let videoArray = [
		document.getElementById('video1'), 
		document.getElementById('video2'), 
		document.getElementById('video3'),
		document.getElementById('video4')
	];
	let imageArray = [
		document.getElementById('video1-fallback'), 
		document.getElementById('video2-fallback'), 
		document.getElementById('video3-fallback'),
		document.getElementById('video4-fallback')
	];

	for (let i = 0; i < videoArray.length; i++) {
		if(videoArray[i]){
		videoArray[i].addEventListener('suspend', () => {
			//video playback suspended
		  });		
		videoArray[i].addEventListener('play', () => {
			//video playback resumed
			imageArray[i].classList.add('d-none');
		});
		}
	}
}
