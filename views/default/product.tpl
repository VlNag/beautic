{* Страница товара*}
<div class="container my-0">
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1">
            {include file='menu.tpl'}
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 pe-0 pe-md-1 ps-0 mb-1">
        <div class="container my-auto px-0 bg-nav h-100 mb-1">
            <nav aria-label="breadcrumb" class="ms-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 width="16" height="16" fill="currentColor"
                                 class="bi bi-house-door col-nav nv-hover" 
                                 viewBox="0 0 16 16">
                                <path
                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                            </svg>
                        </a>
                    </li>
                    {assign var="hrefStart" value="/category/"}
                    {assign var="hrefCur" value=""}
                    {foreach $cats as $cat name="category"}
                        {if $smarty.foreach.category.first}
                            {assign var="hrefCur" value="{$hrefCur}{$cat['id']}"}
                        {else}
                            {assign var="hrefCur" value="{$hrefCur}_{$cat['id']}"}
                        {/if}
                        {if $smarty.foreach.category.last}
                            <li class="breadcrumb-item">
                                <a href="/products/{$hrefCur}/1/" 
                                   class='col-nav-hover nv-hover'>
                                    <span class="col-nav nv-hover">{$cat['name']}</span>
                                </a>
                            </li>
                        {else}    
                            <li class="breadcrumb-item">
                                <a href="{$hrefStart}{$hrefCur}/" 
                                   class='col-nav-hover nv-hover'>
                                    <span class="col-nav nv-hover">{$cat['name']}</span>
                                </a>
                            </li>
                        {/if}
                        {/foreach}
                    <li class="breadcrumb-item active" aria-current="page">
                        {$rsProduct['name']}
                    </li>
                </ol>
            </nav>
            <h3 class="heading col-nav ms-2 d-flex">
            <a data-bs-toggle="collapse" href="#descrProd" aria-expanded="true" 
            aria-controls="descrProd" role="button"
            class='nv-a nv-a2 col-nav-hover nv-hover'
            >
                {*<span>*}<h3 class="pe-2 mb-0">{$rsProduct['name']}</h3>{*</span>*}
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>    
            </h3>
            <div class="row me-0">
                {*<div>*}
                <div class="col-12 col-lg-6">
                <a role="button" data-bs-toggle="modal" data-bs-target="#imageModal" >
                    <img src="/images/product/md/{$rsProduct['image']}" 
                        class="float-start imgshadow img-fluid mx-2 my-2">
                    {*img-fluid*}
                </a> 
                
                    
<!-- Модальное окно -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header  px-1 py-1 px-sm-2 py-sm-2 px-md-3 py-md-3">
        <h5 class="modal-title heading col-nav " id="exampleModalLabel">{$rsProduct['name']}</h5>
        <button type="button" class="btn-close nv-a3" 
                data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body px-1 py-1 px-sm-2 py-sm-2 px-md-3 py-md-3">
      <img src="/images/product/lg/{$rsProduct['image']}" 
         class="img-fluid">
      </div>
      {*<div class="modal-footer  px-1 py-1 px-sm-2 py-sm-2 px-md-3 py-md-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить изменения</button>
      </div>*}
    </div>
  </div>
</div>



                </div>  
                <div class="col-12 col-lg-6"> 
                    <p class="col-nav ms-1">  
                            Артикул {$rsProduct['article']} <br/>
                            Дата доставки {$rsProduct['date_available']} <br/>
                            Цена {$rsProduct['price']|string_format:"%.2f"} {$rsProduct['currency'] } <br/>
                            Остаток {*$rsProduct['quantity']*} 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16"
                                {if $rsProduct['quantity']>30}
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Достаточное количество"
                                    data-bs-custom-class="custom-tooltip">
                                    <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                {elseif $rsProduct['quantity']>10} 
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Достаточно"
                                    data-bs-custom-class="custom-tooltip">                                
                                    <path d=    "M2 8a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2z"/>
                                {elseif $rsProduct['quantity']>1}
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Количество ограничено"
                                    data-bs-custom-class="custom-tooltip">
                                    <path d=    "M2 8a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2zm3 3a1
                                    0-2zm0-3a1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2z"/>
                                {elseif $rsProduct['quantity']>0}
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Мало"
                                        data-bs-custom-class="custom-tooltip"> 
                                        <path d= "M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2z"/>
                                  
                                {else}   
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Нет на остатках"
                                    data-bs-custom-class="custom-tooltip"> 
                                    <path d=    "M2 8a1 1 0 1 1 0 2 1 1 0 0 1 
                                    0-2zm0-3a1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2zm3 3a1
                                    0-2zm0-3a1 
                                    0-2zm3 3a1 
                                    0-2zm0-3a1 
                                    0-2z"/>
                                {/if}
                            </svg>
                            <br/>
                    </p>
                    
                    <div class="d-flex flex-row align-items-center">
                    <a id="addwishlist_{$rsProduct['productId']}" href="#" 
                        onClick='addToBookmark({$rsProduct['productId']},"/product/{$hrefCur}/{$rsProduct['productId']}/",0);return false; '; 
                        alt='Удалить из закладок' 
                        class="me-1 me-sm-2 me-lg-3 me-xl-4  ms-1 nav-link {if ! $rsProduct['bookmarks']} hideme"{else}"{/if}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            
                            class="bi bi-heart-fill d-block d-sm-none" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Удалить из закладок" data-bs-custom-class="custom-tooltip"
                            class="bi bi-heart-fill d-none d-sm-block" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>

                    </a>
                    <a id="removewishlist_{$rsProduct['productId']}" href="#" 
                        onClick='addToBookmark({$rsProduct['productId']},"/product/{$hrefCur}/{$rsProduct['productId']}/",1);return false; ';
                        alt='Добавить в закладки' 
                        class="me-1 me-sm-2  me-lg-3 me-xl-4  ms-1 nav-link {if  $rsProduct['bookmarks']} hideme"{else}"{/if} >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            
                            class="bi bi-heart d-block d-sm-none" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Добавить в закладки" data-bs-custom-class="custom-tooltip"
                            class="bi bi-heart d-none d-sm-block" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>


                    </a>

                    <a id="addcart_{$rsProduct['productId']}" href="#"
                        onClick='addToCart({$rsProduct['productId']},"/product/{$hrefCur}/{$rsProduct['productId']}/",0);document.location.reload();';
                        return false; alt='Добавить в корзину' 
                        class="me-1  mb-1 nav-link {if ! $rsProduct['inCart']} hideme" {else}"{/if}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                        </svg>
                    </a>
                    <a id="removecart_{$rsProduct['productId']}" href="#"
                        onClick='addToCart({$rsProduct['productId']},"/product/{$hrefCur}/{$rsProduct['productId']}/",1);document.location.reload();';
                        return false; alt='Добавить в корзину' 
                        class="me-1  mb-1 nav-link {if  $rsProduct['inCart']} hideme" {else}"{/if}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            class="bi bi-basket3" viewBox="0 0 16 16">
                            <path 
                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                        </svg>
                    </a>
                 
                </div>

                </div>
            </div>
            <div class="collapse show ms-1" id="descrProd">
            <p>{$rsProduct['description']}</p>
            {*<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa aut, sit dolore nemo qui earum fugiat corporis repudiandae voluptatibus laborum temporibus ut ipsum provident deserunt esse molestias, nam maxime. Pariatur quae vitae rerum repellat laudantium temporibus quibusdam cum suscipit sequi nostrum reprehenderit voluptatibus adipisci, tempore dolores neque omnis officiis sint?</p>
            *}
            </div>             
        </div>
        </div>
    </div>
</div>