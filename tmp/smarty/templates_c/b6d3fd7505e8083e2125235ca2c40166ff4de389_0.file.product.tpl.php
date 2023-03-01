<?php
/* Smarty version 4.2.1, created on 2023-02-24 15:40:36
  from 'D:\xampp\htdocs\beautic.local\views\default\product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f8cc640a8006_43266236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6d3fd7505e8083e2125235ca2c40166ff4de389' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\product.tpl',
      1 => 1677249632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.tpl' => 1,
  ),
),false)) {
function content_63f8cc640a8006_43266236 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container my-0">
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1">
            <?php $_smarty_tpl->_subTemplateRender('file:menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
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
                    <?php $_smarty_tpl->_assignInScope('hrefStart', "/category/");?>
                    <?php $_smarty_tpl->_assignInScope('hrefCur', '');?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cats']->value, 'cat', false, NULL, 'category', array (
  'first' => true,
  'last' => true,
  'index' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['total'];
?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['first'] : null)) {?>
                            <?php $_smarty_tpl->_assignInScope('hrefCur', ((string)$_smarty_tpl->tpl_vars['hrefCur']->value).((string)$_smarty_tpl->tpl_vars['cat']->value['id']));?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->_assignInScope('hrefCur', ((string)$_smarty_tpl->tpl_vars['hrefCur']->value)."_".((string)$_smarty_tpl->tpl_vars['cat']->value['id']));?>
                        <?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_category']->value['last'] : null)) {?>
                            <li class="breadcrumb-item">
                                <a href="/products/<?php echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/1/" 
                                   class='col-nav-hover nv-hover'>
                                    <span class="col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</span>
                                </a>
                            </li>
                        <?php } else { ?>    
                            <li class="breadcrumb-item">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['hrefStart']->value;
echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/" 
                                   class='col-nav-hover nv-hover'>
                                    <span class="col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</span>
                                </a>
                            </li>
                        <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>

                    </li>
                </ol>
            </nav>
            <h3 class="heading col-nav ms-2 d-flex">
            <a data-bs-toggle="collapse" href="#descrProd" aria-expanded="true" 
            aria-controls="descrProd" role="button"
            class='nv-a nv-a2 col-nav-hover nv-hover'
            >
                <h3 class="pe-2 mb-0"><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h3>                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>    
            </h3>
            <div class="row me-0">
                                <div class="col-12 col-lg-6">
                <a role="button" data-bs-toggle="modal" data-bs-target="#imageModal" >
                    <img src="/images/product/md/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
" 
                        class="float-start imgshadow img-fluid mx-2 my-2">
                                    </a> 
                
                    
<!-- Модальное окно -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header  px-1 py-1 px-sm-2 py-sm-2 px-md-3 py-md-3">
        <h5 class="modal-title heading col-nav " id="exampleModalLabel"><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h5>
        <button type="button" class="btn-close nv-a3" 
                data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body px-1 py-1 px-sm-2 py-sm-2 px-md-3 py-md-3">
      <img src="/images/product/lg/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
" 
         class="img-fluid">
      </div>
          </div>
  </div>
</div>



                </div>  
                <div class="col-12 col-lg-6"> 
                    <p class="col-nav ms-1">  
                            Артикул <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['article'];?>
 <br/>
                            Дата доставки <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['date_available'];?>
 <br/>
                            Цена <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['rsProduct']->value['price']);?>
 <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['currency'];?>
 <br/>
                            Остаток  
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16"
                                <?php if ($_smarty_tpl->tpl_vars['rsProduct']->value['quantity'] > 30) {?>
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Достаточное количество"
                                    data-bs-custom-class="custom-tooltip">
                                    <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                <?php } elseif ($_smarty_tpl->tpl_vars['rsProduct']->value['quantity'] > 10) {?> 
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
                                <?php } elseif ($_smarty_tpl->tpl_vars['rsProduct']->value['quantity'] > 1) {?>
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
                                <?php } elseif ($_smarty_tpl->tpl_vars['rsProduct']->value['quantity'] > 0) {?>
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Мало"
                                        data-bs-custom-class="custom-tooltip"> 
                                        <path d= "M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2zm3 3a1 0-2zm0-3a1 0-2z"/>
                                  
                                <?php } else { ?>   
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
                                <?php }?>
                            </svg>
                            <br/>
                    </p>
                    
                    <div class="d-flex flex-row ">
                    <a id="addwishlist_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
" href="#" 
                        onClick='addToBookmark(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
/",0);return false; '; 
                        alt='Удалить из закладок' 
                        class="me-1 me-sm-2 me-lg-3 me-xl-4  ms-1 nav-link <?php if (!$_smarty_tpl->tpl_vars['rsProduct']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Удалить из закладок" data-bs-custom-class="custom-tooltip"
                            class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </a>
                    <a id="removewishlist_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
" href="#" 
                        onClick='addToBookmark(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
/",1);return false; ';
                        alt='Добавить в закладки' 
                        class="me-1 me-sm-2  me-lg-3 me-xl-4  ms-1 nav-link <?php if ($_smarty_tpl->tpl_vars['rsProduct']->value['bookmarks']) {?> hideme"<?php } else { ?>"<?php }?> >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Добавить в закладки" data-bs-custom-class="custom-tooltip"
                            class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    </a>

                    <a id="addcart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
" href="#"
                        onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
/",0);document.location.reload();';
                        return false; alt='Добавить в корзину' 
                        class="me-1  mb-1 nav-link <?php if (!$_smarty_tpl->tpl_vars['rsProduct']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                        </svg>
                    </a>
                    <a id="removecart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
" href="#"
                        onClick='addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
,"/product/<?php echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['productId'];?>
/",1);document.location.reload();';
                        return false; alt='Добавить в корзину' 
                        class="me-1  mb-1 nav-link <?php if ($_smarty_tpl->tpl_vars['rsProduct']->value['inCart']) {?> hideme" <?php } else { ?>"<?php }?>>
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
            <p><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['description'];?>
</p>
                        </div>             
        </div>
        </div>
    </div>
</div><?php }
}
