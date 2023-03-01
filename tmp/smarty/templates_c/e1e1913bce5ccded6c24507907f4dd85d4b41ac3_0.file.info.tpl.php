<?php
/* Smarty version 4.2.1, created on 2023-02-21 07:05:07
  from 'D:\xampp\htdocs\beautic.local\views\default\info.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f45f13d1eea4_58102817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1e1913bce5ccded6c24507907f4dd85d4b41ac3' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\info.tpl',
      1 => 1676909376,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f45f13d1eea4_58102817 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                         fill="currentColor"  class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
               <?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>

            </li>
        </ol>
    </nav>

    <div class="row ms-0 ms-md-2 me-0">
        <p><?php echo $_smarty_tpl->tpl_vars['articleInfo']->value;?>
</p>
    </div>
</div> <?php }
}
