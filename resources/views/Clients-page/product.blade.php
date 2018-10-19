@extends("layouts.app")
@section("css_files")
    loadCSS("{{asset('assets/_header.css')}}");//Header Styles (compress & paste to header after release)
    @if($is_admin)
        loadCSS("{{asset('assets/css/_header_admin.css')}}");       //Header Styles (compress & paste to header after release)
    @endif
        loadCSS("{{asset('assets/css/product/_main.css')}}");                
    //User Styles: Main
    @if($is_admin)
        loadCSS("{{asset('assets/css/_main_admin.css')}}");  
    //User Styles: Main
    @endif
        loadCSS("{{asset('assets/css/product/_media.css')}}");  
    //User Styles: Media
    @if($is_admin)
        loadCSS("{{asset('assets/css/_media_admin.css')}}");  
    //User Styles: Media
    @endif

@endsection

@section('left_sidebar')
    {!!$left_side_bar!!}
@endsection

@section("main_column")
	 <div class="sherif_center_column">
        @include("layouts.chat")
        
        <!-- Product page -->
        <div class="sherif_home_main-product">
            <div class="sherif_home_main-product-navigation">
                <a class="goods_main" href="">Главная</a>
                <p><span>/</span></p>
                <a class="goods_main" href="">Одежда туристическая</a>
                <p><span>/</span>  Вы здесь <i class="fas fa-arrow-right"></i></p>
                <a href="">Куртка зимняя охотника Twill</a>
            </div>
            <div class="sherif_home_main-product-title">
                <h3>{{$product->name}}</h3>
            </div>
            <div class="sherif_home_main-product-rating">
                <div class="sherif_home_main-product-rating-rating_star">
                    <p>Рейтинг: 
                        <span>
                            <i class="fas fa-star"></i> 
                            <i class="fas fa-star"></i> 
                            <i class="fas fa-star"></i> 
                            <i class="fas fa-star-half-alt"></i>  
                            <i class="far fa-star"></i> 
                        </span>
                    </p>
                </div>
                <div class="sherif_home_main-product-rating-vendor_code">
                    <p>Артикул:{{$product->vendor_code}}</p>
                </div>
                <div class="sherif_home_main-product-rating-product_code">
                    <p>Код товара:{{$CurrentSubCategory->id}}-{{$product->id}}</p>
                </div>
            </div>
            <?php  $img_cropped = explode('.', $product->mainimage)?>
            <div class="sherif_home_main-product-good_block">
                <div class="sherif_home_main-product-good_block-view">
                    <img src="{{asset('storage/'. $img_cropped[0] . '-medium.' . $img_cropped[1])}}" alt="">
                </div>
                <div class="sherif_home_main-product-good_block-info">
                    <div class="sherif_home_main-product-good_block-info-description">
                        <div class="sherif_home_main-product-good_block-info-description-size_block">
                            <div class="sherif_home_main-product-good_block-info-description-size_block-size">
                                <p>Размер:</p>
                            </div>
                            <div class="sherif_home_main-product-good_block-info-description-size_block-pagination">
                                <nav class="">
                                    <ul class="product_page_info">
                                        <li class="disabled"><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li class="disabled"><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li class="active"><a href="#">XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                        <li><a href="#">XXXL</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-avaible">
                            <p>{{$status->name}}</p>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-stock">
                            <div class="sherif_home_main-product-good_block-info-description-stock-block">
                                <div class="sherif_home_main-product-good_block-info-description-stock-block-number_percent">
                                    <p>-20%</p>
                                </div>
                                <div class="sherif_home_main-product-good_block-info-description-stock-block-days_stock">
                                    <p>До конца акции осталось 2дня</p>
                                </div>
                            </div>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-old_price">
                            <p>Цена: 1820.00 грн</p>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-new_price">
                            <p>Цена: <b>{{$product->sale_price}}.00</b> грн</p>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-wholesale_price">
                            <p>Оптовая цена: 770.00 грн (от 10шт.)</p>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-price_link">
                            <p><i class="fas fa-arrow-down"></i> <a href="#">Нашли дешевле?</a></p>
                            <p><i class="fas fa-chart-area"></i> <a href="#">Следить за ценой</a></p>
                        </div>
                        <div class="sherif_home_main-product-good_block-info-description-in_basket">
                            <div class="sherif_home_main-product-good_block-info-description-in_basket-button">
                                <a class="btn-sherif product_in_basket" href=""><span></span><i class="fas fa-shopping-cart"></i>
                                    <strong>В корзину</strong></a>
                                </div>
                                <div class="sherif_home_main-product-good_block-info-description-in_basket-counter">
                                    <input placeholder="1">
                                    <div class="sherif_home_main-product-good_block-info-description-in_basket-counter-button">
                                        <button class="basket_counter_button"><i class="fas fa-caret-up"></i></button>
                                        <button class="basket_counter_button"><i class="fas fa-caret-down"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="sherif_home_main-product-good_block-info-description-buy_by_click">
                                <a class="btn-sherif buy_by_click" href=""><span></span><i class="far fa-hand-point-up"></i></i>
                                    <strong>Купить в один клик</strong></a>
                                </div>
                                <div class="sherif_home_main-product-good_block-info-description-abotu_manufactor">
                                    <div class="sherif_home_main-product-good_block-info-description-abotu_manufactor-left">
                                        <p>Производитель:</p>
                                        <p>Страна произзводства:</p>
                                    </div>
                                    <div class="sherif_home_main-product-good_block-info-description-abotu_manufactor-right">
                                        <p>Украина</p>
                                        <p>Украина</p>
                                    </div>
                                </div>
                                
                                <div class="sherif_home_main-product-good_block-info-for_present">
                                    <a href="" style="background-image: url({{asset('assets/img/pic/pick_up.jpg')}});" class="sherif_home_main-product-good_block-info-description-pick_up_goods-pic">
                                        <img src="{{asset('assets/img/icons/pick_up-icon.png')}}" alt="">
                                        <h4>Подобрать товары того же цвета</h4>
                                    </a>
                                </div>  
                                <div class="sherif_home_main-product-good_block-info-description-pick_up_goods">

                                    <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product">
                                        <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-pic">
                                            <img src="img/product-page/product-page-description.jpg" alt="">
                                        </div>
                                        <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-description">
                                            <h3>Очки Revision тактические ACU (Olive)</h3>
                                        </div>
                                    </div>
                                    <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain">
                                        <h4>До конца акции осталось</h4>
                                        <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain-box">
                                            <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain-number">
                                                <h2>28</h2>
                                                <h4>дней</h4>
                                            </div>
                                            <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain-number">
                                                <h2>05</h2>
                                                <h4>часов</h4>
                                            </div>
                                            <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain-number">
                                                <h2>17</h2>
                                                <h4>минут</h4>
                                            </div>
                                            <div class="sherif_home_main-product-good_block-info-description-pick_up_goods-product-time_remain-number">
                                                <h2>45</h2>
                                                <h4>секунд</h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="sherif_home_main-product-tabs"> 
                        <ul class="nav nav-tabs">
                            <li> 
                                <a data-toggle="tab" href="#description">Описание</a>
                            </li>
                            <li class="active">
                                <a data-toggle="tab" href="#characteristics">Характеристики</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#video_review">Видеообзор</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews">Отзывы</a>
                            </li>
                        </ul>
                        <!-- characteristics tab content -->
                        <div class="sherif_home_main-product-tabs-tab-content">
                            <div id="#description" class="tabe-pane active"></div>
                            <div id="#characteristics" class="tabe-pane">
                                <div class="sherif_home_main-product-tabs-tab-content-block">
                                    <div class="sherif_home_main-product-tabs-tab-content-left">
                                        <ul class="tab-content-characteristics">
                                            <li>
                                                <span class="text">Максимальная ширина печати</span>
                                            </li>
                                            <li>
                                                <span class="text">Технология печати</span>
                                            </li>
                                            <li>
                                                <span class="text">Разрешение</span>
                                            </li>
                                            <li>
                                                <span class="text">Интерфейсы подключения</span>
                                            </li>
                                            <li>
                                                <span class="text">Тип принтера</span>
                                            </li>
                                            <li>
                                                <span class="text">Вид</span>
                                            </li>
                                            <li>
                                                <span class="text">Тип печати</span>
                                            </li>
                                            <li>
                                                <span class="text">Скорость печати</span>
                                            </li>
                                            <li>
                                                <span class="text">Минимальная ширина этикетки</span>
                                            </li>
                                            <li>
                                                <span class="text">Максимальная ширина этикетки</span>
                                            </li>
                                            <li>
                                                <span class="text">Минимальная длина этикетки</span>
                                            </li>
                                            <li>
                                                <span class="text">Максимальная длина этикетки</span>
                                            </li>
                                            <li>
                                                <span class="text">Диаметр внутренней втулки ролика этикеток</span>
                                            </li>
                                            <li>
                                                <span class="text">Толщина этикетки с подложкой</span>
                                            </li>
                                            <li>
                                                <span class="text">Внешний диаметр ролика этикеток</span>
                                            </li>
                                            <li>
                                                <span class="text">Управление</span>
                                            </li>
                                            <li>
                                                <span class="text">Датчики</span>
                                            </li>
                                            <li>
                                                <span class="text">Рефлективный "черная метка"</span>
                                            </li>
                                            <li>
                                                <span class="text">EPL2, ZPL</span>
                                            </li>
                                            <li>
                                                <span class="text">Печать штрих-кодов</span>
                                            </li>
                                            <li>
                                                <span class="text">Процессор</span>
                                            </li>
                                            <li>
                                                <span class="text">Память</span>
                                            </li>
                                            <li>
                                                <span class="text">Опции</span>
                                            </li>
                                            <li>
                                                <span class="text">Комплектация</span>
                                            </li>
                                            <br>
                                            <br>
                                            <li>
                                                <span class="text">Индикация</span>
                                            </li>
                                            <li>
                                                <span class="text">Источник питания</span>
                                            </li>
                                            <li>
                                                <span class="text">Температура эксплуатации</span>
                                            </li>
                                            <li>
                                                <span class="text">Влажность при эксплуатации</span>
                                            </li>
                                            <li>
                                                <span class="text">Размеры</span>
                                            </li>
                                            <li>
                                                <span class="text">Вес</span>
                                            </li>
                                            <li>
                                                <span class="text">Цвет</span>
                                            </li>
                                            <li>
                                                <span class="text">Страна-производитель</span>
                                            </li>
                                            <li>
                                                <span class="text">Гарантия</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sherif_home_main-product-tabs-tab-content-right">
                                        <ul class="tab-content-characteristics-right">
                                            <li>
                                                <span class="page">54 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">Прямая термопечать</span>
                                            </li>
                                            <li>
                                                <span class="page">203 dpi</span>
                                            </li>
                                            <li>
                                                <span class="page">USB, RS-232, Ethernet</span>
                                            </li>
                                            <li>
                                                <span class="page">Настольные</span>
                                            </li>
                                            <li>
                                                <span class="page">Принтер этикеток</span>
                                            </li>
                                            <li>
                                                <span class="page">Черно-белая</span>
                                            </li>
                                            <li>
                                                <span class="page">102 мм/с</span>
                                            </li>
                                            <li>
                                                <span class="page">15 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">60 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">4 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">1727 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">25.4 мм, 38.1 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">0.06 - 0.2 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">127 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">Многофункциональная кнопка контроля FEED</span>
                                            </li>
                                            <li>
                                                <span class="page">Фиксированный датчик просвет между этикетками</span>
                                            </li>
                                            <li>
                                                <span class="page">Язык управления принтером</span>
                                            </li>
                                            <li>
                                                <span class="page">Автоматический выбор языка управления</span>
                                            </li>
                                            <li>
                                                <span class="page">Да</span>
                                            </li>
                                            <li>
                                                <span class="page">32-битный RISC-микропроцессор</span>
                                            </li>
                                            <li>
                                                <span class="page">4 МБ Flash ROM, 16 МБ SDRAM</span>
                                            </li>
                                            <li>
                                                <span class="page">Отделитель</span>
                                            </li>
                                            <li>

                                                <span class="page">Принтер, Втулка для сматывания отработанного риббона, Стандартный риббон, Сетевой шнур питания, Источник питания, Ттестовый рулон этикетки, СD (Включает ПО Qlabel, руководство пользователя)</span>

                                            </li>
                                            <li>
                                                <span class="page">Один двухцветный светодиодный индикатор (Зеленый, Красный)</span>
                                            </li>
                                            <li>
                                                <span class="page">110 - 220 В, 50 - 60 Гц</span>
                                            </li>
                                            <li>
                                                <span class="page">5°С - 40°С</span>
                                            </li>
                                            <li>
                                                <span class="page">30% - 85%</span>
                                            </li>
                                            <li>
                                                <span class="page">218 х 172 х 100 мм</span>
                                            </li>
                                            <li>
                                                <span class="page">1.2 кг/span>
                                                </li>
                                                <li>
                                                    <span class="page">Черный</span>
                                                </li>
                                                <li>
                                                    <span class="page">Тайвань</span>
                                                </li>
                                                <li>
                                                    <span class="page">36 месяцев</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="#video_review" class="tabe-pane"></div>
                                <div id="#reviews" class="tabe-pane"></div>
                            </div>
                        </div>
                    </div>
                    <div class="sherif_home_main-mobile_bar air-show">
                        <div class="sherif_home_mobile_ads">
                            <a href="#" style="background-image:url(img/pic/Air_Show.jpg);" class="sherif_home_main-box-right_bar-advertising-pic"  >
                            </a>
                            <a href="#" style="background-image:url(img/pic/Air_Show.jpg);" class="sherif_home_main-box-right_bar-advertising-pic"  >
                            </a>
                        </div>
                    </div>

                    <div class="sherif_home_main-box_recommended sherif_main_looked">
                        
                        <div class="flex_row_mobile">
                            <h3>Вы просматривали:</h3>
                            <a class="mobile_toggle" toggle-object="looked" toggle="off"><i class="far fa-arrow-alt-circle-down"></i></a>
                        </div>
                        <div class="toggle_mobile_looked">
                            <div class="sherif_home_main-box_scroll">
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon2.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Костюм ПОЛИЦИЯ нового образца, Тип А</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>      
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon1.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>      
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon3.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>  
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon4.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>      
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon1.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>  
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon1.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Костюм ПОЛИЦИЯ нового образца, Тип А</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>  
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon1.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>      
                                    </div>
                                </div>
                                <div class="sherif-product">
                                    <div class="sherif-product_content">
                                        <div class="sherif-product_content-img_box">
                                            <img class="sherif-product_content_img" src="img/recommended/icon1.png" alt="">
                                        </div>
                                        <a href="#" class="sherif-product_content_link">Сумка-рюкзак Arm-tec тк. Cordura Digital ВСУ, 70л</a><br />
                                        <span class="sherif-product_content_vendor-code">Артикул: 30700А</span><br />
                                        <span class="sherif-product_content_prev-price">Цена: <span class="price">870.00 грн</span></span><br />
                                        <span class="sherif-product_content_current-price">Цена: <span class="price">870.00 грн</span></span><br />
                                    </div>
                                    <div class="sherif-product-buttons">
                                        <a href="#" class="sherif-btn btn-sherif-product"><span></span><i class="fas fa-shopping-cart"></i><strong>В корзину</strong></a>
                                        <div class="sherif-product_other">
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-phone-volume fa-lg"></i><strong></strong></a>
                                            <a href="#" class="btn-sherif-product"><span></span><i class="fas fa-heart fa-lg"></i><strong></strong></a>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="sherif_home_main-mobile_bar">
                        <div class="color_pick">
                            <a href="#" style="background-image: url(img/pic/pick_up.jpg);" class="sherif_home_main-box-right_bar-pick_up-pic">
                                <img src="img/icons/pick_up-icon.png" alt="">
                                <h4>Подобрать товары по цвету</h4>
                            </a>
                        </div>
                    </div>
                </div>



						<div class="sherif_right_column">
							<div class="sherif_home_main-box-right_bar">
								<!-- Air Show -->
								<div class="sherif_home_main-box-right_bar-advertising">
									<a href="#" style="background-image:url(img/pic/Air_Show.jpg);" class="sherif_home_main-box-right_bar-advertising-pic"  >
									</a>
									<a href="#" style="background-image:url(img/pic/Air_Show.jpg);" class="sherif_home_main-box-right_bar-advertising-pic"  >
									</a>
								</div>
								<!-- Already viewed -->
								<div class="sherif_home_main-right_bar-viewed">
									<h3>Вы просматривали</h3>
									<button class="sherif_home_main-right_bar-viewed-button button_top"></button>
									<div class="sherif_home_main-right_bar-viewed-trade_item">
										<div class="sherif_home_main-right_bar-viewed-trade_item-pic">
											<img src="img/recommended/icon2.png" alt="" >
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
											<img src="img/recommended/icon1.png" alt="" >
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
											<img src="img/recommended/icon3.png" alt="" >
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
									<a href="" style="background-image: url(img/pic/pick_up.jpg);" class="sherif_home_main-box-right_bar-pick_up-pic">
										<img src="img/icons/pick_up-icon.png" alt="">
										<h4>Подобрать товары по цвету</h4>
									</a>
								</div>
							</div>
						</div>

				</div>
			</div>
		
				
				
			<div class="sherif_home_main_bottom-info">
				<div class="sherif_row">
					<div class="bottom-info_text">
						Интернет-магазини Шериф. Если вас интересуют товары для военных и охраны, путешествий и туризма, охоты и рыбалки, а также подарки, вы попали по адресу. Именно этими товарами торгует наш интернет-магазин. Кроме указанного, мы предлагаем товары для развлечений, очень активного отдыха и проведения (организации) праздников. Вы можете подобрать сценарий для профессионального фейверка, который проведут наши специалисты на вашем мероприяти, будь то свадьба, новогодний праздник, день рождения, корпоративный вечер или День города. Мы занимаемся этим более 20 лет. Крупными разделами в интернет магазине являются: туристические товары, туристические ножы и оптика. У нас вы так же можете купить надувные лодки, рюкзаки (тактические и туристические) и множество другого полезного снаряжения. Имеется также категория посвященная одежде для охоты и туризма. Военнослужащим и охранным агенствам представляем разделы бронежилеты, шлемы и каски, наколенники и налокотники, ремни и перчатки тактические, защитные очки и маски, чехлы и кобуры. Наши товары мы отправляем по всей территории Украины. Центральный офис находится в Днепропетровске, на ул.Артема (Сечевых Стрельцов), д.9, - магазин Шериф. Для отпраки товаров по Украине мы рекомендуем покупателю оператора доставки "Новая почта", но при этом не ограничиваем выбор службы. Вы можете назвать любую другую компанию (Гюнсел, Автолюкс, ТНТ, Спецсвязь и т.д.) и товар будет отправлен Вам согласно оформленному заказу в любой крупный город и по области (Киев, Херсон, Одесса, Запорожье, Харьков, Львов и т.п.). Если выбранный Вами артикул вы найдете в другом магазине дешевле, сообщите, пожалуйста, нам. Мы постараемся подкорректировать прайс с учетом ваших "находок" в интернете и сделать так, чтобы цена была приемлемой для Вас. На все товары<br />Источник: http://sherif.ua/
					</div>
				</div>
			</div>
			<div class="sherif_home_main_bottom-alert">
				<div class="sherif_row">
					<div class="bottom-alert_text">
						<p>Внимание! Заказы совершенные с 1 до 3 января будут обработаны и отправлены 4 января. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias doloribus eaque quas eum eos suscipit eius vitae ab odit blanditiis, ad quo accusamus, impedit dolor. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit similique commodi hic illo dolore minima, molestias a beatae non. Iste aperiam assumenda eveniet quisquam! Numquam consequatur accusamus consequuntur distinctio quas, maiores quae neque ad voluptates enim a alias atque est. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore natus rerum ab eveniet quo aperiam consequuntur, dolorem odio commodi voluptatum facere fugit unde neque molestias molestiae tempora placeat? Earum, dolorem.</p>
					</div>
				</div>
			</div>
		</main>

@endsection
		