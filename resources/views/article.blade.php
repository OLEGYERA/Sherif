@extends("layouts.app")
@section("css_files")
    loadCSS("assets/_header.css");//Header Styles (compress & paste to header after release)
    @if($is_admin)
        loadCSS("assets/css/_header_admin.css");              //Header Styles (compress & paste to header after release)
    @endif
    loadCSS("assets/_main.css");                //User Styles: Main
    loadCSS("assets/css/article/_main.css");                //User Styles: Main
    @if($is_admin)
        loadCSS("assets/css/_main_admin.css");                //User Styles: Main
    @endif
    loadCSS("assets/css/article/_media.css");               //User Styles: Media
    @if($is_admin)
        loadCSS("assets/css/_media_admin.css");               //User Styles: Media
    @endif

@endsection

@section("company_text")@endsection

@section("main_column")
    <div class="sherif_center_column">
        @include("layouts.chat")

        <!-- Article Box Start -->
        <div class="sherif_home_main-article-navigation">
            <a class="goods_main" href="">Главная</a>
            <p><span>/</span></p>
            <a class="goods_main" href="">Блог</a>
            <p><span>/</span> Вы здесь &#8594;</p>
            <a href="">Название статьи</a>
        </div>
        <div class="sherif_home_main-article-box">
            <div class="sherif_home_main-article-box-title">
                <h3>Новые правила ношения формы военнослужащими армии Украины
                    <br>
                    (приказ МО № 606 от 20.11.2017)
                </h3>
            </div>
            <div class="sherif_home_main-article-box-new_rules">
                <div class="sherif_home_main-article-box-new_rules-info-left">
                    <div class="sherif_home_main-article-box-new_rules-info-left-top">
                        <img src="{{asset('/assets/img/article/Pic1.jpg')}}" alt="">
                    </div>
                    <div class="sherif_home_main-article-box-new_rules-info-left-bot">
                        <p>Согласно Правилам, украинская армейная форма имеет несколько категорий:
                        <ul>
                            <li>парадная;</li>
                            <li>Повсегдневная;</li>
                            <li>полевая;</li>
                            <li>рабочая (специальная);</li>
                            <li>для занятий спортом;</li>
                        </ul>
                        <p>Каждая из этих категорий подразделяется на летний и зимний комплекты. Полевая и повсекдневная одежда, к тому же, изготавливается в демисезонном варианте. Форма носится в соответствии с видом ВСУ, установленным для военной части, военным званием, а так же исходя из задания, которое выполняется.
                        </p>
                    </div>
                </div>
                <div class="sherif_home_main-article-box-new_rules-info-right">
                    <div class="sherif_home_main-article-box-new_rules-info-right-top">
                        <p>16 января 2018 года вступил в силу приказ Министерства обороны Украины № 606, который обновил <u>«Правила ношения военной формы и знаков различия военнослужащими ВСУ и лицеистам военных лицеев».
                            </u>
                        </p>
                        <p>При подготовке Норм учитывался опыт АТО, а также вооруженных сил стран Нато, где используется многослойная полевая форма.</p>
                    </div>
                    <div class="sherif_home_main-article-box-new_rules-info-right-bot">
                        <img src="{{asset('/assets/img/article/pic2.jpg')}}" alt="">
                    </div>
                    <div class="sherif_home_main-article-box-new_rules-info-left-bot_mobile">
                        <p>Согласно Правилам, украинская армейная форма имеет несколько категорий:
                        <ul>
                            <li>парадная;</li>
                            <li>Повсегдневная;</li>
                            <li>полевая;</li>
                            <li>рабочая (специальная);</li>
                            <li>для занятий спортом;</li>
                        </ul>
                        <p>Каждая из этих категорий подразделяется на летний и зимний комплекты. Полевая и повсекдневная одежда, к тому же, изготавливается в демисезонном варианте. Форма носится в соответствии с видом ВСУ, установленным для военной части, военным званием, а так же исходя из задания, которое выполняется.
                        </p>
                    </div>
                </div>
            </div>
            <div class="sherif_home_main-article-box-new_form">
                <div class="sherif_home_main-article-box-new_form-title">
                    <h3>В обязательный перечень повседневной формы одежды для военнослужащих офицерского,
                        старшинского, сержантского и рядового состава включены:
                    </h3>
                </div>
                <ul class="sherif_home_main-article-box-new_form-list">
                    <li>Для лета: берет (или пилотка в авиации и вдв), куртка с брюкаи навыпуск цвета, соответствующего роду войск, рубашка &#171Тан&#187 с налстуком в цвете основного материала, черные полуботинки. -</li>
                    <li>&#8226 Для весны-осени: берет (или пилотка), демисезонный непромокаемый плащ, куртка с брюками навыпуск, рубашка с галстуком, черные ботинки (либо полуботинки) и того же цвета перчатки. -</li>
                    <li>&#8226 Для зимы: утепленная шапка, куртка зимняя, куртка с брюками навыпуск цвета, соответствующего роду войск, рубашка &#171Тан&#187 с галстуком, черные ботинки (полуботинки), черные перчатки и шейный платок в цвете соответствующего вида/рода войск.</li>
                </ul>
                <div class="sherif_home_main-article-box-new_form-pic">
                    <img src="{{asset('/assets/img/article/pic3.jpg')}}" alt="">
                </div>
                <div class="sherif_home_main-article-box-new_form-text">
                    <p>Предусмотрено 11 комбинаций одежды для пунктов постоянной дислокации, а также 5 вариантов для полигонных и сезонных боевых действий.
                    </p>
                </div>
                <div class="sherif_home_main-article-box-new_form-link">
                    <a class="sherif_home_main-article-box-new_form-link_facebook" href="#"><i class="fab fa-facebook-square"></i></a>
                    <a class="sherif_home_main-article-box-new_form-link_twitter" href="#"><i class="fab fa-twitter-square"></i></a>
                    <a class="sherif_home_main-article-box-new_form-link_google" href="#"><i class="fab fa-google-plus-square"></i></a>
                    <a class="sherif_home_main-article-box-new_form-link_mail" href="#"><i class="fas fa-envelope-square"></i></a>
                    <a class="sherif_home_main-article-box-new_form-link_print" href="#"><i class="fas fa-print"></i></a>
                </div>
            </div>
        </div>


    </div>
@endsection
