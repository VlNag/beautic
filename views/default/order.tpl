<div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="/user/" class='col-nav-hover nv-hover'>
                    Личный кабинет
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {$pageTitle}
            </li>
        </ol>
    </nav>

    <h3 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
        <span class="pe-2">{$pageTitle}</span>
        <div class=" flex-fill me-2" id="vn-line"> </div>
    </h3>

    <div class="row mx-0">

        <div class="px-0 px-sm-2 col-12 col-xl-10">
            {if $arUser['user_cart']}
                <ul class="ps-0 mb-0{*pull-right*}">
                    <li>
                        {assign var="idsProductCart" value=""}
                        {assign var="shippingDate" value="`$smarty.now|date_format`"}
                        {assign var="shippingDateNow" value="`$smarty.now|date_format`"}
                        {*foreach $arUser['user_cart'] as $productCart name=idProductCart*}
                        {foreach from=$arUser['user_cart'] item=$productCart name=idProductCart}
                            {if $smarty.foreach.idProductCart.first}
                                {assign var="idsProductCart" value="`$productCart['product_id']`"}
                            {else}
                                {assign var="idsProductCart" value="`$idsProductCart` ,`$productCart['product_id']`"}
                            {/if}
                        {if $productCart['date_available']|strtotime > $shippingDate|strtotime}
                             {assign var="shippingDate" value="`$productCart['date_available']`"}
                         {/if}
                        {/foreach}
                        <table class="table table-striped mb-0 mb-sm-1 mb-md-2">
                            {assign var="sum" value="`0`"}
                            {$sum = $sum|floatval}
                            <tr>
                                <th class="col-sm-1">

                                </th>
                                <th class="col-sm-4">
                                    Наименование товара
                                </th>
                                <th  class="col-3 col-sm-3 col-md-2 col-lg-1">
                                    Кол-во
                                </th>
                                <th  class="col-sm-1">
                                    <span class=" d-none d-sm-block">
                                    Цена
                                    </span>
                                </th>
                                <th class="col-sm-1">
                                    Сумма
                                </th>
                                <th class="col-1 col-sm-2">
                                    <span class=" d-none d-sm-block">
                                    <span class="d-lg-none">Дата дост</span>
                                    <span class="d-none d-lg-block">Предварительная дата доставки</span>
                                    </span>
                                </th>
                                <th class="col-sm-1 text-center">
                                    <span class="d-lg-none">X</span>
                                    <span class="d-none d-lg-block">Удалить</span>
                                </th>
                            </tr>
                            {foreach $arUser['user_cart'] as $productCart}
                                {$pric = $productCart['price']|floatval}
                                {$quan = $productCart['quantity']|intval}
                                {assign var="sum" value="`$sum+$pric*$quan`"}
                                <tr id="trCartOrd_{$productCart['product_id']}">
                                    <td class="image">
                                        <a href="{$productCart['link']}">
                                            <img src="/images/product/{$productCart['image']}"
                                                 alt="{$productCart['name']}"
                                                 title="{$productCart['name']}"
                                                 class="img-thumbnail img-fluid"/>
                                        </a>
                                    </td>
                                    <td class="name text-left">
                                        <a href="{$productCart['link']}"
                                           class="nv-hover">
                                            <p class="text-break mb-0">{$productCart['name']}</p>
                                        </a>
                                    </td>
                                    <td class="quantity text-right align-middle">
                                        <div class="input-group" >
                                            <input type="text" name="quantityNameOrd_{$productCart['product_id']}"
                                                   id="quantityIdOrd_{$productCart['product_id']}"
                                                   value="{$productCart['quantity']}"
                                                   onchange="updCartOrd({$productCart['product_id']},
                                                       $(this).val(), 0, {$productCart['price']}, '{$idsProductCart}');"
                                                   class="form-control border border-col rounded px-0 text-center"/>
                                            <div class="btn-group-vertical" role="group" aria-label="">
                                                <button type=""
                                                        class="btn col-nav nv-navbar border border-col rounded
                                                               px-1 py-1 d-none d-sm-block"
                                                        onclick="updCartOrd({$productCart['product_id']},
                                                                0, 1, {$productCart['price']}, '{$idsProductCart}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="16" height="16" fill="currentColor"
                                                         class="bi bi-plus-lg"
                                                         viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                                    </svg>
                                                </button>
                                                <button type=""
                                                        class="btn col-nav nv-navbar border border-col rounded
                                                               px-1 py-1 d-none d-sm-block"
                                                        onclick="updCartOrd({$productCart['product_id']},
                                                                0, -1, {$productCart['price']}, '{$idsProductCart}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="16" height="16" fill="currentColor"
                                                         class="bi bi-dash-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total text-right align-middle" >
                                        <span id="priceIdOrd_{$productCart['product_id']}" class="d-none d-sm-block">
                                            {$productCart['price']|string_format:"%.2f"}
                                        </span>
                                    </td>
                                    <td class="total text-right align-middle" >
                                        <span id="sumIdOrd_{$productCart['product_id']}">
                                            {($productCart['price']*$quan)|string_format:"%.2f"}
                                        </span>
                                    </td>
                                    <td class="total text-right align-middle" >
                                        {*<span class="d-lg-none">
                                          {$productCart['date_available']|date_format|substr:0:5}
                                        </span>
                                         <span class="d-none d-lg-block">*}
                                        {if $productCart['date_available']|strtotime > $shippingDateNow|strtotime}
                                        <span id="dateIdOrd_{$productCart['product_id']}"
                                          class="d-none d-sm-block">{$productCart['date_available']|date_format}</span>
                                        {else}
                                            <span id="dateIdOrd_{$productCart['product_id']}"
                                            class="d-none">{$shippingDateNow|date_format}</span>
                                        {/if}
                                        {*</span>*}
                                    </td>

                                    <td class="remove text-center align-middle">
                                        <button type="button"
                                                onclick="updCartOrd({$productCart['product_id']},
                                                        0, 0, {$productCart['price']}, '{$idsProductCart}');"
                                                title="Удалить"
                                                class="btn col-nav nv-navbar border border-col rounded px-1 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="16" height="16" fill="currentColor"
                                                 class="bi bi-x-lg mb-1" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                            </svg>
                                        </button>
                                    </td>

                                </tr>
                            {/foreach}
                        </table>
                    </li>
                    <li>
                        <div>
                            <table class="table table-bordered table-striped mb-0 mb-sm-1 mb-md-2">
                                <tr>
                                    <td class="text-right"><strong>Итого:</strong></td>
                                    <td class="text-right">
                                            <span  id="sumCartIdOrd">
                                                {$sum|string_format:"%.2f"}
                                            </span>
                                        {if $smarty.session.userGroup == 4}т{else}руб{/if}
                                    </td>
                                </tr>
                                {if $smarty.session.discount > 0}
                                    <tr>
                                        <td class="text-right">
                                            <strong>
                                                С учётом скидки
                                                <span  id="cartDiscountIdOrd">{$smarty.session.discount}</span>%:
                                            </strong>
                                        </td>
                                        <td class="text-right">
                                            <span  id="sumCartDiscountIdOrd">
                                                {($sum/100*(100-{$smarty.session.discount}))|string_format:"%.2f"}
                                            </span>
                                            {if $smarty.session.userGroup == 4}т{else}руб{/if}
                                        </td>
                                    </tr>
                                {/if}
                                <tr>
                                    <td class="text-right"><strong>Предварительная дата доставки:</strong></td>
                                    <td class="text-right">
                                            <span  id="dateCartIdOrd">
                                                {$shippingDate|date_format}
                                            </span>
                                     </td>
                                </tr>

                            </table>
                            {*<p class="text-right">*}
                            <!--<a href="/user/makingorder/" class="nav-link">
                                <div class='d-inline-flex nv-hover'>
                                            <span class='col-nav nv-hover'>
                                                <h5>Оформление заказа</h5>
                                            </span>
                                </div>
                            </a>-->
                            {*</p>*}
                        </div>
                    </li>
                </ul>
            {else}
                Ваша корзина пуста!
            {/if}
            <h5 class="heading col-nav ps-0 mb-1 mb-sm-2 mb-lg-2 d-flex">
                <span class="pe-2"></span>
                <div class=" flex-fill me-2  mb-1 mb-sm-2 mb-lg-3" id="vn-line"></div>
            </h5>
        </div>

        <div class="px-0 px-sm-2 col-12 col-xl-2 d-none d-xl-block">
             {*banners*}
        </div>
    </div>

    <div class="row mx-0"> <!-- Данные покупателя -->
        <div class="col-lg-6 col-md-7 col-sm-12 pe-0">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-1 mb-lg-2 d-flex">
                <span class="pe-2">Контактные данные</span>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>
            {*<form method="post" action="/restuser/updatein/">*}
                 <div class="input-group  mb-1 mb-sm-1 mb-lg-2  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <span class="input-group-text" id="basic-addon2">
                        <span class="me-3">Имя</span>
                    </span>
                    <input type="text" class="form-control  me-2 me-sm-3 me-lg-5" placeholder="Имя" aria-label="Имя"
                        aria-describedby="basic-addon2" name="name" value="{$arUser['user_name']|@htmlspecialchars}">
                </div>

                <div class="input-group  mb-1 mb-sm-1 mb-lg-2  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <div class="btn-group">
                        <button class="btn bg-nav-btn col-nav nv-navbar dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-telephone-fill d-block d-md-none" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                            <span class=" d-none d-md-block">Выберите/добавьте телефон</span>

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            {assign var="phoneDef" value=""}
                            {foreach from=$phone item=$phon name=phonArr}
                                {if $smarty.foreach.phonArr.first} {assign var="phoneDef" value="`$phon`"} {/if}
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick='selectСontact("{$phon}", "phone");return false;'>
                                        {$phon|@htmlspecialchars}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <input type="text" class="form-control  me-2 me-sm-3 me-lg-5" placeholder="Телефон"
                           aria-label="Телефон" aria-describedby="basic-addon2"
                           name="phoneOrd" id="phoneOrdId" value="{$phoneDef|@htmlspecialchars}">
                </div>

                <div class="input-group mb-1 mb-sm-1 mb-lg-2  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <div class="btn-group">
                        <button class="btn bg-nav-btn col-nav nv-navbar dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-envelope-fill d-block d-md-none" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                            </svg>
                            <span class=" d-none d-md-block">Выберите/добавьте E-mail</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            {assign var="emailDef" value=""}
                            {foreach from=$email item=$mail name=mailArr}
                                {if $smarty.foreach.mailArr.first} {assign var="emailDef" value="`$mail`"} {/if}
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick='selectСontact("{$mail}", "email");return false;'>
                                        {$mail|@htmlspecialchars}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <input type="text" class="form-control  me-2 me-sm-3 me-lg-5" placeholder="E-mail"
                           aria-label="E-mail" aria-describedby="basic-addon2"
                           name="emailOrd" id="emailOrdId" value="{$emailDef|@htmlspecialchars}">
                </div>

                <div class="input-group mb-1 mb-sm-1 mb-lg-2  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <div class="btn-group dropup">
                        <button class="btn bg-nav-btn col-nav nv-navbar dropdown-toggle" type="button"
                                 id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-geo-alt-fill d-block d-md-none" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            <span class=" d-none d-md-block">Выберите/добавьте адрес доставки</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            {assign var="addressDef" value=""}
                            {foreach from=$address item=$addr name=addrArr}
                                {if $smarty.foreach.addrArr.first} {assign var="addressDef" value="`$addr`"} {/if}
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick='selectСontact("{$addr}", "address");return false;'>
                                        {$addr|@htmlspecialchars}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <textarea class="form-control me-2 me-sm-3 me-lg-5" aria-label="Дополнительные условия"
                              name="addressOrd" id="addressOrdId" >{$addressDef|@htmlspecialchars}</textarea>
                    {*<input type="text" class="form-control  me-2 me-sm-3 me-lg-5" placeholder="Адрес" aria-label="Адрес"
                           aria-describedby="basic-addon2" name="address" value="">*}
                </div>


            {*</form>*}
        </div>

        <div class="col-lg-6 col-md-5 col-sm-12 pe-0">
            <div class="row ms-0 ms-md-2 me-0 ">
                <div class="row px-0">
                    <div class="col-12 col-lg-8 pe-1 ps-2">
                        <h5 class="heading col-nav ps-0 mb-1 mb-sm-1 mb-lg-2 d-flex">
                            <span class="pe-2">Способ оплаты</span>
                            <div class=" flex-fill me-2" id="vn-line"></div>
                        </h5>
                        <select class="form-select border border-col rounded pe-4 mb-1 mb-sm-2"
                                id="paymentMethod"
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Способ оплаты" data-bs-custom-class="custom-tooltip">
                            {*<option selected disabled>Выберите</option>*}
                            {*foreach $paymentMethod as $payMethod*}
                            {foreach from=$paymentMethod item=$payMethod name=paymentMethodName}
                                <option value={$payMethod['id']}
                                         {if $smarty.foreach.paymentMethodName.first}selected{/if}>
                                    {$payMethod['name']}
                                </option>
                            {/foreach}
                        </select>

                        <h5 class="heading col-nav ps-0 mb-1 mb-sm-1 mb-lg-2 d-flex">
                            <span class="pe-2">Способ доставки</span>
                            <div class=" flex-fill me-2" id="vn-line"></div>
                        </h5>
                        <select class="form-select border border-col rounded pe-4 mb-1 mb-sm-2"
                                id="shippingMethod"
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Способ доставки" data-bs-custom-class="custom-tooltip">
                            {*<option selected disabled>Выберите</option>
                            {foreach $shippingMethod as $shipMethod*}
                            {foreach from=$shippingMethod item=$shipMethod name=shippingMethodName}
                                <option value={$shipMethod['id']}
                                        {if $smarty.foreach.shippingMethodName.first}selected{/if}>
                                    {$shipMethod['name']}
                                </option>
                            {/foreach}
                        </select>

                        <h5 class="heading col-nav ps-0 mb-1 mb-sm-1 mb-lg-2 d-flex">
                            <span class="pe-2">Комментарий</span>
                            <div class=" flex-fill me-2" id="vn-line"></div>
                        </h5>
                        <div class="input-group ps-0 mb-1 mb-sm-1 mb-lg-2">
                            {*<span class="input-group-text">Коммен-</br>тарий</span>*}
                            <textarea class="form-control me-0" aria-label="Дополнительные условия"
                                      name="condition">{$arUser['conditions']}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 pe-1 ps-2 d-none d-xl-block">
                        {*banners*}
                    </div>
                </div>

            </div>
        </div>
        <div class=" d-flex justify-content-center">
            <button type="submit" class="btn bg-nav-btn col-nav nv-navbar col-11 col-lg-4 mb-1">
                Все данные верны, оформить заказ
            </button>
        </div>
    </div>

</div>