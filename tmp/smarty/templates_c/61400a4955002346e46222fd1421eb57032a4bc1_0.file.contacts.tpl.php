<?php
/* Smarty version 4.2.1, created on 2023-02-27 08:39:43
  from 'D:\xampp\htdocs\beautic.local\views\default\contacts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63fc5e3fd860e7_43036881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61400a4955002346e46222fd1421eb57032a4bc1' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\contacts.tpl',
      1 => 1677258952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63fc5e3fd860e7_43036881 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                        fill="currentColor" viewBox="0 0 16 16"
                        class="bi bi-house-door col-nav nv-hover">
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

    <div class="row mx-0 mx-sm-1 ">
        <div class="col-12 col-lg-5 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#emailShow" aria-expanded="true" 
                    aria-controls="emailShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        E-mail
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>
            <div class="collapse show" id="emailShow"> 
                <?php if ($_smarty_tpl->tpl_vars['email']->value) {?> 
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['email']->value, 'mail', false, NULL, 'email', array (
  'index' => true,
  'total' => true,
  'last' => true,
  'first' => true,
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['mail']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['mail']->value) {
$_smarty_tpl->tpl_vars['mail']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total'];
?>
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" 
                            id="email<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
">

                            <input type="email" class="form-control col-12 col-sm-4 border border-col rounded" 
                                placeholder="E-Mail адрес" aria-label="E-Mail адрес" 
                                aria-describedby="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="E-mail" data-bs-custom-class="custom-tooltip"
                                id="emailContact<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mail']->value['content']);?>
">
                            <span class="input-group-text col-12 col-sm-1 d-block d-sm-none py-0" 
                                id="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" >
                            </span>
                            <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent" 
                                placeholder="Комментарий" aria-label="Комментарий" 
                                aria-describedby="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                id="commentEmail<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mail']->value['comment']);?>
">
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total'] : null) > 1) {?>
                                <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['last'] : null)) {?>   
                                    <button type="" id="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0" 
                                        onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
, 0, "email")'>                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                        </svg>
                                    </button>
                                <?php } else { ?>
                                    <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                <?php }?>
                                <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['first'] : null)) {?>
                                    <button type="" id="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0" 
                                        onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
, 1, "email")'>                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                        </svg>
                                    </button>
                                <?php } else { ?>
                                    <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                <?php }?>    
                            <?php } else { ?>                                                             <?php }?>    
                            <button type="" id="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
"
                                class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0" 
                                onclick='removeContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
, "email")'>                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php $_smarty_tpl->_assignInScope('emailLast', ((string)(isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total'] : null)));?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('emailLast', "0");?>
                <?php }?>
                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" 
                    id="email<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
" name="emailAdd" > 
                    <input type="email" class="form-control col-12 col-sm-4 border border-col rounded placeholder-transparent" 
                        placeholder="E-Mail адрес" aria-label="E-Mail адрес" 
                        aria-describedby="button-addon<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="E-mail" data-bs-custom-class="custom-tooltip"
                        id="emailContact<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
" value="">
                    <span class="input-group-text col-12 col-sm-1 d-block d-sm-none py-0" 
                        id="button-addon<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['index'] : null);?>
" >
                    </span>
                    <input type="text" class="form-control col-9 col-sm-4 border border-col rounded placeholder-transparent" 
                        placeholder="Комментарий" aria-label="Комментарий" 
                        aria-describedby="button-addon<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                        id="commentEmail<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
" value="">
                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_email']->value['total'] : null) > 1) {?>
                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                        <?php }?>
                        <button type="" id="button-addon<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
"
                            class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                            onclick='removeContact(<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
, "email", 1)'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </button> 
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addEmail" > 
                    <button type=""  
                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact(<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
, "email")'>                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                     
                    <span class="input-group-text  rounded" id="basic-addon1">Добавить<span class=" d-none d-sm-block">&#160;E-mail</span></span>
                </div>
                            </div>     
        </div>

        <div class="col-12 col-lg-7 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#phoneShow" aria-expanded="true" aria-controls="phoneShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        Телефоны
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>

            <div class="collapse show" id="phoneShow">
                <?php if ($_smarty_tpl->tpl_vars['phone']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone']->value, 'phon', false, NULL, 'phone', array (
  'index' => true,
  'total' => true,
  'last' => true,
  'first' => true,
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['phon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['phon']->value) {
$_smarty_tpl->tpl_vars['phon']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'];
?>
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="phone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
">
                            <div class="col-9 col-sm-4">
                                <input type="tel" class="form-control col-12 col-sm-4 border border-col rounded"
                                    placeholder="Телефон" aria-label="Телефон"
                                    aria-describedby="ariaPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Телефон" data-bs-custom-class="custom-tooltip"
                                    id="phoneContact<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
" value="<?php echo $_smarty_tpl->tpl_vars['phon']->value['content'];?>
">
                            </div>        
                            <div class="col-3 col-sm-2">
                                <select class="form-select border border-col rounded" 
                                        id="kindPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" data-bs-title="Вид телефона" 
                                        data-bs-custom-class="custom-tooltip">
                                    <option selected disabled>Выберите</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['typeContacts']->value, 'typeContact');
$_smarty_tpl->tpl_vars['typeContact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['typeContact']->value) {
$_smarty_tpl->tpl_vars['typeContact']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['option'] != 2) {?>
                                            <option value=<?php echo $_smarty_tpl->tpl_vars['typeContact']->value['value'];?>
 
                                                <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['value'] == $_smarty_tpl->tpl_vars['phon']->value['view_contact']) {?>selected<?php }?>>
                                                <?php echo $_smarty_tpl->tpl_vars['typeContact']->value['name'];?>

                                            </option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                                </select>
                            </div>    
                            <div class=" col-12 col-sm-6 ">
                                <div class="row mx-0 flex-nowrap">
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'] : null) > 1) {?>
                                    <div class="col-11 col-sm-9 px-0">
                                    <?php } else { ?>
                                    <div class="col-11  px-0">   
                                    <?php }?>
                                        <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent"
                                            placeholder="Комментарий" aria-label="Комментарий"
                                            aria-describedby="ariaPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                            id="commentPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['phon']->value['comment']);?>
">
                                    </div> 
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'] : null) > 1) {?>
                                        <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['last'] : null)) {?>
                                            <button type="" id="ariaPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
, 0, "phone")'>                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                                </svg>
                                            </button>
                                        <?php } else { ?>
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        <?php }?>
                                        <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['first'] : null)) {?>
                                            <button type="" id="ariaPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
, 1, "phone")'>                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                                </svg>
                                            </button>
                                        <?php } else { ?>
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        <?php }?>
                                    <?php }?>
                                    <button type="" id="ariaPhone<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                                        onclick='removeContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['index'] : null);?>
, "phone")'>                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php $_smarty_tpl->_assignInScope('phoneLast', ((string)(isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'] : null)));?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('phoneLast', "0");?>
                <?php }?>

                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="phone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
" name="phoneAdd">
                    <div class="col-9 col-sm-4">
                        <input type="tel" class="form-control border border-col rounded px-lg-1  px-xl-2 placeholder-transparent"
                               placeholder="Телефон" aria-label="E-Mail адрес" aria-describedby="ariaPhone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
"
                               data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Телефон"
                               data-bs-custom-class="custom-tooltip" id="phoneContact<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
" value="">
                    </div>
                    <div class="col-3 col-sm-2">
                        <select class="form-select border border-col rounded" 
                                id="kindPhone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Вид телефона" data-bs-custom-class="custom-tooltip">
                                <option selected disabled>Выберите</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['typeContacts']->value, 'typeContact');
$_smarty_tpl->tpl_vars['typeContact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['typeContact']->value) {
$_smarty_tpl->tpl_vars['typeContact']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['option'] != 2) {?>
                                    <option value=<?php echo $_smarty_tpl->tpl_vars['typeContact']->value['value'];?>
><?php echo $_smarty_tpl->tpl_vars['typeContact']->value['name'];?>
</option>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>    
                        </select>
                    </div>
                    <div class=" col-12 col-sm-6 ">

                        <div class="row mx-0 flex-nowrap">
                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'] : null) > 1) {?>
                        <div class="col-11 col-sm-9 px-0">
                        <?php } else { ?>
                            <div class="col-11  px-0">   
                        <?php }?>
                            <input type="text" class="form-control border border-col rounded  placeholder-transparent"
                                placeholder="Комментарий" aria-label="Комментарий" aria-describedby="ariaPhone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Комментарий"
                                data-bs-custom-class="custom-tooltip" id="commentPhone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
" value="">
                        </div>        
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_phone']->value['total'] : null) > 1) {?>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                            <?php }?>
                             
                            <button type="" id="ariaPhone<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
"
                                class="btn bg-nav-btn col-nav nv-navbar border col-1 border-col rounded px-0"
                                onclick='removeContact(<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
, "phone", 1)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                                                    </div>
                    </div>
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addPhone">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact(<?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
, "phone")'>                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </button>
                                        <span class="input-group-text rounded" id="basic-addon1">
                        Добавить <span class=" d-none d-sm-block">&#160;телефон</span>
                    </span>
                </div>
                            </div>

        </div>
    </div>  

    <div class="row mx-0 mx-sm-1">
        <div class="col-12 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#addressShow" aria-expanded="true" aria-controls="addressShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        Адреса
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>

            <div class="collapse show" id="addressShow" name="addressShow">
                <?php if ($_smarty_tpl->tpl_vars['address']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['address']->value, 'addr', false, NULL, 'address', array (
  'index' => true,
  'total' => true,
  'last' => true,
  'first' => true,
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['addr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['addr']->value) {
$_smarty_tpl->tpl_vars['addr']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'];
?>
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="address<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
">
                            <div class="col-12 col-lg-5">
                                 



                                <textarea class="form-control col-12 col-sm-4 border border-col rounded" aria-label="Адрес" rows="1"
                                    aria-describedby="ariaAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Адрес" data-bs-custom-class="custom-tooltip"
                                    id="addressContact<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
"><?php echo $_smarty_tpl->tpl_vars['addr']->value['content'];?>
</textarea>

                            </div>        
                            <div class="col-3 col-lg-2">
                                <select class="form-select border border-col rounded" 
                                        id="kindAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" data-bs-title="Вид адреса" 
                                        data-bs-custom-class="custom-tooltip">
                                    <option selected disabled>Выберите</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['typeContacts']->value, 'typeContact');
$_smarty_tpl->tpl_vars['typeContact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['typeContact']->value) {
$_smarty_tpl->tpl_vars['typeContact']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['option'] != 1) {?>
                                            <option value=<?php echo $_smarty_tpl->tpl_vars['typeContact']->value['value'];?>
 
                                                <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['value'] == $_smarty_tpl->tpl_vars['addr']->value['view_contact']) {?>selected<?php }?>>
                                                <?php echo $_smarty_tpl->tpl_vars['typeContact']->value['name'];?>

                                            </option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                                </select>
                            </div>    
                            <div class="col-9 col-lg-5">
                                <div class="row mx-0 flex-nowrap">
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'] : null) > 1) {?>
                                    <div class="col-11 col-sm-9 px-0">
                                    <?php } else { ?>
                                    <div class="col-11  px-0">   
                                    <?php }?>
                                        <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent"
                                            placeholder="Комментарий" aria-label="Комментарий"
                                            aria-describedby="ariaAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                            id="commentAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['addr']->value['comment']);?>
">
                                    </div> 
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'] : null) > 1) {?>
                                        <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['last'] : null)) {?>
                                            <button type="" id="ariaAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
, 0, "address")'>                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                                </svg>
                                            </button>
                                        <?php } else { ?>
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        <?php }?>
                                        <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['first'] : null)) {?>
                                            <button type="" id="ariaAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
, 1, "address")'>                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                                </svg>
                                            </button>
                                        <?php } else { ?>
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        <?php }?>
                                    <?php }?>
                                    <button type="" id="ariaAddress<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                                        onclick='removeContact(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['index'] : null);?>
, "address")'>                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php $_smarty_tpl->_assignInScope('addressLast', ((string)(isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'] : null)));?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('addressLast', "0");?>
                <?php }?>

                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="address<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
" name="addressAdd">
                    <div class="col-12 col-lg-5">
                        <input type="tel" class="form-control border border-col rounded px-lg-1  px-xl-2 placeholder-transparent"
                               placeholder="Адрес" aria-label="Адрес" aria-describedby="ariaAddress<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
"
                               data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Адрес"
                               data-bs-custom-class="custom-tooltip" id="addressContact<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
" value="">
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select border border-col rounded" 
                                id="kindAddress<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Вид адреса" data-bs-custom-class="custom-tooltip">
                                <option selected disabled>Выберите</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['typeContacts']->value, 'typeContact');
$_smarty_tpl->tpl_vars['typeContact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['typeContact']->value) {
$_smarty_tpl->tpl_vars['typeContact']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['typeContact']->value['option'] != 1) {?>
                                    <option value=<?php echo $_smarty_tpl->tpl_vars['typeContact']->value['value'];?>
><?php echo $_smarty_tpl->tpl_vars['typeContact']->value['name'];?>
</option>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>    
                        </select>
                    </div>
                    <div class="col-9 col-lg-5">

                        <div class="row mx-0 flex-nowrap">
                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'] : null) > 1) {?>
                        <div class="col-11 col-sm-9 px-0">
                        <?php } else { ?>
                            <div class="col-11  px-0">   
                        <?php }?>
                            <input type="text" class="form-control border border-col rounded  placeholder-transparent"
                                placeholder="Комментарий" aria-label="Комментарий" aria-describedby="ariaAddress<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Комментарий"
                                data-bs-custom-class="custom-tooltip" id="commentAddress<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
" value="">
                        </div>        
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_address']->value['total'] : null) > 1) {?>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                            <?php }?>
                             
                            <button type="" id="ariaAddress<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
"
                                class="btn bg-nav-btn col-nav nv-navbar border col-1 border-col rounded px-0"
                                onclick='removeContact(<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
, "address", 1)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                                                    </div>
                    </div>
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addAddress">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact(<?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
, "address")'>                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </button>
                                        <span class="input-group-text rounded" id="basic-addon1">
                        Добавить <span class=" d-none d-sm-block">&#160;адрес</span>
                    </span>
                </div>
                            </div>
        </div>
    </div>   
    <div class=" d-flex justify-content-center">
    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-6 col-lg-6 mb-1"
        onclick='saveContacts(<?php echo $_smarty_tpl->tpl_vars['emailLast']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['phoneLast']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['addressLast']->value;?>
);document.location.reload();'> 
        Сохранить
    </button>
</div>
</div><?php }
}
