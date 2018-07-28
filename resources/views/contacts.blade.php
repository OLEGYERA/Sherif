@extends("layouts.app")
@section("css_files")

    loadCSS("assets/_header.css");//Header Styles (compress & paste to header after release)
    @if($is_admin)
        loadCSS("assets/css/_header_admin.css");              //Header Styles (compress & paste to header after release)
    @endif
    loadCSS("assets/_main.css");                //User Styles: Main
    loadCSS("assets/css/contacts/_main.css");                //User Styles: Main
    @if($is_admin)
        loadCSS("assets/css/_main_admin.css");                //User Styles: Main
    @endif
    loadCSS("assets/css/contacts/_media.css");               //User Styles: Media
    @if($is_admin)
        loadCSS("assets/css/_media_admin.css");               //User Styles: Media
    @endif

@endsection

@section("main_column")
    <div class="sherif_center_column" style="margin-bottom: 1%">
        @include("layouts.chat")
        <!-- Contacts Bar Start -->
        <div class="sherif_home_main-contacts">
            <div class="sherif_home_main-contacts-navigation">
                <a class="goods_main" href="{{route('index')}}">Главная</a>
                <span>/</span>
                <p class="sherif_home_main-contacts-navigation-inner"> Вы здесь &#8594;</p>
                <a href="{{route("contacts")}}">Контакты</a>
            </div>
            <div class="sherif_home_main-contacts-title">
                <h3>Контакты</h3>
            </div>
            <div class="sherif_home_main-contacts-box">
                <div class="sherif_home_main-contacts-left">
                    <div class="sherif_home_main-contacts-left-info">
                        <div class="sherif_home_main-contacts-left-info-block">
                            <h4>Адрес:</h4>
                            <p>Днепр, ул. Артема (Сечевых Стрельцов),9</p>
                        </div>
                        <div class="sherif_home_main-contacts-left-info-block">
                            <h4>Время работы:</h4>
                            <p>Пн-Пт с09:00 до 19:00
                                <br> Суббота с 10:00 до 19:00
                                <br> Воскресенье с 11:00 до 18:0
                            </p>
                        </div>
                        <div class="sherif_home_main-contacts-left-info-block">
                            <h4>Телефоны:</h4>
                            <p>(0562) 31-86-00 - офис
                                <br> (0562) 32-00-48 - торговый зал
                                <br> (063) 797-59-92 - пиротехника
                                <br> (099) 494-85-65 - пиротехника
                                <br> (095) 233-00-00 - военное снаряжение, туристические товары, сейфы
                                <br> (063) 798-99-99 - военное снаряжение, туристические товары, сейфы
                                <br> (093) 257-13-30 - оружие, оптика, ножи, рыболовные снасти
                                <br> (068) 300-50-00 - оружие, оптика, ножи, рыболовные снасти
                                <br> (050) 011-11-09 - оружие, оптика, ножи, рыболовные снасти</p>
                        </div>
                    </div>
                    <div class="sherif_home_main-contacts-left-write_us">
                        <h3>Написать нам</h3>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Как к вам обращаться" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Телефон" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="e-mail" required="required" />
                            </div>
                            <div class="form-group">
                                <textarea id="form_message" name="message" class="form-control" placeholder="Комментарий" rows="6" required="required"></textarea>
                            </div>
                            <div class="form-group responsive-img">
                                <a href="">
                                    <img src="{{asset('/assets/img/pic/capture.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="form-group">
                                <button type="button" class="contacts-button">Написать</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="sherif_home_main-contacts-right">
                    <div class="sherif_home_main-contacts-right-info">
                        <div class="sherif_home_main-contacts-right-info-block responsive-img">
                            <h5>Оффлайн Магазин:</h5>
                            <img src="{{asset('/assets/img/contacts/pic1.jpg')}}" alt="">
                        </div>
                        <div class="sherif_home_main-contacts-right-info-block responsive-img">
                            <h5>Схема проезда:</h5>
                            <img src="{{asset('/assets/img/contacts/pic2.jpg')}}" alt="">
                        </div>
                        <div class="sherif_home_main-contacts-right-info-block responsive-img">
                            <h5>Коллектив:</h5>
                            <img src="{{asset('/assets/img/contacts/pic3.jpg')}}" alt="">
                        </div>
                        <div class="sherif_home_main-contacts-right-info-block-button">
                            <button type="button" class="contacts-button collective-button">Наш коллектив</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("right_side_bar")
    <div class="sherif_right_column">
        <div class="sherif_home_main-box-right_bar">
            <!-- Air Show -->
            <div class="sherif_home_main-box-right_bar-advertising">
                <a href="#" style="background-image:url({{asset('/assets/img/pic/Air_Show.jpg')}});" class="sherif_home_main-box-right_bar-advertising-pic"  >
                </a>
                <a href="#" style="background-image:url({{asset('/assets/img/pic/Air_Show.jpg')}});" class="sherif_home_main-box-right_bar-advertising-pic"  >
                </a>
            </div>
            <!-- Already viewed -->
            <div class="sherif_home_main-right_bar-viewed">
                <h3>Вы просматривали</h3>
                <button class="sherif_home_main-right_bar-viewed-button button_top"></button>
                <div class="sherif_home_main-right_bar-viewed-trade_item">
                    <div class="sherif_home_main-right_bar-viewed-trade_item-pic">
                        <img src="{{asset('/assets/img/recommended/icon2.png')}}" alt="" >
                    </div>
                    <div class="sherif_home_main-right_bar-viewed-trade_item-description">
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description-top">
                            <h5>Костюм Полиция нового образца, тип А </h5>
                            <p>Артикул: 30700А</p>
                        </div>
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description_bot">
                            <h5>Цена:870.00 грн</h5>
                            <h4><strong>Цена:870.00 грн</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="sherif_home_main-right_bar-viewed-trade_item">
                    <div class="sherif_home_main-right_bar-viewed-trade_item-pic">
                        <img src="{{asset('/assets/img/recommended/icon1.png')}}" alt="" >
                    </div>
                    <div class="sherif_home_main-right_bar-viewed-trade_item-description">
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description-top">
                            <h5>Костюм Полиция нового образца, тип А </h5>
                            <p>Артикул: 30700А</p>
                        </div>
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description_bot">
                            <h5>Цена:870.00 грн</h5>
                            <h4><strong>Цена:870.00 грн</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="sherif_home_main-right_bar-viewed-trade_item">
                    <div class="sherif_home_main-right_bar-viewed-trade_item-pic">
                        <img src="{{asset('/assets/img/recommended/icon3.png')}}" alt="" >
                    </div>
                    <div class="sherif_home_main-right_bar-viewed-trade_item-description">
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description-top">
                            <h5>Костюм Полиция нового образца, тип А </h5>
                            <p>Артикул: 30700А</p>
                        </div>
                        <div class="sherif_home_main-right_bar-viewed-trade_item-description_bot">
                            <h5>Цена:870.00 грн</h5>
                            <h4><strong>Цена:870.00 грн</strong></h4>
                        </div>
                    </div>
                </div>
                <button class="sherif_home_main-right_bar-viewed-button button_bot"></button>
            </div>
            <!-- Pick up goods -->
            <div class="sherif_home_main-box-right_bar-pick_up">
                <a href="" style="background-image: url({{asset('/assets/img/pic/pick_up.jpg')}});" class="sherif_home_main-box-right_bar-pick_up-pic">
                    <img src="{{asset('/assets/img/icons/pick_up-icon.png')}}" alt="">
                    <h4>Подобрать товары по цвету</h4>
                </a>
            </div>
        </div>
    </div>
@endsection

@section("shoptext")@endsection




