<nav aria-label="breadcrumb" class="ms-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     width="16" height="16" fill="currentColor"
                     class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
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
                <li class="breadcrumb-item active" aria-current="page">{$cat['name']}</li>
            {else}
                <li class="breadcrumb-item">
                    <a href="{$hrefStart}{$hrefCur}/" class='col-nav-hover nv-hover'>
                        <span class="col-nav nv-hover">{$cat['name']}</span>
                    </a>
                </li>
            {/if}
        {/foreach}
    </ol>
</nav>

<h3 class="heading col-nav ms-2 d-flex">
    <span class="pe-2">{$rsCategory['name']}</span>
    <div class=" flex-fill me-2" id="vn-line"> </div>    
</h3>

<div class="row me-0">
    <div>
    <a data-bs-toggle="collapse" href="#descrCat" aria-expanded="true" 
       aria-controls="descrCat" role="button" >
        <img src="/images/category/{$rsCategory['image']}" 
             class="float-start imgshadow img-fluid mx-1 mx-md-2 my-1 my-md-2">
            {*img-fluid itd_image  height="260"*}
    </a>

    <div class="collapse show" id="descrCat">
        <p>{$rsCategory['description']}</p>
    </div>    
        {*    Стоимость: {$rsProduct['price']}
<a id="removeCart_{$rsProduct['id']}" {if ! $itemInCart}class='hideme'{else}class='color2'{/if}  href="#" onClick='removeFromCart({$rsProduct['id']})'; return false;  alt='Удалить из корзины'>Удалить из корзины</a>
<a id="addCart_{$rsProduct['id']}" {if $itemInCart}class='hideme'{else}class='color2'{/if} href="#" onClick='addToCart({$rsProduct['id']})'; return false;  alt='Добавить в корзину'>Добавить в корзину</a>
*}
    </div> 
</div>
<hr class="nv-hr">
