<?php
	class Notifications
	{
		function showNotifications($userId)
		{
?>
		<button type="button" id="notif" class="button-default show-notifications active js-show-notifications">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="32" viewBox="0 0 30 32">
		<defs>
			<g id="icon-bell">
				<path class="path1" d="M15.143 30.286q0-0.286-0.286-0.286-1.054 0-1.813-0.759t-0.759-1.813q0-0.286-0.286-0.286t-0.286 0.286q0 1.304 0.92 2.223t2.223 0.92q0.286 0 0.286-0.286zM3.268 25.143h23.179q-2.929-3.232-4.402-7.348t-1.473-8.652q0-4.571-5.714-4.571t-5.714 4.571q0 4.536-1.473 8.652t-4.402 7.348zM29.714 25.143q0 0.929-0.679 1.607t-1.607 0.679h-8q0 1.893-1.339 3.232t-3.232 1.339-3.232-1.339-1.339-3.232h-8q-0.929 0-1.607-0.679t-0.679-1.607q3.393-2.875 5.125-7.098t1.732-8.902q0-2.946 1.714-4.679t4.714-2.089q-0.143-0.321-0.143-0.661 0-0.714 0.5-1.214t1.214-0.5 1.214 0.5 0.5 1.214q0 0.339-0.143 0.661 3 0.357 4.714 2.089t1.714 4.679q0 4.679 1.732 8.902t5.125 7.098z" />
			</g>
		</defs>
		<g fill="#000000">
			<use xlink:href="#icon-bell" transform="translate(0 0)"></use>
		</g>
	</svg>
  <div class="notifications-count js-count">
	<?php 
		$count = mysql_query("SELECT * FROM `notifications` WHERE `main_id`='$userId'") or die(mysql_error()); echo mysql_num_rows($count);
	?>
  </div>
</button>
<?php
		}
	}
?>