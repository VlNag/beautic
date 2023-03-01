<?php
/* Smarty version 4.2.1, created on 2023-02-22 18:05:59
  from 'D:\xampp\htdocs\beautic.local\views\default\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f64b778ebf06_40112919',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec1be9f81d070462e2d725b06a3f861ccdffb42b' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beautic.local\\views\\default\\header.tpl',
      1 => 1677085543,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f64b778ebf06_40112919 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
images/logo.ico" type="imaje/x-icon">

    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>

    <link href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/fontello.css" rel="stylesheet">

    <?php if ($_smarty_tpl->tpl_vars['theme']->value == 'light') {?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/main.css" rel="stylesheet" type="text/css">
    <?php } else { ?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/maindark.css" rel="stylesheet" type="text/css">
    <?php }?>
    <?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-3.6.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="/js/main.js"><?php echo '</script'; ?>
>
</head>

<body >
    <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?>
        <!-- Modal3-->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-bs-labelledby="exampleModalLabel3" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title" id="exampleModalLabel"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
                        <button class="btn-close" data-bs-dismiss="modal" aria-bs-label="close">
                        </button>
                    </div>
                         
                </div>
            </div>
        </div>
        </div>
        <!-- /Modal3-->
    <?php }?>   

    <!--<div class="container"  id="header">fixed-top class="d-md-flex flex-md-columnm in-vh-100" -->
    <nav class="navbar navbar-expand-sm  nv-navbar bg-nav">
        <!--<nav class="navbar  navbar-expand-md navbar-dark bg-dark">
           fixed-top -->
        <div class="container">
            <img src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
images/logo_dark.png" alt="logo" 
                 class="me-1 mb-sm-1 img-fluid" width="30">
            <a href="/" class="navbar-brand nv-hover mb-sm-2 col-nav">BEAUTIC</a> 
            <button class="navbar-toggler bg-nav-btn col-nav-btn-brd" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="true">
                <span class="navbar-toggler-icon nv-navbar bg-nav-btn"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                        <!--
                            <li class="nav-item">
                                <a href="/" class="nav-link">Главная</a>
                            </li> 
                        -->
                    <li class="nav-item">
                        <a href="/faq/" class="nav-link">
                        <div class='d-inline-flex nv-hover'>
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 width="16" height="16" fill="currentColor"
                                 data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Вопросы и ответы" data-bs-custom-class="custom-tooltip"
                                 class="bi bi-question-circle me-1 my-auto nv-hover head-svg" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            <span class='col-nav d-block d-sm-none d-lg-block nv-hover'>
                                Вопросы и ответы
                            </span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/delivery/" class="nav-link">
                            <div class='d-inline-flex nv-hover'>
                                 <svg  width="16" height="16" viewBox="0 0 48 48" 
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Доставка и оплата" data-bs-custom-class="custom-tooltip"
                                    fill="currentColor" class="bi bi-person my-auto me-1 nv-hover head-svg" 
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="Shipped">
                                            <path d="m37.59 32.56a3 3 0 1 0 2.35 2.35 3 3 0 0 0 -2.35-2.35zm-.59 3.94a1 1 0 1 1 1-1 1 1 0 0 1 -1 1z"></path>
                                            <path d="m13.59 32.56a3 3 0 1 0 2.35 2.35 3 3 0 0 0 -2.35-2.35zm-.59 3.94a1 1 0 1 1 1-1 1 1 0 0 1 -1 1z"></path>
                                            <path d="m44.68 17.59a4 4 0 0 1 -3.34-1.68l-2.04-2.91a6 6 0 0 0 -5-2.54h-6.3a5 5 0 0 0 -5-5h-18a5 5 0 0 0 -5 5v23a1.48 1.48 0 0 0 0 .32 5 5 0 0 0 5 4.72h1.68a7 7 0 0 0 12.64 0h11.36a7 7 0 0 0 12.64 0h3.68a1 1 0 0 0 1-1v-16.71a3.27 3.27 0 0 0 -3.32-3.2zm-39.68 18.91a3 3 0 0 1 -2.78-1.87h3.83a7.79 7.79 0 0 0 0 1.87zm12.79.34a5 5 0 0 1 -9.58 0c-1.93-8.23 11.51-8.22 9.58 0zm-11.17-4.21h-4.62v-22.13a3 3 0 0 1 3-3h18a3 3 0 0 1 3 3v22.13h-6.62c-2.23-5.41-10.53-5.41-12.76 0zm13.31 3.87a7.79 7.79 0 0 0 0-1.87h10.1a7.79 7.79 0 0 0 0 1.87zm21.86.34a5 5 0 0 1 -9.58 0c-1.93-8.23 11.51-8.22 9.58 0zm4.21-.34h-2.07a7.79 7.79 0 0 0 0-1.87h2zm0-3.87h-2.62c-2.23-5.41-10.53-5.41-12.76 0h-2.62v-20.13h6.32a4 4 0 0 1 3.34 1.69l2 2.87a6 6 0 0 0 5 2.53 1.27 1.27 0 0 1 1.34 1.2z"></path><path d="m37.36 21.5h-.5a4.85 4.85 0 0 1 -4.86-4.86v-1.14a1 1 0 0 0 -2 0v1.14a6.86 6.86 0 0 0 6.86 6.86h.5a1 1 0 0 0 0-2z"></path>
                                            <path d="m20.29 14.06-7.88 7.88-4.7-4.7a1 1 0 0 0 -1.42 0 1 1 0 0 0 0 1.41l5.42 5.42a1 1 0 0 0 .7.29 1 1 0 0 0 .71-.29l8.59-8.59a1 1 0 1 0 -1.42-1.42z"></path>
                                    </g>
                                </svg>
                                <span class='nv-hover col-nav d-block d-sm-none d-lg-block'>
                                    Доставка и оплата
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?> 
                        <button class="btn bg-nav-btn col-nav me-2  
                            mb-sm-0 mb-1 nv-navbar tool"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Личный кабинет: <?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
"
                            data-bs-custom-class="custom-tooltip"
                            onclick="window.location.href = '/user/';"> 
                    <?php } else { ?>
                        <button class="btn bg-nav-btn col-nav me-2  
                            mb-sm-0 mb-1 nv-navbar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?php }?>
                        <div class='d-inline-flex nv-hover' id='account'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                            <?php if (!(isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Личный кабинет"
                                data-bs-custom-class="custom-tooltip"
                            <?php }?>    
                                 fill="currentColor" class="bi bi-person my-auto nv-hover" 
                                 viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class='col-nav d-block d-sm-none d-md-block nv-hover' id='account-name'>
                                <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['arUser']->value['showName'] == 3) {?>
                                        <span class='d-block d-sm-none'>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['arUser']->value['showName'] == 2) {?>
                                        <span class='d-block d-sm-none d-xl-block'>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['arUser']->value['showName'] == 1) {?>
                                        <span class='d-block d-sm-none d-md-block'>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['arUser']->value['showName'] == 0) {?>
                                            <span class='d-block d-sm-block'>    
                                    <?php } else { ?>
                                        <span>
                                    <?php }?>
                                    <p class="text-break mb-0"><?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
</p> 
                                        </span>
                                            
                                <?php } else { ?>
                                    Личный кабинет
                                <?php }?>            
                            </span>
                        </div>
                        </button>
                </div>
                <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                    <div class="d-flex">
                        <button class="btn bg-nav-btn col-nav me-2  
                           mb-sm-0 mb-1 nv-navbar tool" 
                           data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Выход" data-bs-custom-class="custom-tooltip"
                           onclick="window.location.href = '/restuser/logout/';">
                            X
                        </button>
                        <button class="btn bg-nav-btn col-nav me-2   position-relative
                            mb-sm-0 mb-1 nv-navbar" 
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Закладки" data-bs-custom-class="custom-tooltip"
                            onclick="window.location.href = '/user/bookmarks/';">
                            <?php $_smarty_tpl->_assignInScope('wishlistNotNull', (isset($_smarty_tpl->tpl_vars['arUser']->value['user_wishlist'])) && !empty($_smarty_tpl->tpl_vars['arUser']->value['user_wishlist']));?>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-heart-fill <?php if (!$_smarty_tpl->tpl_vars['wishlistNotNull']->value) {?>hideme<?php }?>" viewBox="0 0 16 16" id="userWishlistFull">
                                <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light col-nav <?php if (!$_smarty_tpl->tpl_vars['wishlistNotNull']->value) {?>hideme<?php }?>" id="userWishlist">
                                <?php echo count($_smarty_tpl->tpl_vars['arUser']->value['user_wishlist']);?>

                                                            </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-heart <?php if ($_smarty_tpl->tpl_vars['wishlistNotNull']->value) {?>hideme<?php }?>" viewBox="0 0 16 16" id="userWishlistEmpty">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>


                             
                            
                        </button>
                        <button class="btn bg-nav-btn col-nav me-2  
                        mb-sm-0 mb-1 nv-navbar" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Корзина" data-bs-custom-class="custom-tooltip"
                        onclick="window.location.href = '/user/bookmarks/';">
                        <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value['user_wishlist']))) {?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['arUser']->value['user_wishlist'])) {?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                    class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                    <path 
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                </svg>
                            <?php } else { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                    class="bi bi-basket3" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                </svg>
                            <?php }?>
                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                class="bi bi-basket3" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                            </svg>
                        <?php }?>
                      </button>


                    </div>
                <?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['arUser']->value))) {?>
                 <div class="d-flex d-sm-none d-lg-block">

                    <!--<button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Личный кабинет</button>
                            <button class="btn btn-outline-danger ms-3">Sign out</button> btn-outline-success-->

                    <form action="" class="d-flex me-2">
                        <input type="search" placeholder="Найти" 
                               class="form-control me-1 nv-navbar">
                        <button class="btn bg-nav-btn col-nav nv-navbar"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                                                        
                        </button>
                    </form>    
                 </div>
                
                 <div class="d-flex d-none d-sm-block d-lg-none me-2">
                    <button class="btn bg-nav-btn col-nav nv-navbar"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                                            </button>
                 </div>
                <?php } else { ?>
                 <div class="d-flex">

                    <!--<button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Личный кабинет</button>
                            <button class="btn btn-outline-danger ms-3">Sign out</button> btn-outline-success-->

                    <form action="" class="d-flex me-2">
                        <input type="search" placeholder="Найти" 
                               class="form-control me-1 nv-navbar">
                        <button class="btn bg-nav-btn col-nav nv-navbar"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                                                        
                        </button>
                    </form>    
                 </div>


                <?php }?>   
                <div class="d-flex mt-1">

                 <div class="form-check form-switch nv-hover">
                    <?php if ($_smarty_tpl->tpl_vars['theme']->value == 'light') {?> 
                     <input class="form-check-input" type="checkbox" 
                           id="flexSwitchCheckDefault"
                           onchange="changetheme(this.checked);document.location.reload();"
                           >
                    <?php } else { ?>
                     <input class="form-check-input" type="checkbox" 
                           id="flexSwitchCheckDefault" 
                           onchange="changetheme(this.checked);document.location.reload();"
                           checked>
                    <?php }?>    
                  <label class="form-check-label col-nav nv-hover" for="flexSwitchCheckDefault">
                    light/dark
                  </label>
                 </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-bs-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-bs-label="close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/restuser/login/">
                        <div class="row mb-3">
                            <label for="inputLogin" class="col-sm-2 col-form-label">
                                Логин
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLogin" name="login" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPass" class="col-sm-2 col-form-label">
                                Пароль
                            </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPass" name="pass" required>
                            </div>
                        </div>

                        
                        <div class="row mb-3 d-flex justify-content-center">

                                                        <button type="submit" class="btn bg-nav-btn col-nav nv-navbar col-sm-11">Войти</button>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6 d-flex justify-content-center">
                                                                <button class="btn bg-nav-btn col-nav nv-navbar" type="button" onclick="window.location.href = '/user/forgotpass/';">
                                    <span class="mx-3"> Забыли пароль </span>
                                </button>   
                                                            </div>
                            <div class="col-sm-6 d-flex justify-content-center">
                                                                <button class="btn bg-nav-btn col-nav nv-navbar" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    Зарегестрироваться
                                </button>    
                                                            </div>
                        </div>


                    </form>
                </div>
            </div>
                            </div>
        </div>
    </div>
    <!-- /Modal-->

   <!-- Modal2-->
   <div class="modal fade" id="exampleModal2" tabindex="-1" aria-bs-labelledby="exampleModalLabel2" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel2">Регистрация</h5>
                   <button class="btn-close" data-bs-dismiss="modal" aria-bs-label="close">
                   </button>
               </div>
               <div class="modal-body">
                   <form method="post" action="/restuser/register/">
                       <div class="row mb-3">
                           <label for="inputLogin" class="col-sm-2 col-form-label">
                               Логин
                           </label>
                           <div class="col-sm-10">
                               <input type="text" class="form-control" id="inputLogin" name="login" required>
                           </div>
                       </div>
                       <div class="row mb-3">
                       <label for="inputPass" class="col-sm-2 col-form-label">
                           Пароль
                       </label>
                       <div class="col-sm-10">
                           <input type="password" class="form-control" id="inputPass" name="pass" required>
                       </div>
                   </div>

                       <div class="row mb-3">
                           <label for="inputEmail" class="col-sm-2 col-form-label">
                               E-mail
                           </label>
                           <div class="col-sm-10">
                               <input type="email" class="form-control" id="inputEmail" name="email">
                           </div>
                       </div>
 
                       <div class="row mb-3">
                           <label for="inputPhone" class="col-sm-2 col-form-label">
                               Телефон
                           </label>
                           <div class="col-sm-10">
                               <input type="tel" class="form-control" id="inputPhone" name="phone">
                           </div>
                       </div>                      

                       <div class="row mb-3 d-flex justify-content-center">

                                                      <button type="submit"
                               class="btn bg-nav-btn col-nav nv-navbar col-sm-11">Зарегистрироваться</button>
                       </div>

                       <div class="row mb-3 d-flex justify-content-center">

                       <button class="btn bg-nav-btn col-nav nv-navbar col-sm-11" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       Авторизироваться
                    </button> 
                       </div>

                   </form>
               </div>
           </div>
                  </div>
   </div>
   </div>
<!-- /Modal2-->

    <!--</div>-->
    <div class="container my-1">
        <div class="row nv-head ">
            <div class="col-md-8 col-sm-6 col-9">
                <h1 class="text-center col-nav d-none d-md-block">
                    beautic - интернет магазин
                </h1>
                <div class='text-center row mt-1 mt-md-0'>
                    <div class="col-md-6 col-sm-12">
                        <a class='nv-a col-nav-hover nv-hover' href="tel: <?php echo $_smarty_tpl->tpl_vars['arInfo']->value['phone'];?>
">
                            <p class="text-break col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['arInfo']->value['phone'];?>
</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class='nv-a col-nav-hover nv-hover' href="mailto: <?php echo $_smarty_tpl->tpl_vars['arInfo']->value['email'];?>
">
                            <p class="text-break col-nav nv-hover"><?php echo $_smarty_tpl->tpl_vars['arInfo']->value['email'];?>
</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-3">
                <img src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
images/logo.png" alt="logo" 
                     class="pull-left me-0 me-md-1 my-1 img-fluid">
                <!--<div class="itd-play" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <div class="idt-triangle"></div>
                        </div>
                        <a href="#footer" class="btn btn-itd btn-lg text-uppercase">Заказать</a>-->
            </div>
        </div>
    </div>

<!--   <div class="container my-2">
        <div class="row">

              [include file='leftcolumn.tpl'}  
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div id="centerColumn">  --><?php }
}
