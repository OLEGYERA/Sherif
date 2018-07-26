@extends("layouts.app")

@section("main_column")
<!-- Main Sherif-Home-->

            <div class="sherif_center_column">
                <!-- include home_messages -->
                @include("layouts.partials.home_messages")



                <!--SHERIF SECTION-->
                    <ul class="sherif-breadcrumb">
                      <li><a href="index.html">Главная</a></li>
                      <li><span>Вы здесь <i class="fas fa-arrow-right"></i></span>  Военное снаряжение, обмундирование, бронежилеты</li>
                    </ul>
                    <div class="sherif_home_main-box_section">
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section1.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Аптечки и первая помощь<span class="section-number"> (7)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section2.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Балаклавы<span class="section-number"> (12)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section3.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link" class="category-link">Берцы и другая военная обувь<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section4.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Бронежилеты<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section5.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Бронепластины, кевлар, бронесумки<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section6.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Военная форма и камуфляж<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section7.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Фурнитура форменная<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section8.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Гидраторы и питьевые системы<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <div class="sherif_home_main-box_section_itm">
                            <a href="#">
                                <img class="sherif-section_itm-img" src="{{asset('/assets/img/section/section9.png')}}" alt="">
                                <p class="section-title">
                                    <span class="category-link">Головные уборы<span class="section-number"> (45)</span></span>
                                </p>
                            </a>
                        </div>
                        <nav class="">
                            <ul class="pagination-sherif">
                                <li class=""><a href="#"><<</a></li>
                                <li class=""><a href="#"><</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a class="active-sherif" href="#">6</a></li>
                                <li><a href="#">7</a></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a class="active-sherif-dots" href="#"></a></li>
                                <li><a href="#">20</a></li>
                                <li><a class="active-sherif-dots" href="#"></a></li>
                                <li><a href="#">30</a></li>
                                <li><a class="active-sherif-dots" href="#"></a></li>
                                <li><a href="#">40</a></li>
                                <li><a class="active-sherif-dots" href="#"></a></li>
                                <li><a href="#">50</a></li>
                                <li><a href="#">></a></li>
                                <li><a href="#">>></a></li>
                            </ul><br>
                            <ul class="pagination-sherif tags-sherif">
                                <li><i class="fas fa-tags"></i></li>
                                <li><a href="#">tag1</a></li>
                                <li><a href="#">tag2</a></li>
                                <li><a href="#">tag3</a></li>
                                <li><a href="#">tag4</a></li>
                                <li><a href="#">tag5</a></li>
                                <li><a href="#">tag6</a></li>
                                <li><a href="#">tag7</a></li>
                                <li><a href="#">tag8</a></li>
                                <li><a href="#">tag9</a></li>
                            </ul>
                            
                        </nav>
                    </div>
                    <!--SHERIF SECTION END-->
            </div>
     
       
@endsection

@section("main_content")
<div class="sherif_home_main_bottom-info">
    <div class="sherif_row">
        <div class="bottom-info_text">
            Интернет-магазини Шериф. Если вас интересуют товары для военных и охраны, путешествий и туризма, охоты и рыбалки, а также подарки, вы попали по адресу. Именно этими товарами торгует наш интернет-магазин. Кроме указанного, мы предлагаем товары для развлечений, очень активного отдыха и проведения (организации) праздников. Вы можете подобрать сценарий для профессионального фейверка, который проведут наши специалисты на вашем мероприяти, будь то свадьба, новогодний праздник, день рождения, корпоративный вечер или День города. Мы занимаемся этим более 20 лет. Крупными разделами в интернет магазине являются: туристические товары, туристические ножы и оптика. У нас вы так же можете купить надувные лодки, рюкзаки (тактические и туристические) и множество другого полезного снаряжения. Имеется также категория посвященная одежде для охоты и туризма. Военнослужащим и охранным агенствам представляем разделы бронежилеты, шлемы и каски, наколенники и налокотники, ремни и перчатки тактические, защитные очки и маски, чехлы и кобуры. Наши товары мы отправляем по всей территории Украины. Центральный офис находится в Днепропетровске, на ул.Артема (Сечевых Стрельцов), д.9, - магазин Шериф. Для отпраки товаров по Украине мы рекомендуем покупателю оператора доставки "Новая почта", но при этом не ограничиваем выбор службы. Вы можете назвать любую другую компанию (Гюнсел, Автолюкс, ТНТ, Спецсвязь и т.д.) и товар будет отправлен Вам согласно оформленному заказу в любой крупный город и по области (Киев, Херсон, Одесса, Запорожье, Харьков, Львов и т.п.). Если выбранный Вами артикул вы найдете в другом магазине дешевле, сообщите, пожалуйста, нам. Мы постараемся подкорректировать прайс с учетом ваших "находок" в интернете и сделать так, чтобы цена была приемлемой для Вас. На все товары<br />Источник: http://sherif.ua/<br>

            <ul class="pagination-sherif tags-sherif info-tag">
                <li><i class="fas fa-tags"></i></li>
                <li><a href="#">tag1</a></li>
                <li><a href="#">tag2</a></li>
                <li><a href="#">tag3</a></li>
                <li><a href="#">tag4</a></li>
                <li><a href="#">tag5</a></li>
                <li><a href="#">tag6</a></li>
                <li><a href="#">tag7</a></li>
                <li><a href="#">tag8</a></li>
                <li><a href="#">tag9</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
