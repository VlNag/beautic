<?php
/* Smarty version 4.2.1, created on 2022-12-09 16:18:08
  from 'D:\xampp\htdocs\beautic.local\views\default\categoryhead.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_639351b06dab65_93346853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc9876204936da0a6fe11dc390cc6af7002b6315' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\categoryhead.tpl',
      1 => 1670599075,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639351b06dab65_93346853 (Smarty_Internal_Template $_smarty_tpl) {
?><nav aria-label="breadcrumb" class="ms-2">
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
                <li class="breadcrumb-item active" aria-current="page"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</li>
            <?php } else { ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['hrefStart']->value;
echo $_smarty_tpl->tpl_vars['hrefCur']->value;?>
/" class='col-nav-hover nv-hover'>
                        <span class="col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</span>
                    </a>
                </li>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ol>
</nav>

<h3 class="heading col-nav ms-2 d-flex">
    <span class="pe-2"><?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['name'];?>
</span>
    <div class=" flex-fill me-2" id="vn-line"> </div>    
</h3>

<div class="row me-0">
    <div>
    <a data-bs-toggle="collapse" href="#descrCat" aria-expanded="true" 
       aria-controls="descrCat" role="button" >
        <img src="/images/category/<?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['image'];?>
" 
             class="float-start imgshadow img-fluid mx-1 mx-md-2 my-1 my-md-2">
                </a>

    <div class="collapse show" id="descrCat">
        <p><?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['description'];?>
</p>
    </div>    
            </div> 
</div>
<hr class="nv-hr">
<?php }
}
