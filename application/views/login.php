<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ログイン - はなぶさCloud</title>

		<meta name="description" content="ユーザログインページ" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">はなぶさ</span>
									<span class="white" id="id-text2">Cloud</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; 2016 &nbsp;<a href="http://www.navc2.co.jp/" target="_blank">NAVC</a></h4>
								
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter smaller">
												<i class="ace-icon fa fa-coffee green"></i>
												ログイン情報を入力してください
											</h4>

											<div class="space-6"></div>

											<form>
												<fieldset>
												 
													<label class="block clearfix">
													<label>ユーザ名</label>
														<span class="block input-icon input-icon-right">
														
															<input type="text" class="form-control" required maxlength="20" value=""  placeholder="例 myusername" />
															
                                  
															
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
													<label>パスワード</label>
														<span class="block input-icon input-icon-right">
														
															<input type="password" class="form-control" required maxlength="20"  placeholder="例 3df!28E5" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">ログイン</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main --></div><!-- /.widget-body -->
								</div><!-- /.login-box --><!-- /.forgot-box --><!-- /.signup-box -->
							</div><!-- /.position-relative -->

							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.js'>"+"<"+"/script>");
                        $('body').attr('class', 'login-layout light-login');
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
                        
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		
			//you don't need this, just used for changing background
			jQuery(function($) {
			        $('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
			 
			});
		</script>
	</body>
</html>
