<div id="navbar">
	<ul class="navbar-nav float-left">
		<li><a href="<?=$_Oli->getUrlParam(0)?>"><i class="fa fa-globe fa-fw"></i> <span class="d-none d-sm-inline"><?=explode('/', $_Oli->getUrlParam(0), 3)[2]?></span><span class="d-sm-none">Website</span></a></li>
		<li><a href="<?=$_Oli->getAdminUrl()?>"><i class="fa fa-home fa-fw"></i> Oli Admin</a></li>
	</ul>
	<ul class="navbar-nav float-right">
		<?php if($_Oli->isLoggedIn()) { ?>
			<li><a href=""><img src="<?=$_Oli->getMediaUrl()?>default-avatar.png" /> <?=$_Oli->getLoggedUsername()?></a></li>
			<li><a href=""><i class="fa fa-user-cog"></i></a></li>
		<?php } else { ?>
			<li><a href=""><i class="fa fa-sign-in-alt fa-fw"></i> Login</a></li>
		<?php } ?>
	</ul>
</div>