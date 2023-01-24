<?php

wp_enqueue_style('biography_page', get_stylesheet_directory_uri() . '/assets/css/biography_page.css');

get_header(); ?>

<div id="primary" class="content-area frontpage">
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <main id="main" class="site-main" role="main" data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-center">

            <?php

            do_action('storefront_page_before');



            /**
             * Functions hooked in to storefront_page_after action
             *
             * @hooked storefront_display_comments - 10
             */
            do_action('storefront_page_after');

            ?>


        </main><!-- #main -->

        <div class="bio-background  d-flex align-items-stretch">

            <div class="d-md-inline-flex blur-bio " data-aos="fade-in" data-aos-duration="1500">

                <div class="col-md-5 col-sm-12 d-flex align-items-center justify-content-center  ">

                    <div class="bio-header">
                        <strong class="strong-header">MARTA<br>
                            BANASZEK</strong>
                    </div>
                </div>

                <p class="col-md-7 col-sm-12 d-flex align-items-center bio-paragraph">
                    Kobieta łącząca karierę w biznesie, kreowanie mody i działalność społeczną. Z wykształcenia ekonomistka, z pasji projektantka mody, z misji kobieta, która chce pomagać innym kobietom poczuć się idealnymi dla samych siebie.
                    <br>
                    Twórczyni marki odzieżowej, w której jako projektantka specjalizuje się w szyciu miarowym
                    głównie damskich garniturów, łączącej styl biznesowy z najciekawszymi trendami modowymi. Od ponad pięciu lat prowadzi w Warszawie pracownię, na swoim koncie ma cztery autorskie pokazy, a do grona fanek projektów z metką MB Marta Banaszek dołączają kolejne kobiety związane ze światem biznesu, mody czy mediów.
                    <br><br>
                    W swojej pracowni spotyka się z kobietami z różnych branż, które poszukują jakości i indywidualnego stylu, pomaga w tworzeniu całościowych stylizacji a także budowie całej garderoby. Tworzone przez nią projekty mają na celu sprawiać, aby kobieta poczuła się idealna dla samej siebie i nie była marginalizowana ze względu na wiek czy rozmiar.
                    <br><br>
                    Pomysłodawczyni kampanii społecznej „Dobra dla Ciebie? Idealna dla siebie”, mającej na celu uświadamianie kobiet, jak ważna jest dla nich samoakceptacja i wiara w siebie, która nie jest tylko pisanym sloganem. Tworząc ubrania dla kobiet postanowiła pójść dalej i stworzyć kampanię, w której chce pomóc kobietom spojrzeć na siebie z innej strony, zadbać o ich wiedzę i rozwój. Zrealizowała dwie odsłony kampanii, zapraszając do niej kolejne ambasadorki – kobiety, które na pozór wiele różni – ale mają wspólny cel: autentyczne wsparcie innych.
                    <br><br>
                    Wie, że w dążeniu do samoakceptacji nie może być przeszkodą także płeć. Dlatego wraz z początkiem roku 2023 rozszerza działania i wraz ze swoim zespołem tworzy kampanię społeczną pod hasłem: „Idealni dla siebie”.
                    <br><br>
                    Celem kampanii jest dodanie wiary we własne siły. Stworzenie wspierającej społeczności, która będzie sobie pomagała, uczyła, jak budować poczucie własnej wartości, jak ważny jest rozwój i wsparcie drugiego człowieka, promowała autentyczność i bliskość relacji. Nie tylko wśród kobiet, ale także mężczyzn.
                </p>
            </div>

        </div>
</div>
</div>

</div>
<?php
    endwhile; // End of the loop.
?>
</div><!-- #primary -->

<?php
get_footer();
