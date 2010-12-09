<html>
<head>
	<title>Content Management System</title>
	<link rel='stylesheet' type='text/css' href='/app/assets/css/backend/admin.css' />
</head>
<body>
	<div id='login'>
		<div class='logo'>Content Management System</div>
		<?=(!empty($msg) ? "<div class='msg'>".$msg."</div>" : "")?>
		<div class='box'>
			<form method='post' action='/admin/'>
				<div>
					<label>Username</label>
					<input type='text' name='login[username]' />
				</div>
				<div style='clear: both;'></div>
				<div>
					<label>Password</label>
					<input type='password' name='login[password]' />
				</div>
				<div style='clear: both;'></div>
				<div>
					<label>&nbsp;</label>
					<button type='submit'>Login</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>