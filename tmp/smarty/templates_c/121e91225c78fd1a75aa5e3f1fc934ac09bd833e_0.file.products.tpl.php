<?php
/* Smarty version 4.2.1, created on 2023-02-24 15:47:42
  from 'D:\xampp\htdocs\beautic.local\views\default\products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f8ce0e669780_42757621',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '121e91225c78fd1a75aa5e3f1fc934ac09bd833e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\products.tpl',
      1 => 1677250058,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.tpl' => 1,
    'file:categoryhead.tpl' => 1,
  ),
),false)) {
function content_63f8ce0e669780_42757621 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container my-0"> 
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1">
            <?php $_smarty_tpl->_subTemplateRender('file:menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 pe-0 pe-md-1 ps-0 mb-1">
            <div class="container my-auto px-0 bg-nav h-100 mb-1">
                <?php $_smarty_tpl->_subTemplateRender('file:categoryhead.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php $_smarty_tpl->_assignInScope('href1', '');?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cats']->value, 'cat', false, NULL, 'category1', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_category1']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_category1']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_category1']->value['index'];
?>
                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_category1']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_category1']->value['first'] : null)) {?>
                        <?php $_smarty_tpl->_assignInScope('href1', ((string)$_smarty_tpl->tpl_vars['href1']->value).((string)$_smarty_tpl->tpl_vars['cat']->value['id']));?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->_assignInScope('href1', ((string)$_smarty_tpl->tpl_vars['href1']->value)."_".((string)$_smarty_tpl->tpl_vars['cat']->value['id']));?>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <div class="d-flex mb-2 mx-1">
                    <div class="form-check form-switch my-1 nv-hover">
                        <?php if ($_smarty_tpl->tpl_vars['layout']->value == 'rows') {?>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2"
                                onchange="changelayout(this.checked);document.location.reload();">
                        <?php } else { ?>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2"
                                onchange="changelayout(this.checked);document.location.reload();" checked>
                        <?php }?>
                        <label class="form-check-label col-nav nv-hover d-none d-sm-block"
                            for="flexSwitchCheckDefault2">
                            rows/table
                        </label>
                    </div>

                    <div class="flex-fill text-end me-2 my-1 col-nav">
                        Показать
                    </div>
                    <select class="form-select w-25 nv-navbar"
                        onchange="changeperpage(this.value);document.location.reload();"
                        aria-label="Default select example">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['optionPerPage']->value, 'optionPage');
$_smarty_tpl->tpl_vars['optionPage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['optionPage']->value) {
$_smarty_tpl->tpl_vars['optionPage']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['optionPage']->value['select']) {?>
                                <option selected value=<?php echo $_smarty_tpl->tpl_vars['optionPage']->value['value'];?>
>
                                    <?php echo $_smarty_tpl->tpl_vars['optionPage']->value['value'];?>

                                </option>
                            <?php } else { ?>
                                <option value=<?php echo $_smarty_tpl->tpl_vars['optionPage']->value['value'];?>
>
                                    <?php echo $_smarty_tpl->tpl_vars['optionPage']->value['value'];?>

                                </option>
                            <?php ob_start();
}
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['rsProductsPage']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['layout']->value == 'rows') {?>
                        <!--<div class="row mx-0">-->
                        <div class="row mb-1 mx-0 mx-sm-1">
                            <div class="col-1 pe-0">

                            </div>
                            <div class="col-7 col-sm-8 px-0">
                                <span class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100  w-100">
                                    <p class="text-break mb-1">Товар</p>
                                </span>
                            </div>
                            <div class="col-3 col-sm-2 px-0">
                                <p class="col-nav text-center mb-0">
                                    Цена, <?php echo $_smarty_tpl->tpl_vars['currency']->value;?>

                                </p>
                            </div>
                            <div class="col-1 ps-0">

                            </div>
                        </div>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProductsPage']->value, 'itemProd', false, NULL, 'prodCildren', array (
));
$_smarty_tpl->tpl_vars['itemProd']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemProd']->value) {
$_smarty_tpl->tpl_vars['itemProd']->do_else = false;
?>
                            <div class="row mb-1 mx-0 mx-sm-1">
                                <div class="col-1 px-0">
                                    <a href="/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/">
                                        <img src="/images/product/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['image'];?>
" class="card-img-top" alt="product">
                                    </a>
                                </div>
                                <div class="col-7 col-sm-8  px-0">
                                    <a href="/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/" class="btn mt-auto bg-nav-opposite nv-hover h-100  w-100 
                                            px-0 py-0 d-flex align-items-center justify-content-center col-nav-opposite">
                                        <p class="text-break mb-0"><?php echo $_smarty_tpl->tpl_vars['itemProd']->value['name'];?>
</p>
                                    </a>
                                </div>
                                <div class="col-3 col-sm-2 px-0 d-flex align-items-center justify-content-center border border-secondary rounded">
                                    <p class="col-nav text-center align-middle mb-0">
                                                                                <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['itemProd']->value['price']);?>

                                    </p>
                                </div> 
                                <div class="col-1 px-0 d-flex flex-column flex-md-row align-items-center justify-content-center border border-secondary rounded">
                                                                        <a id="addwishlist_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#" 
                                        
                                                                                onClick='addToBookmark(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",0);return false; '
                                        alt='Удалить из закладок' 

                                        class="me-1 me-lg-3 me-xl-4 nav-link <?php if (!$_smarty_tpl->tpl_vars['itemProd']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Удалить из закладок" data-bs-custom-class="custom-tooltip"
                                            class="bi bi-heart-fill ms-0 ms-md-1" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </a>
                                    <a id="removewishlist_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#" 

                                                                                onClick='addToBookmark(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",1); return false'
                                        alt='Добавить в закладки' 

                                        class="me-1 me-lg-3 me-xl-4 nav-link <?php if ($_smarty_tpl->tpl_vars['itemProd']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?> >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Добавить в закладки" data-bs-custom-class="custom-tooltip"
                                            class="bi bi-heart ms-0 ms-md-1" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>
                                    </a>

                                    <a id="addcart_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#"
                                        onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",0);document.location.reload();';
                                        return false; alt='Добавить в корзину' 
                                        class="me-1  mb-1 nav-link <?php if (!$_smarty_tpl->tpl_vars['itemProd']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                        </svg>
                                    </a>
                                    <a id="removecart_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#"
                                        onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",1);document.location.reload();';
                                        return false; alt='Добавить в корзину' 
                                        class="me-1  mb-1 nav-link <?php if ($_smarty_tpl->tpl_vars['itemProd']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                            class="bi bi-basket3" viewBox="0 0 16 16">
                                            <path 
                                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                        </svg>
                                    </a>
                                 
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <!--</div>-->
                    <?php } else { ?>
                        <div class="row row-cols-2 row-cols-sm-3 
                             row-cols-lg-5 g-4 mx-0">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProductsPage']->value, 'itemProd', false, NULL, 'prodCildren', array (
));
$_smarty_tpl->tpl_vars['itemProd']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemProd']->value) {
$_smarty_tpl->tpl_vars['itemProd']->do_else = false;
?>
                                <div class="col">
                                    <div class="card h-100 bg-nav-btn">
                                        <a href="/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/">
                                            <img src="/images/product/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['image'];?>
" class="card-img-top" alt="product">
                                        </a>
                                        <div class="card-body px-1 py-1">
                                                                                <div class="d-flex flex-row align-items-center justify-content-center ">
                                        <a id="addwishlist_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#" 
                                            onClick="addToBookmark(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,'/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/',0);return false;"
                                            alt='Удалить из закладок' 
                                            class="me-1 me-sm-2 me-lg-3 me-xl-4 nav-link <?php if (!$_smarty_tpl->tpl_vars['itemProd']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Удалить из закладок" data-bs-custom-class="custom-tooltip"
                                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </a>
                                        <a id="removewishlist_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#" 
                                            onClick="addToBookmark(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,'/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/',1);return false;"
                                            alt='Добавить в закладки' 
                                            class="me-1 me-sm-2  me-lg-3 me-xl-4 nav-link <?php if ($_smarty_tpl->tpl_vars['itemProd']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?> >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Добавить в закладки" data-bs-custom-class="custom-tooltip"
                                                class="bi bi-heart" viewBox="0 0 16 16">
                                                <path
                                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                            </svg>
                                        </a>
    
                                        <a id="addcart_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#"
                                            onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",0);document.location.reload();';
                                            return false; alt='Добавить в корзину' 
                                            class="me-1  mb-1 nav-link <?php if (!$_smarty_tpl->tpl_vars['itemProd']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                            </svg>
                                        </a>
                                        <a id="removecart_<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
" href="#"
                                            onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/",1);document.location.reload();';
                                            return false; alt='Добавить в корзину' 
                                            class="me-1  mb-1 nav-link <?php if ($_smarty_tpl->tpl_vars['itemProd']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-basket3" viewBox="0 0 16 16">
                                                <path 
                                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                            </svg>
                                        </a>
                                     
                                    </div>
                                            <p class="col-nav text-center mb-0">
                                                Цена: <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['itemProd']->value['price']);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value;?>

                                            </p>
                                        </div>
                                        <div class="card-footer text-muted  h-100   w-100
                                            mx-auto my-0 bg-nav-btn-hover">
                                            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemProd']->value['productId'];?>
/"
                                                class="btn mt-auto bg-nav-opposite nv-hover h-100  w-100 col-nav-opposite">
                                                <p class="text-break"><?php echo $_smarty_tpl->tpl_vars['itemProd']->value['name'];?>
</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['paginator']->value['quanPage'] > 1) {?>
                    <nav aria-label="Навигация по страницам" class="mt-2 bg-nav">
                        <ul class="pagination  justify-content-center mb-1">
                            <?php if ($_smarty_tpl->tpl_vars['paginator']->value['page'] > 1) {?>
                                <?php if ($_smarty_tpl->tpl_vars['paginator']->value['quanPage'] > $_smarty_tpl->tpl_vars['paginator']->value['quanPaginator']) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['paginator']->value['page'] > $_smarty_tpl->tpl_vars['paginator']->value['quanPaginatorHalf']) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/1/" aria-label="Первая">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                <?php }?>
                                <li class="page-item">
                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['paginator']->value['page'];
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('prev', $_prefixVariable2-1);?>
                                    <a class="page-link" href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
/" aria-label="Предыдущая">
                                        <span aria-hidden="true">&lsaquo;</span>
                                    </a>
                                </li>
                            <?php }?>
                            <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['paginator']->value['endPage']+1 - ($_smarty_tpl->tpl_vars['paginator']->value['startPage']) : $_smarty_tpl->tpl_vars['paginator']->value['startPage']-($_smarty_tpl->tpl_vars['paginator']->value['endPage'])+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = $_smarty_tpl->tpl_vars['paginator']->value['startPage'], $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;?>
                                <?php if ($_smarty_tpl->tpl_vars['foo']->value == $_smarty_tpl->tpl_vars['paginator']->value['page']) {?>
                                    <li class="page-item active"><a class="page-link"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a></li>
                                <?php } else { ?>
                                    <li class="page-item"><a class="page-link" href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
/"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a></li>
                                <?php }?>
                            <?php }
}
?>
                            <?php if ($_smarty_tpl->tpl_vars['paginator']->value['page'] < $_smarty_tpl->tpl_vars['paginator']->value['quanPage']) {?>
                                <li class="page-item">
                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['paginator']->value['page'];
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('next', $_prefixVariable3+1);?>
                                    <a class="page-link" href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
/" aria-label="Следующая">
                                        <span aria-hidden="true">&rsaquo;</span>
                                    </a>
                                </li>
                                <?php if ($_smarty_tpl->tpl_vars['paginator']->value['quanPage'] > $_smarty_tpl->tpl_vars['paginator']->value['quanPaginator']) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['paginator']->value['page'] < $_smarty_tpl->tpl_vars['paginator']->value['quanPaginatorEnd']) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['paginator']->value['quanPage'];?>
/"
                                                aria-label="Последняя">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </nav>
                <?php ob_start();
}
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>

                <p class="mb-2 col-nav text-center">
                    Показано с <?php echo $_smarty_tpl->tpl_vars['paginator']->value['startPosition'];?>
 по <?php echo $_smarty_tpl->tpl_vars['paginator']->value['endPosition'];?>
 из
                    <?php echo $_smarty_tpl->tpl_vars['paginator']->value['quanProduct'];?>
 (всего <?php echo $_smarty_tpl->tpl_vars['paginator']->value['quanPage'];?>
 <?php echo $_smarty_tpl->tpl_vars['paginator']->value['pageStr'];?>
)
                </p>
            </div>
        </div>
    </div>
</div><?php }
}
