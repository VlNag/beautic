<?php
/* Smarty version 4.2.1, created on 2023-02-24 07:29:10
  from 'D:\xampp\htdocs\beautic.local\views\default\category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f859364c8bc5_53896600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35b3d714d489979c8da6e4e1fc32820ff6e9f195' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\category.tpl',
      1 => 1677220145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.tpl' => 1,
    'file:categoryhead.tpl' => 1,
  ),
),false)) {
function content_63f859364c8bc5_53896600 (Smarty_Internal_Template $_smarty_tpl) {
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
                <?php if ($_smarty_tpl->tpl_vars['rsCategoriesChildren']->value) {?>
                                        <div class="row row-cols-2 row-cols-sm-3   row-cols-lg-5 g-4 mx-0">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategoriesChildren']->value, 'itemCat', false, NULL, 'catCildren', array (
));
$_smarty_tpl->tpl_vars['itemCat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemCat']->value) {
$_smarty_tpl->tpl_vars['itemCat']->do_else = false;
?>
                            <div class="col">
                                <div class="card h-100 bg-nav-btn">
                                <?php if ($_smarty_tpl->tpl_vars['itemCat']->value['last']) {?>
                                <a href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['categoryId'];?>
/1/">
                                    <img src="/images/category/<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['image'];?>
" 
                                         class="card-img-top" alt="category">
                                                                         </a> 
                                <?php } else { ?>
                                    <a href="/category/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['categoryId'];?>
/">
                                    <img src="/images/category/<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['image'];?>
" 
                                         class="card-img-top" alt="category">
                                </a>    
                                <?php }?>    
                                                                            <div class="card-footer text-muted  h-100  w-100
                                                mx-auto my-0 bg-nav-btn-hover">
                                        <?php if ($_smarty_tpl->tpl_vars['itemCat']->value['last']) {?>
                                            <a href="/products/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['categoryId'];?>
/1/"
                                                class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100 w-100"><?php echo $_smarty_tpl->tpl_vars['itemCat']->value['name'];?>

                                            </a>
                                        <?php } else { ?>
                                            <a href="/category/<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['categoryId'];?>
/"
                                                class="btn mt-auto bg-nav-opposite col-nav-opposite nv-hover h-100 w-100"><?php echo $_smarty_tpl->tpl_vars['itemCat']->value['name'];?>

                                            </a>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                <?php }?>
            </div>
        </div> 
    </div>
</div><?php }
}
