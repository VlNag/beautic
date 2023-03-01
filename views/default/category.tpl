{* Страница категории*}
<div class="container my-0">
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1"> 
            {include file='menu.tpl'}
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 pe-0 pe-md-1 ps-0 mb-1">
            <div class="container my-auto px-0 bg-nav h-100 mb-1">
                {include file='categoryhead.tpl'}
                {assign var="href1" value=""}
                {foreach $cats as $cat name="category1"}
                    {if $smarty.foreach.category1.first}
                        {assign var="href1" value="{$href1}{$cat['id']}"}
                    {else}
                        {assign var="href1" value="{$href1}_{$cat['id']}"}
                    {/if}
                {/foreach}
                {if $rsCategoriesChildren}
                    {*<div class="card-group"> row-cols-md-4*}
                    <div class="row row-cols-2 row-cols-sm-3   row-cols-lg-5 g-4 mx-0">
                        {foreach $rsCategoriesChildren as $itemCat name=catCildren}
                            <div class="col">
                                <div class="card h-100 bg-nav-btn">
                                {if $itemCat['last']}
                                <a href="/products/{$href1}_{$itemCat['categoryId']}/1/">
                                    <img src="/images/category/{$itemCat['image']}" 
                                         class="card-img-top" alt="category">
                                         {*width="80"*}
                                </a> 
                                {else}
                                    <a href="/category/{$href1}_{$itemCat['categoryId']}/">
                                    <img src="/images/category/{$itemCat['image']}" 
                                         class="card-img-top" alt="category">
                                </a>    
                                {/if}    
                                        {*<div class="card-body">
                                            <h5 class="card-title"></h5> 
                                            <p class="card-text">
                                                <span class="d-inline-block text-truncate text-nowrap"
                                                    style="max-width: 14rem; max-height: 2rem;">
                                                    {$itemCat['description']|strip_tags:false}
                                                </span>
                                            </p>
                                        </div> *}
                                    <div class="card-footer text-muted  h-100  w-100
                                                mx-auto my-0 bg-nav-btn-hover">
                                        {if $itemCat['last']}
                                            <a href="/products/{$href1}_{$itemCat['categoryId']}/1/"
                                                class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100 w-100">{$itemCat['name']}
                                            </a>
                                        {else}
                                            <a href="/category/{$href1}_{$itemCat['categoryId']}/"
                                                class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100 w-100">{$itemCat['name']}
                                            </a>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {/if}
            </div>
        </div> 
    </div>
</div>