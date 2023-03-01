<?php
/* Smarty version 4.2.1, created on 2023-01-21 06:25:34
  from 'D:\xampp\htdocs\beautic.local\views\default\forgotpass.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63cb774e7e1640_79496823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85b376918cdff9e448724f52bcc8e12fe1d9929b' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\forgotpass.tpl',
      1 => 1674234681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:userlink.tpl' => 1,
  ),
),false)) {
function content_63cb774e7e1640_79496823 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="/user/" class='col-nav-hover nv-hover'>
                    Личный кабинет
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>

            </li>
        </ol>
    </nav>

    <h3 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
        <span class="pe-2"><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</span>
        <div class=" flex-fill me-2" id="vn-line"> </div>
    </h3>
    <div class="row ">
    <div class="col-lg-6 col-md-8 col-sm-12">
    <p class="ms-2">
        Введите адрес электронной почты Вашей учетной записи. Нажмите кнопку отправить, чтобы получить ссылку для обновления пароля по электронной почте.
    </p> 

    <form method="post" class="me-2" action="/restuser/forgotpass/">
        <div class="input-group  ms-1 mb-3">
            <span class="input-group-text d-none d-sm-block">E-Mail адрес</span>
            <input type="email" class="form-control" placeholder="E-Mail адрес" 
                aria-label="E-Mail адрес" aria-describedby="button-addon2" name="email" required>
            <button class="btn bg-nav-btn col-nav nv-navbar" type="submit" 
                id="button-addon2">
                Отправить
            </button>
        </div>
    </form>

    <p class="ms-2">
    Если вы не указывали или забыли адрес электронной почты, оставьте Ваши контактные данные и опишите проблему, с Вами свяжутся наши операторы.   
    </p> 
    <form method="post"  class="me-2"action="/restuser/forgotpass/">
        <div class="input-group ms-1 mb-1">
            <span class="input-group-text">Сообщение</span>
            <textarea class="form-control" aria-label="Сообщение" name="message" required></textarea>
            <button class="btn bg-nav-btn col-nav nv-navbar" type="submit" 
                id="button-addon3">
                Отправить
            </button>
        </div>
    </form>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-0">
        <div class="row ms-0 ms-md-2 me-0 d-none d-md-block">
            <?php $_smarty_tpl->_subTemplateRender('file:userlink.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
    </div>
</div>

</div><?php }
}
