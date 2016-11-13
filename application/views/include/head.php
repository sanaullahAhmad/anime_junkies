<head ng-init="page_title = '<?php echo config_item('site_name'); ?>'">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title ng-bind="page_title"></title>

        <!-- Bootstrap -->
        <link href="<?= config_item('css_path'); ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= config_item('css_path'); ?>bootflat.min.css" rel="stylesheet">
        <link href="<?= config_item('css_path'); ?>font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= config_item('plugins_path'); ?>owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?= config_item('plugins_path'); ?>owl-carousel/owl.theme.css">
        <link href="<?= config_item('css_path'); ?>custom.css" rel="stylesheet">
        <link rel='stylesheet' media='screen and (min-width: 120px) and (max-width: 319px)' href='<?= config_item('css_path'); ?>mobile.css' />
        <link rel='stylesheet' media='screen and (min-width: 320px) and (max-width: 480px)' href='<?= config_item('css_path'); ?>smart-phones.css' />
        <link rel='stylesheet' media='screen and (min-width: 481px) and (max-width: 640px)' href='<?= config_item('css_path'); ?>tablets.css' />
        <link rel='stylesheet' media='screen and (min-width: 641px) and (max-width: 960px)' href='<?= config_item('css_path'); ?>iPad.css' />
        <link rel='stylesheet' media='screen and (min-width: 961px) and (max-width: 1024px)' href='<?= config_item('css_path'); ?>960res.css' />
        <link rel='stylesheet' media='screen and (min-width: 1025px) and (max-width: 1280px)' href='<?= config_item('css_path'); ?>1024res.css' />
        <link rel='stylesheet' media='screen and (max-width: 1281px)' href='<?= config_item('css_path'); ?>1280res.css' />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel='stylesheet' href='<?= config_item('css_path'); ?>new_cus.css' />
        <base href="<?php echo base_url()?>">
</head>