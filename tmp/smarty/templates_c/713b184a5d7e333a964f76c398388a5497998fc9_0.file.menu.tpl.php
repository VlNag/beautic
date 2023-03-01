<?php
/* Smarty version 4.2.1, created on 2023-02-20 08:38:34
  from 'D:\xampp\htdocs\beautic.local\views\default\menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f3237a217b69_05197738',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '713b184a5d7e333a964f76c398388a5497998fc9' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\menu.tpl',
      1 => 1676878704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f3237a217b69_05197738 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container-fluid me-md-1 " id="leftMenu">
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
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['children']) {?>
                            <li class="nav-item dropend d-none d-md-block">
                                <a class="nav-link dropdown-toggle nv-hover col-nav" 
                                   href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['categoryId'];?>
/" 
                                   id="navbarScrollingDropdown"
                                   role="button" data-bs-toggle="dropdown" 
                                   aria-expanded="false">
                                   <span class="col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</span>
                                </a>
                                <ul class="dropdown-menu bg-nav-opposite" 
                                    aria-labelledby="navbarScrollingDropdown">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['children'], 'itemChild');
$_smarty_tpl->tpl_vars['itemChild']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
$_smarty_tpl->tpl_vars['itemChild']->do_else = false;
?>
                                        <li class="nv-hover">
                                            <a class="dropdown-item nv-hover" 
                                               <?php if ($_smarty_tpl->tpl_vars['itemChild']->value['last']) {?>                                           
                                               href=
                                               "/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['categoryId'];?>
_<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['categoryId'];?>
/1/">
                                               <?php } else { ?>
                                                href=
                                                "/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['categoryId'];?>
_<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['categoryId'];?>
/">
                                                <?php }?>
                                               <span class="col-nav-opposite nv-hover">
                                                   <?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>

                                               </span>  
                                            </a>
                                        </li>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <li><hr class="dropdown-divider"></li> 
                                    <li>
                                        <a class="dropdown-item  nv-hover col-nav-opposite" 
                                           href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['categoryId'];?>
/">
                                           Все из категории <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                    <div class="collapse  w-100 " id="submenu">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item1');
$_smarty_tpl->tpl_vars['item1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item1']->value) {
$_smarty_tpl->tpl_vars['item1']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['item1']->value['children']) {?>
                                <li class="d-md-none w-100 ">
                                    <a href=
                                    "#submenu<?php echo $_smarty_tpl->tpl_vars['item1']->value['categoryId'];?>
" data-bs-toggle="collapse" 
                                        class="nav-link px-0  nv-hover col-nav d-flex 
                                        justify-content-center">
                                        <!-- <i class="fs-4 bi-speedometer2"></i> -->
                                        <span class="ms-1  col-nav nv-hover ">
                                            <?php echo $_smarty_tpl->tpl_vars['item1']->value['name'];?>

                                        </span>
                                    </a>
                                    <ul class="collapse nav flex-column" 
                                        id="submenu<?php echo $_smarty_tpl->tpl_vars['item1']->value['categoryId'];?>
"
                                        data-bs-parent="#submenu">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item1']->value['children'], 'itemChild1');
$_smarty_tpl->tpl_vars['itemChild1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemChild1']->value) {
$_smarty_tpl->tpl_vars['itemChild1']->do_else = false;
?>
                                            <li class="w-100 bg-nav-opposite nv-hover" id="nv-li">
                                                                                                <a class="nav-link align-middle nv-hover 
                                                          d-flex justify-content-center"
                                                <?php if ($_smarty_tpl->tpl_vars['itemChild1']->value['last']) {?>           
                                                href=
                                                    "/products/<?php echo $_smarty_tpl->tpl_vars['item1']->value['categoryId'];?>
_<?php echo $_smarty_tpl->tpl_vars['itemChild1']->value['categoryId'];?>
/1/"> 
                                                <?php } else { ?>
                                                href=
                                                    "/category/<?php echo $_smarty_tpl->tpl_vars['item1']->value['categoryId'];?>
_<?php echo $_smarty_tpl->tpl_vars['itemChild1']->value['categoryId'];?>
/"> 
                                                 <?php }?>   
                                                <span class=" nv-hover col-nav-opposite">
                                                    <?php echo $_smarty_tpl->tpl_vars['itemChild1']->value['name'];?>

                                                </span>
                                                </a>
                                            </li>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </ul>
                                </li>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
 <?php }
}
