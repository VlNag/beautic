<?php
/* Smarty version 4.2.1, created on 2022-12-08 07:50:56
  from 'D:\xampp\htdocs\beautic.local\views\default\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63918950516307_22450646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ded3ae0391da5297474811e5963c01c07a24c7e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\main.tpl',
      1 => 1670482253,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.tpl' => 1,
    'file:info.tpl' => 1,
  ),
),false)) {
function content_63918950516307_22450646 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container my-0">
    <div class="row flex-md-nowrap">
        <div class="col-lg-3 col-md-4 col-sm-12 px-0 me-1 mb-1 ">
            <?php $_smarty_tpl->_subTemplateRender('file:menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 pe-0 pe-md-1 ps-0 mb-1 ">

                  <?php $_smarty_tpl->_subTemplateRender('file:info.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </div>
    </div>
</div><?php }
}
