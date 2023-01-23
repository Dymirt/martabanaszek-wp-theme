<!-- Begin Sendinblue Form -->
<!-- START - We recommend to place the below code in head tag of your website html  -->
<style>
  @font-face {
    font-display: block;
    font-family: Roboto;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/7529907e9eaf8ebb5220c5f9850e3811.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/25c678feafdc175a70922a116c9be3e7.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 600;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/6e9caeeafb1f3491be3e32744bc30440.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/71501f0d8d5aa95960f6475d5487d4c2.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 700;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/3ef7cf158f310cf752d5ad08cd0e7e60.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/ece3a1d82f18b60bcce0211725c476aa.woff) format("woff")
  }

  #sib-container input:-ms-input-placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
  }

  #sib-container input::placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
  }

  #sib-container textarea::placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
  }
</style>
<link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
<!--  END - We recommend to place the above code in head tag of your website html -->

<!-- START - We recommend to place the below code where you want the form in your website html  -->
<div class="sib-form" style="text-align: center;
         background-color: transparent;                                 ">
  <div id="sib-form-container" class="sib-form-container">
  <div id="success-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:inherit; background-color:#fff; border-radius:3px; border:none; padding-top: 32px; max-width:640px;">
      <span id="close-success" class="close" style="position: absolute; right: 0;top: 0; font-size: 32px; font-weight: 600; margin-right: 30px; margin-top: 32px; cursor: pointer; line-height: inherit; color: inherit; transition: .3s ease; ">&times;</span>
      <div class="sib-form-message-panel__text sib-form-message-panel__text--center" style="padding: 1rem; padding-top: 2rem;">
        <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
          <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z"
          />
        </svg>
        <span class="sib-form-message-panel__inner-text">
                          Udało się! Sprawdź email, aby potwierdzić subskrypcję.
                      </span>
      </div>
    </div>
    <div></div>
    <div id="sib-container" class="sib-container--large sib-container--vertical" style="text-align:center; background-color:rgba(255,255,255,1); max-width:640px; border-radius:10px; border: none; padding: 0; display: flex;">
    <div class="side-image" style="">
      <img src="<? echo get_stylesheet_directory_uri()?>/img/newsletter_side_image.jpeg"
            style="object-fit: cover; height: 100%; width: 100%; border-radius: 10px 0 0 10px;"/>
    </div>
    <div class="popup-content" style="">
    <div id="error-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:rgb(251 44 44);max-width:640px; border: none; margin-bottom: 0;">
      <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
        <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
          <path d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z"
          />
        </svg>
        <span class="sib-form-message-panel__inner-text">
                          Wystąpił błąd.
                      </span>
      </div>
    </div>
    <div></div>   
    <!-- test https://49efc634.sibforms.com/serve/MUIEAMtpCUzoYVbUdFvXcwmvRYCH_0BSv8XbVhC5HnvY5IjNFDClFUQpZ5Oto6JnR1odpqIjnRXi2KoCi3GeNyvgSj0C0gHvOfbuo9350CAQNjxsiG88LoFN1bCY_61O4zFRX-exrR9f6TsM3Q5f0nUc2DRqc8Q7s8LBYJel2AgM6X6apUbr2s2_EKGWmvDMtvi2AHtrmUUOA02H-->                              
    <!-- prod https://49efc634.sibforms.com/serve/MUIEAL9A6M4JnObnMP60FrT9ShAjo5DBUZQyaq6q9WZQHDPD7IO2mVx9ok6YBX6PEwIitwezmqX-8sZdnmc_onXVxAnNltwVEytEnAKekfWYOsy0sXPRU3_kU_ArXHJ6SMXM730HbhfbUwSpL5PyJiEXKqoO43id69byUBR5Tb_eibKNIF4zNztUD7ui9fq2K94aAL7LyGtPp-3A-->                              
    <form id="sib-form" method="POST" action="https://49efc634.sibforms.com/serve/MUIEAL9A6M4JnObnMP60FrT9ShAjo5DBUZQyaq6q9WZQHDPD7IO2mVx9ok6YBX6PEwIitwezmqX-8sZdnmc_onXVxAnNltwVEytEnAKekfWYOsy0sXPRU3_kU_ArXHJ6SMXM730HbhfbUwSpL5PyJiEXKqoO43id69byUBR5Tb_eibKNIF4zNztUD7ui9fq2K94aAL7LyGtPp-3A"
        data-type="subscription" style="padding: 17px;">
        <span id="close" class="close" style="position: absolute; right: 0;top: 0; font-size: 32px; font-weight:600; margin-right: 30px; margin-top: 32px; cursor: pointer; line-height: inherit; color: inherit; transition: .3s ease; ">&times;</span>
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="text-align:left; font-weight:800; font-family:&quot;Helvetica&quot;, sans-serif; color:#000; background-color:transparent;">
            <p class="title"><strong>Dołącz do społeczności <br> MB Marta Banaszek!</strong></p>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="font-size:14px; font-weight: 600; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent;">
            <div class="sib-text-form-block">
              <p style="margin-bottom: .5rem; color: #5a5959">Zapisz się do naszego newslettera i&nbsp;pozwól mi zadbać o Ciebie.</p>
            </div>
            <div class="sib-text-form-block">
              <p style="margin-bottom: .5rem; color: #5a5959">Wspólnie twórzmy modę i odkrywajmy siebie na nowo.</p>
            </div>
            <div class="sib-text-form-block">
              <p style="margin-bottom: .5rem; color: #000">Odbierz rabat 10% na pierwsze zakupy!</p>
            </div>
          </div>
        </div>
        <div style="padding: 0;">
          <div class="sib-input sib-form-block">
            <div class="form__entry entry_block">
              <div class="form__label-row ">

                <div class="entry__field" style="border-radius:10px;">
                  <input class="input" maxlength="200" type="text" id="FIRSTNAME" name="FIRSTNAME" autocomplete="off" placeholder="Imię" data-required="true" required style="font-size: 12px; border-radius:10px;"/>
                </div>
              </div>

              <label class="entry__error entry__error--primary" style="font-size:12px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:rgb(251 44 44);">
              </label>
            </div>
          </div>
        </div>
        <div style="padding: 0;">
          <div class="sib-input sib-form-block">
            <div class="form__entry entry_block">
              <div class="form__label-row ">

                <div class="entry__field" style="border-radius:10px;">
                  <input class="input" type="text" id="EMAIL" name="EMAIL" autocomplete="off" placeholder="Adres email" data-required="true" required style="font-size: 12px; border-radius:10px;" pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" oninvalid="this.setCustomValidity('Proszę podać prawidłowy adres email')" oninput="this.setCustomValidity('')"/>
                </div>
              </div>

              <label class="entry__error entry__error--primary" style="font-size:12px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:rgb(251 44 44);">
              </label>
            </div>
          </div>
        </div>
        <div style="padding: 0;">
          <div class="sib-form-block" style="text-align: center">
            <button class="sib-form-block__button sib-form-block__button-with-loader" style="font-size:14px; text-align:center; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#FFFFFF; background-color:#000; border-radius:10px; border-width:0px; width: 100%"
              form="sib-form" type="submit">
              <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon" viewBox="0 0 512 512">
                <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z"
                />
              </svg>
              Zapisz się
            </button>
            <div class="rodo">
            <p>Informacja o przetwarzaniu danych osobowych.</p>

            <p>Będziemy przetwarzać Pani/Pana (lub Państwa) dane osobowe w celu utrzymania relacji z klientem oraz informowania o wydarzeniach organizowanych przez Studio Marta Banaszek. 
            Dane mogą być przetwarzane w sposób zautomatyzowany, ale nie będą profilowane oraz udostępniane. Jednocześnie informujemy, iż istnieje możliwość wypisania się z listy mailingowej w każdym czasie.</p>

            <p>Administratorem Pani/Pana (lub Państwa) danych osobowych jest Studio Mody Marta Banaszek pod firmą Inkaso Hermański z siedzibą w Warszawie (02-796) przy ul. Bronikowskiego 53 lokal 3.
            Na wszelkiego rodzaju pytania dotyczące sposobu i zakresu przetwarzania Pani/Pana (lub Państwa) danych odpowiemy niezwłocznie po skierowaniu zapytania na adres: <a href="mailto:studio@martabanaszek.pl">studio@martabanaszek.pl</a>.</p>
            </div>
          </div>
        </div>

        <input type="text" name="email_address_check" value="" class="input--hidden">
        <input type="hidden" name="locale" value="en">
      </form>
    </div>
    </div>
  </div>
</div>
<!-- END - We recommend to place the below code where you want the form in your website html  -->

<!-- START - We recommend to place the below code in footer or bottom of your website html  -->
<script>
  window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';

  window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "Podany adres email jest nieprawidłowy. Sprawdź i spróbuj ponownie.";

  window.REQUIRED_ERROR_MESSAGE = "To pole jest wymagane. ";

  window.GENERIC_INVALID_MESSAGE = "Podane informacje są nieprawidłowe. Sprawdź i spróbuj ponownie.";




  window.translation = {
    common: {
      selectedList: '{quantity} list selected',
      selectedLists: '{quantity} lists selected'
    }
  };

  var AUTOHIDE = Boolean(1);
</script>
<!--<script src="https://sibforms.com/forms/end-form/build/main.js"> -->
<script src="<? echo get_stylesheet_directory_uri()?>/js/sibform_main.js">
</script>


<!-- END - We recommend to place the above code in footer or bottom of your website html  -->
<!-- End Sendinblue Form -->