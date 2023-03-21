<!doctype html>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{$templateWebPath}images/logo.ico" type="imaje/x-icon">

    <title>{$pageTitle}</title>

    <link href="{$templateWebPath}css/bootstrap.min.css" rel="stylesheet">
    <link href="{$templateWebPath}css/fontello.css" rel="stylesheet">

    {if $theme == 'light'}
        <link href="{$templateWebPath}css/main.css" rel="stylesheet" type="text/css">
    {else}
        <link href="{$templateWebPath}css/maindark.css" rel="stylesheet" type="text/css">
    {/if}
    <script type="text/javascript" src="/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</head>

<body {*class="d-flex flex-column h-100"*}>
    {if isset($message)}
        <!-- Modal3-->
        <div class="modal fade" id="exampleModal3" tabindex="-1" {*aria-bs-labelledby="exampleModalLabel3*}"
             aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title" id="exampleModalLabel">{$message}</span>
                        <button class="btn-close" data-bs-dismiss="modal" {*aria-bs-label="close"*}>
                        </button>
                    </div>
                        {*
                        <div class="modal-body">
                            <form method="post" action="/index/upd/">
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">
                                        Логин
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPass" class="col-sm-2 col-form-label">
                                        Пароль
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPass">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <button type="submit"
                                        class="btn bg-nav-btn col-nav nv-navbar col-sm-12">Зарегистрироваться</button>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <a href="#" class="nav-link">
                                            Забыли пароль
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" class="nav-link">
                                            Авторизироваться
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        *} 
                </div>
            </div>
        </div>
        {*</div>*}
        <!-- /Modal3-->
    {/if}   

    <!--<div class="container"  id="header">fixed-top class="d-md-flex flex-md-columnm in-vh-100" -->
    <nav class="navbar navbar-expand-sm  nv-navbar bg-nav">
        <!--<nav class="navbar  navbar-expand-md navbar-dark bg-dark">
           fixed-top -->
        <div class="container">
            <img src="{$templateWebPath}images/logo_dark.png" alt="logo" 
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
                                 data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                 data-bs-title="Вопросы и ответы" data-bs-custom-class="custom-tooltip"
                                 class="bi bi-question-circle me-1 my-auto nv-hover head-svg" 
                                 viewBox="0 0 16 16">
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
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                    data-bs-title="Доставка и оплата" data-bs-custom-class="custom-tooltip"
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
                    {if isset($arUser)} 
                        <button class="btn bg-nav-btn col-nav me-2  
                            mb-sm-0 mb-1 nv-navbar tool"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" 
                            title="Личный кабинет: {$arUser['name']}" data-bs-custom-class="custom-tooltip"
                            onclick="window.location.href = '/user/';"> 
                    {else}
                        <button class="btn bg-nav-btn col-nav me-2  
                            mb-sm-0 mb-1 nv-navbar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {/if}
                        <div class='d-inline-flex nv-hover' id='account'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                            {if !isset($arUser)}
                                data-bs-toggle="tooltip" data-bs-placement="bottom" {*title="Личный кабинет"*}
                                data-bs-custom-class="custom-tooltip"
                            {/if}    
                                 fill="currentColor" class="bi bi-person my-auto nv-hover" 
                                 viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class='col-nav d-block d-sm-none d-md-block nv-hover' id='account-name'>
                                {if isset($arUser)}
                                    {*$arUser['showName']}_{mb_strlen($arUser['name'])*}
                                    {if $arUser['showName']==3}
                                        <span class='d-block d-sm-none'>
                                    {elseif $arUser['showName']==2}
                                        <span class='d-block d-sm-none d-xl-block'>
                                    {elseif $arUser['showName']==1}
                                        <span class='d-block d-sm-none d-md-block'>
                                    {elseif $arUser['showName']==0}
                                            <span class='d-block d-sm-block'>    
                                    {else}
                                        <span>
                                    {/if}
                                    <p class="text-break mb-0">{$arUser['name']}</p> 
                                        </span>
                                    {*{if (!isset($arUser['user_name'])) || ($arUser['user_name'] == '')} 
                                        {$arUser['login']} 
                                    {else}
                                        {$arUser['user_name']}
                                    {{/if}}*}        
                                {else}
                                    Личный кабинет
                                {/if}            
                            </span>
                        </div>
                        </button>
                </div>
                {if isset($arUser)}
                    <div class="d-flex">
                        <button class="btn bg-nav-btn col-nav me-2  
                           mb-sm-0 mb-1 nv-navbar tool" 
                           data-bs-toggle="tooltip" data-bs-placement="bottom" 
                           data-bs-title="Выход" data-bs-custom-class="custom-tooltip"
                           onclick="window.location.href = '/restuser/logout/';">
                            X
                        </button>
                        <button class="btn bg-nav-btn col-nav me-2   position-relative
                            mb-sm-0 mb-1 nv-navbar" 
                            data-bs-toggle="tooltip" data-bs-placement="bottom" 
                            data-bs-title="Закладки" data-bs-custom-class="custom-tooltip"
                            onclick="window.location.href = '/user/bookmarks/';">
                            {assign var="wishlistNotNull" 
                                  value=isset($arUser['user_wishlist'])&&!empty($arUser['user_wishlist'])}

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                                 fill="currentColor" class="bi bi-heart-fill {if !$wishlistNotNull}hideme{/if}" 
                                 viewBox="0 0 16 16" id="userWishlistFull">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                            {*if $wishlistNotNull*}
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill 
                                         bg-light col-nav {if !$wishlistNotNull}hideme{/if}" id="userWishlist">
                                {count($arUser['user_wishlist'])}
                                {*<span class="visually-hidden">в закладках</span>*}
                            </span>
                            {*/if*}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-heart {if $wishlistNotNull}hideme{/if}" viewBox="0 0 16 16" 
                                id="userWishlistEmpty">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>


                            {*
                            {if isset($arUser['user_wishlist'])}
                                {if !empty($arUser['user_wishlist'])}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>

                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light col-nav" id="userWishlist">
                                    {count($arUser['user_wishlist'])}
                                    <span class="visually-hidden">в закладках</span>
                                {else}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                {/if}
                            {else}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg>
                            {/if}
                            *} 
                            
                        </button>
                        {*cart not realised*} 
                        <button class="btn bg-nav-btn col-nav me-2  
                                     mb-sm-0 mb-1 nv-navbar" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Корзина" data-bs-custom-class="custom-tooltip"
                                onclick="window.location.href = '/user/bookmarks/';">
                            {if isset($arUser['user_wishlist'])}
                                {if !empty($arUser['user_wishlist'])}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                        class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                        <path 
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                    </svg>
                                {else}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                         class="bi bi-basket3" viewBox="0 0 16 16">
                                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                    </svg>
                                {/if}
                            {else}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                     class="bi bi-basket3" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                </svg>
                            {/if}
                        </button>


                    </div>
                {/if}
                {if isset($arUser)}
                    <div class="d-flex d-sm-none d-lg-block">

                    <!--<button class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Личный кабинет</button>
                            <button class="btn btn-outline-danger ms-3">Sign out</button> btn-outline-success-->

                        <form action="" class="d-flex me-2">
                            <input type="search" placeholder="Найти" 
                                class="form-control me-1 nv-navbar">
                            <button class="btn bg-nav-btn col-nav nv-navbar"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                    data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                {*<span class="d-none d-lg-block">Поиск</span>*}
                            </button>
                        </form>    
                    </div>
                
                    <div class="d-flex d-none d-sm-block d-lg-none me-2">
                        <button class="btn bg-nav-btn col-nav nv-navbar"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            {*<span class="d-none d-lg-block">Поиск</span>*}
                        </button>
                    </div>
                {else}
                    <div class="d-flex">

                    <!--<button class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Личный кабинет</button>
                            <button class="btn btn-outline-danger ms-3">Sign out</button> btn-outline-success-->

                        <form method="post" action="/products/search/" class="d-flex me-2">
                            <input type="search" placeholder="Найти" 
                                class="form-control me-1 nv-navbar" name="search0">
                            <button type="submit" class="btn bg-nav-btn col-nav nv-navbar"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                    data-bs-title="Поиск" data-bs-custom-class="custom-tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                                     fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                {*<span class="d-none d-lg-block">Поиск</span>*}
                            </button>
                        </form>    
                    </div>
                {/if}   

                <div class="d-flex mt-1">

                 <div class="form-check form-switch nv-hover">
                    {if $theme == 'light'} 
                     <input class="form-check-input" type="checkbox" 
                           id="flexSwitchCheckDefault"
                           onchange="changetheme(this.checked);document.location.reload();"
                           >
                    {else}
                     <input class="form-check-input" type="checkbox" 
                           id="flexSwitchCheckDefault" 
                           onchange="changetheme(this.checked);document.location.reload();"
                           checked>
                    {/if}    
                  <label class="form-check-label col-nav nv-hover" for="flexSwitchCheckDefault">
                    light/dark
                  </label>
                 </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
               {*aria-bs-labelledby="exampleModalLabel"*}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
                    <button class="btn-close" data-bs-dismiss="modal" {*aria-bs-label="close"*}>
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

                        {*<fieldset>
                            <div class="row md-3">
                                <legend class="col-form-label col-sm-2">Radio</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" 
                                               name="radios" id="radios1"
                                               value="option1" checked>
                                        <label for="radios1" class="form-check-lable">
                                            Radio 1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" 
                                               name="radios" id="radios2"
                                               value="option2">
                                        <label for="radios2" class="form-check-lable">
                                            Radio 2
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input type="radio" class="form-check-input" 
                                               name="radios" id="radios3"
                                               value="option3" disabled>
                                        <label for="radios3" class="form-check-lable">
                                            Radio 3
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row md-3">
                                <div class="col-form-label col-sm-2">Checkbox</div>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input type="checkbox" id="gridCheck" 
                                               class="form-check-input">
                                        <label for="gridCheck" 
                                               class="form-check-label">
                                            Save password
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>*}

                        <div class="row mb-3 d-flex justify-content-center">

                            {*<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>*}
                            <button type="submit" class="btn bg-nav-btn col-nav nv-navbar col-sm-11">Войти</button>
                        </div>

                        <div class="row mb-3">
                            <div class="mb-1 col-sm-6 d-flex justify-content-center">
                                {*<a href="#" class="nav-link">*}
                                <button class="btn bg-nav-btn col-nav nv-navbar" type="button"
                                        onclick="window.location.href = '/user/forgotpass/';">
                                    <span class="mx-3"> Забыли пароль </span>
                                </button>   
                                {*</a>*}
                            </div>
                            <div class="mb-1 col-sm-6 d-flex justify-content-center">
                                {*<a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal1">*}
                                <button class="btn bg-nav-btn col-nav nv-navbar" type="button"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    Зарегестрироваться
                                </button>    
                                {*</a>*}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                {*
                <div class="modal-footer bg-light">
                <div class="row mb-3">

                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn bg-nav-btn col-nav nv-navbar col-sm-12">Авторизоваться</button>
                </div>

                <div class="row mb-3"> 
                <div class="col-sm-6">
                <a href="#" class="nav-link">
                  Напомнить пароль
                </a>
                </div>
                <div class="col-sm-6">
                <a href="#" class="nav-link">
                  Зарегестрироваться
                </a>
                </div>
                </div>*}
            </div>
        {*</div>*}
    </div>
    <!-- /Modal-->

   <!-- Modal2-->
   <div class="modal fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
        {*aria-bs-labelledby="exampleModalLabel2"*}
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel2">Регистрация</h5>
                   <button class="btn-close" data-bs-dismiss="modal" {*aria-bs-label="close"*}>
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

                           {*<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>*}
                           <button type="submit"
                               class="btn bg-nav-btn col-nav nv-navbar col-sm-11">Зарегистрироваться</button>
                       </div>

                       <div class="row mb-3 d-flex justify-content-center">

                       <button class="btn bg-nav-btn col-nav nv-navbar col-sm-11" type="button"
                               data-bs-toggle="modal" data-bs-target="#exampleModal">
                       Авторизироваться
                    </button> 
                       </div>

                   </form>
               </div>
           </div>
           {*
           <div class="modal-footer bg-light">
           <div class="row mb-3">

           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button class="btn bg-nav-btn col-nav nv-navbar col-sm-12">Авторизоваться</button>
           </div>

           <div class="row mb-3"> 
           <div class="col-sm-6">
           <a href="#" class="nav-link">
             Напомнить пароль
           </a>
           </div>
           <div class="col-sm-6">
           <a href="#" class="nav-link">
             Зарегестрироваться
           </a>
           </div>
           </div>*}
       </div>
   {*</div>*}
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
                        <a class='nv-a col-nav-hover nv-hover' href="tel: {$arInfo['phone']}">
                            <p class="text-break col-nav nv-hover">{$arInfo['phone']}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class='nv-a col-nav-hover nv-hover' href="mailto: {$arInfo['email']}">
                            <p class="text-break col-nav nv-hover">{$arInfo['email']}</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-3">
                <img src="{$templateWebPath}images/logo.png" alt="logo" 
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
                <div id="centerColumn">  -->