<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CMS -> Trang chủ</title>
        <link href="<?=BASE_URL?>assets/backend/css/style.css" rel="stylesheet"/>
        <link href="<?=BASE_URL?>vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?=BASE_URL?>vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?=BASE_URL?>vendor/jquery-3.1.0.min.js"></script>
        <script src="<?=BASE_URL?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=BASE_URL?>assets/backend/js/style.js"></script>
        <script>
            function change_language(lang)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php BASE_URL.'language/lang';?>',
                    data: {language: lang},
                    success: function () {
                        //console.log('ad');
                        location.reload();
                    }
                });

            }
        </script>
    </head>
    <body>
                <div class="header navbar-inverse">
            <nav class="navbar" style = "margin-bottom : 0px">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header_top">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="" class="navbar-brand">CMS -> WEB ĐẸP</a>
                </div>
                <div class="navbar-collapse collapse " id="header_top">
                    <ul class="nav navbar-nav navbar-right nav_top">
                        <li><a href=""><span class="icons_welcome"></span>{hello}: Lam Hung</a></li>
                        <li><a href=""><span class="icons_user_info"></span>{update_personal_information}</a></li>
                        <li><a href="javascript:change_language('vi')"><span class="icons_vietnam"></span>{vietnamese}</a></li>
                        <li><a href="javascript:change_language('en')"><span class="icons_english"></span>{english}</a></li>
                        <li><a href="<?=BASE_URL?>acp/logout"><span class="icons_exit"></span>{logout}</a></li>
                    </ul>
                </div>
            </nav>
        </div><!--END HEADER-->
        <div class="menu">
            <nav class="navbar navbar-default" style = 'margin-bottom:0;'>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?=BASE_URL?>acp" class="navbar-brand home"><span class="glyphicon glyphicon-home" style="font-size: 20px;"></span></a>
                </div>
                <div class="navbar-collapse collapse" id="menu">
                    <ul class="nav navbar-nav nav_menu">
                        <li class="active dropdown">
                            <a href="<?=BASE_URL?>acp/user" data-toggle = 'dropdown'><span class="glyphicon glyphicon-user">&nbsp;</span>User<span class="caret">&nbsp;</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=BASE_URL?>acp/user/add">Thêm nhân viên</a></li>
                                <li><a href="<?=BASE_URL?>acp/user">Danh sách nhân viên</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=BASE_URL?>acp/banner" data-toggle = 'dropdown'><span class="glyphicon glyphicon-blackboard">&nbsp;</span>Banner<span class="caret">&nbsp;</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=BASE_URL?>acp/banner/add">Thêm banner</a></li>
                                <li><a href="<?=BASE_URL?>acp/banner">Danh sách banner</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="<?=BASE_URL?>acp/product" data-toggle = 'dropdown'><span class="glyphicon glyphicon-folder-close">&nbsp;</span>Product<span class="caret">&nbsp;</span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a  class="menu_sub" tabindex="-1" href="<?=BASE_URL?>acp/category_group">Nhóm Danh Mục<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/category_group">Danh sách nhóm danh mục</a></li>
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/category_group/add">Thêm nhóm danh mục</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a  class="menu_sub" tabindex="-1" href="<?=BASE_URL?>acp/category">Danh Mục<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/category">Danh sách danh mục</a></li>
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/category/add">Thêm danh mục</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a  class="menu_sub" tabindex="-1" href="<?=BASE_URL?>acp/product">Sản Phẩm<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/product">Danh sách sản phẩm</a></li>
                                        <li><a tabindex="-1" href="<?=BASE_URL?>acp/product/add">Thêm sản phẩm</a></li>
                                    </ul>
                                </li>
                            </ul>
                        
                        </li>
                        <li>
                            <a href="<?=BASE_URL?>acp/news" data-toggle = 'dropdown'><span class="glyphicon glyphicon-globe">&nbsp;</span>News<span class="caret">&nbsp;</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=BASE_URL?>acp/news/add">Thêm tin</a></li>
                                <li><a href="<?=BASE_URL?>acp/news">Danh sách tin</a></li>
                                <div class="divider"></div>
                                <li><a href="<?=BASE_URL?>acp/get_news/add">Lấy tin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div><!--END MENU-->
        <div class="note">
            <marquee behavior="scroll" align="left" scrollamount="4" >
                <img src="<?=BASE_URL?>assets/backend/img/icons/news.png" alt="" />Lưu ý: Mã nguồn do công ty chúng tôi phát triển - Tuyệt đối không xài mã nguồn mở ( joomla, wordpress... ) - Quí khách có nhu cầu thêm chức năng vui lòng liên hệ : 123456
            </marquee>
        </div><!--END NOTE-->

        <div class="clear"></div>
        <div style = 'height: 30px;'></div>
        <!-- ///////////////////////////////////////////////// BEGIN MODUEL ///////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid">
            <div class="wrapper">
                



