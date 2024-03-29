<div class="container my-0">
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1">
            {include file='menu.tpl'}
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 pe-0 pe-md-1 ps-0 mb-1">

            <div class="container my-auto px-0 bg-nav h-100 mb-1">
                <nav aria-label="breadcrumb" class="ms-2">
                    <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
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
                    <div class=" flex-fill me-2" id="vn-line"></div>
                </h3>

                {if $bookmarks}
                    <div class="container my-auto px-0 bg-nav mb-1">

                        <div class="d-flex mb-2 mx-1" id="wishlistinput">
                            <div class="form-check form-switch my-1 nv-hover">
                                {if $layout == 'rows'}
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2"
                                           onchange="changelayout(this.checked);document.location.reload();">
                                {else}
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2"
                                           onchange="changelayout(this.checked);document.location.reload();" checked>
                                {/if}
                                <label class="form-check-label col-nav nv-hover d-none d-sm-block"
                                       for="flexSwitchCheckDefault2">
                                    rows/table
                                </label>
                            </div>
                        </div>
                        {if $layout == 'rows'}
                            <!--<div class="row mx-0">-->
                            <div class="row mb-1 mx-0 mx-sm-1" id="wishlistcup">
                                <div class="col-1 pe-0">

                                </div>
                                <div class="col-7 col-sm-8 px-0">
                                    <span class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100  w-100">
                                        <p class="text-break mb-1">Товар</p>
                                    </span>
                                </div>
                                <div class="col-3 col-sm-2 px-0">
                                    <p class="col-nav text-center mb-0">
                                        Цена, {$currency}
                                    </p>
                                </div>
                                <div class="col-1 ps-0">

                                </div>
                            </div>
                            {*foreach $bookmarks as $itemProd name=prodCildren*}
                            {foreach from=$bookmarks key=myId item=itemProd name=prodCildren}
                                <div class="row mb-1 mx-0 mx-sm-1" id="wishlist_{$itemProd['product_id']}">
                                    <div class="col-1 px-0">
                                        <a href="{$itemProd['link']}">
                                            <img src="/images/product/{$itemProd['image']}"
                                                 class="card-img-top" alt="product">
                                        </a>
                                    </div>
                                    <div class="col-7 col-sm-8  px-0">
                                        <a href="{$itemProd['link']}"
                                           class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100  w-100
                                                  px-0 py-0 d-flex align-items-center justify-content-center">
                                            <p class="text-break mb-0">{$itemProd['name']}</p>
                                        </a>
                                    </div>
                                    <div
                                            class="col-3 col-sm-2 px-0 d-flex align-items-center justify-content-center
                                                   border border-secondary rounded">
                                        <p class="col-nav text-center align-middle mb-0">
                                            {*Цена: {$itemProd['price']|string_format:"%.2f"} {$currency}*}
                                            {$itemProd['price']|string_format:"%.2f"}
                                        </p>
                                    </div>
                                    <div
                                            class="col-1 px-0 d-flex flex-column flex-md-row align-items-center
                                               justify-content-center border border-secondary rounded">
                                        <a id="addwishlist_{$itemProd['product_id']}" href="#"
                                           onClick="addToBookmark({$itemProd['product_id']},
                                                '{$itemProd['link']}',0); return false; "
                                           alt='Удалить из закладок'
                                           class="me-1 me-lg-3 me-xl-4 nav-link
                                                  {if ! $itemProd['bookmarks']} hideme" {else}"{/if}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                 data-bs-title="Удалить из закладок"
                                                 data-bs-custom-class="custom-tooltip"
                                                 class="bi bi-heart-fill ms-0 ms-md-1 toltip" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </a>
                                        <a id="removewishlist_{$itemProd['product_id']}" href="#"
                                           onClick='addToBookmark({$itemProd['product_id']},"{$itemProd['link']}",1);
                                                     return false;'
                                           alt='Добавить в закладки'
                                           class="me-1 me-lg-3 me-xl-4 nav-link
                                                  {if  $itemProd['bookmarks']} hideme" {else}"{/if}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             data-bs-toggle="tooltip" data-bs-placement="bottom"
                                             data-bs-title="Добавить в закладки"
                                             data-bs-custom-class="custom-tooltip"
                                             class="bi bi-heart ms-0 ms-md-1" viewBox="0 0 16 16">
                                            <path
                                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                        </a>

                                        <a id="addcart_{$itemProd['product_id']}" href="#"
                                           onClick="addToCart({$itemProd['product_id']},0);
                                                location.reload(); return false;"
                                           alt='Удалить из корзины'
                                           class="me-1  mb-1 nav-link
                                                {if ! $itemProd['inCart']} hideme" {else}"{/if}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-basket3-fill d-block d-sm-none" viewBox="0 0 16 16">
                                                <path
                                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-basket3-fill d-none d-sm-block" viewBox="0 0 16 16"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-title="Удалить из корзины"
                                                data-bs-custom-class="custom-tooltip">
                                                <path
                                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                            </svg>
                                        </a>
                                        <a id="removecart_{$itemProd['product_id']}" href="#"
                                           onClick='addToCart({$itemProd['product_id']},1,
                                                             "{$itemProd['image']}",
                                                             "{$itemProd['name']}",
                                                             "{$itemProd['price']|string_format:"%.2f"}",
                                                             "{$itemProd['link']}",
                                                             "{$itemProd['date_available']}");
                                                location.reload(); return false;'
                                           alt='Добавить в корзину'
                                           class="me-1  mb-1 nav-link
                                                 {if  $itemProd['inCart']} hideme" {else}"{/if}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-basket3 d-block d-sm-none" viewBox="0 0 16 16">
                                            <path
                                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-basket3 d-none d-sm-block" viewBox="0 0 16 16"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-title="Добавить в корзину"
                                            data-bs-custom-class="custom-tooltip">

                                            <path
                                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                        </svg>


                                        </a>

                                    </div>
                                </div>
                            {/foreach}
                            <!--</div>-->
                        {else}
                            <div class="row row-cols-2 row-cols-sm-3 
                                       row-cols-lg-5 g-4 mx-0">
                                {*foreach $bookmarks as $itemProd name=prodCildren*}
                                {foreach from=$bookmarks key=myId item=itemProd name=prodCildren}
                                    <div class="col" id="wishlist_{$itemProd['product_id']}">
                                        <div class="card h-100 bg-nav-btn">
                                            <a href="{$itemProd['link']}">
                                                <img src="/images/product/{$itemProd['image']}"
                                                     class="card-img-top" alt="product">
                                            </a>
                                            <div class="card-body px-1 py-1">
                                                {*<div class="col-1 px-0 d-flex flex-column flex-md-row
                                                align-items-center justify-content-center
                                                border border-secondary rounded">*}
                                                <div class="d-flex flex-row align-items-center justify-content-center ">
                                                    <a id="addwishlist_{$itemProd['product_id']}" href="#"
                                                       onClick='addToBookmark({$itemProd['product_id']},
                                                            "{$itemProd['link']}",0); return false;' {*document.location.reload();*}
                                                       alt='Удалить из закладок'
                                                       class="me-1 me-sm-2 me-lg-3 me-xl-4 nav-link
                                                                  {if ! $itemProd['bookmarks']} hideme" {else}"{/if}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-title="Удалить из закладок"
                                                         data-bs-custom-class="custom-tooltip"
                                                         fill="currentColor" class="bi bi-heart-fill toltip"
                                                         viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                    </svg>
                                                    </a>
                                                    <a id="removewishlist_{$itemProd['product_id']}" href="#"
                                                       onClick='addToBookmark({$itemProd['product_id']},
                                                        "{$itemProd['link']}",1);return false;'
                                                       alt='Добавить в закладки'
                                                       class="me-1 me-sm-2  me-lg-3 me-xl-4 nav-link
                                                              {if  $itemProd['bookmarks']} hideme" {else}"{/if}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-title="Добавить в закладки"
                                                         data-bs-custom-class="custom-tooltip"
                                                         fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                        <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                    </svg>
                                                    </a>
                                                    <a id="addcart_{$itemProd['product_id']}" href="#"
                                                       onClick='addToCart({$itemProd["product_id"]}, 0);
                                                       return false;
                                                       location.reload();'
                                                       alt='Добавить в корзину'
                                                       class="me-1  mb-1 nav-link
                                                              {if ! $itemProd['inCart']} hideme" {else}"{/if}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-basket3-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                                    </svg>
                                                    </a>
                                                    <a id="removecart_{$itemProd['product_id']}" href="#"
                                                       onClick='addToCart({$itemProd['product_id']}, 1,
                                                                 "{$itemProd['image']}",
                                                                 "{$itemProd['name']}",
                                                                 "{$itemProd['price']|string_format:"%.2f"}",
                                                                 "{$itemProd['link']}",
                                                                 "{$itemProd['date_available']}") ;
                                                                 location.reload();
                                                                 return false;'
                                                       alt='Добавить в корзину'
                                                       class="me-1  mb-1 nav-link
                                                              {if  $itemProd['inCart']} hideme" {else}"{/if}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-basket3"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                                    </svg>
                                                    </a>
                                                </div>
                                                <p class="col-nav text-center mb-0">
                                                    Цена: {$itemProd['price']|string_format:"%.2f"} {$currency}
                                                </p>
                                            </div>
                                            <div class="card-footer text-muted  h-100   w-100
                                                mx-auto my-0 bg-nav-btn-hover">
                                                <a href="{$itemProd['link']}"
                                                   class="btn mt-auto bg-nav-opposite col-nav-opposite
                                                             nv-hover h-100  w-100 ">
                                                    <p class="text-break">{$itemProd['name']}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        {/if}
                    </div>
                {else}
                    <span class="ms-1"> Закладки пусты </span>
                {/if}
            </div>
        </div>
    </div>
</div>
        

