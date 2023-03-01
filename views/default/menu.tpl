<div class="container-fluid me-md-1 " id="leftMenu">
    <div class="row flex-nowrap">
        <!-- <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark"> -->
        <div class="col-12 px-sm-2 px-0 bg-nav me-1">
            <div class="d-flex flex-column align-items-center 
                  align-items-md-start px-0 px-md-3 pt-2">
                <!-- min-vh-100 -->
                <a data-bs-toggle="collapse" href="#submenu" role="button" 
                   aria-expanded="false" aria-controls="submenu" 
                   class="d-flex align-items-center pb-3 
                          mb-md-0 me-md-auto text-decoration-none">
                    <span class="fs-5 col-nav nv-hover">Категории</span>
                </a>
                <ul class="nav nav-pills nav-justified flex-column 
                        mb-sm-auto mb-0 align-items-center 
                        align-items-sm-start w-100"
                    id="menu">
                    {foreach $rsCategories as $item}
                        {if $item['children']}
                            <li class="nav-item dropend d-none d-md-block">
                                <a class="nav-link dropdown-toggle nv-hover col-nav" 
                                   href="/category/{$item['categoryId']}/" 
                                   id="navbarScrollingDropdown"
                                   role="button" data-bs-toggle="dropdown" 
                                   aria-expanded="false">
                                   <span class="col-nav nv-hover">{$item['name']}</span>
                                </a>
                                <ul class="dropdown-menu bg-nav-opposite" 
                                    aria-labelledby="navbarScrollingDropdown">
                                    {foreach $item['children'] as $itemChild}
                                        <li class="nv-hover">
                                            <a class="dropdown-item nv-hover" 
                                               {if $itemChild['last']}                                           
                                               href=
                                               "/products/{$item['categoryId']}_{$itemChild['categoryId']}/1/">
                                               {else}
                                                href=
                                                "/category/{$item['categoryId']}_{$itemChild['categoryId']}/">
                                                {/if}
                                               <span class="col-nav-opposite nv-hover">
                                                   {$itemChild['name']}
                                               </span>  
                                            </a>
                                        </li>
                                    {/foreach}
                                    <li><hr class="dropdown-divider"></li> 
                                    <li>
                                        <a class="dropdown-item  nv-hover col-nav-opposite" 
                                           href="/category/{$item['categoryId']}/">
                                           Все из категории {$item['name']} 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        {/if}
                    {/foreach}

                    <div class="collapse  w-100 " id="submenu">
                        {foreach $rsCategories as $item1}
                            {if $item1['children']}
                                <li class="d-md-none w-100 ">
                                    <a href=
                                    "#submenu{$item1['categoryId']}" data-bs-toggle="collapse" 
                                        class="nav-link px-0  nv-hover col-nav d-flex 
                                        justify-content-center">
                                        <!-- <i class="fs-4 bi-speedometer2"></i> -->
                                        <span class="ms-1  col-nav nv-hover ">
                                            {$item1['name']}
                                        </span>
                                    </a>
                                    <ul class="collapse nav flex-column" 
                                        id="submenu{$item1['categoryId']}"
                                        data-bs-parent="#submenu">
                                        {foreach $item1['children'] as $itemChild1}
                                            <li class="w-100 bg-nav-opposite nv-hover" id="nv-li">
                                                {*assign var="text" value=" "|explode:{$itemChild['name']}*}
                                                <a class="nav-link align-middle nv-hover 
                                                          d-flex justify-content-center"
                                                {if $itemChild1['last']}           
                                                href=
                                                    "/products/{$item1['categoryId']}_{$itemChild1['categoryId']}/1/"> 
                                                {else}
                                                href=
                                                    "/category/{$item1['categoryId']}_{$itemChild1['categoryId']}/"> 
                                                 {/if}   
                                                <span class=" nv-hover col-nav-opposite">
                                                    {$itemChild1['name']}
                                                </span>
                                                </a>
                                            </li>
                                        {/foreach}
                                    </ul>
                                </li>
                            {/if}
                        {/foreach}
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
 