<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Terjadi Kesalahan | TTIS</title>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap');

::selection { background-color: #00d4ff; color: #050b14; }

* { box-sizing: border-box; }

body {
	background-color: #050b14;
	background-image:
		linear-gradient(rgba(0,212,255,0.05) 1px, transparent 1px),
		linear-gradient(90deg, rgba(0,212,255,0.05) 1px, transparent 1px);
	background-size: 40px 40px;
	color: #c8d8e8;
	font: 15px/1.6 'Rajdhani', Helvetica, Arial, sans-serif;
	min-height: 100vh;
	margin: 0;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 2rem 1rem;
}

a { color: #00d4ff; }

#container {
	max-width: 640px;
	width: 100%;
	background: #0d1f2d;
	border: 1px solid rgba(255,59,92,0.3);
	border-radius: 6px;
	box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 40px rgba(255,59,92,0.08);
	padding: 2.5rem 2rem;
	text-align: center;
}

.error-tag {
	font-family: 'Share Tech Mono', monospace;
	font-size: 0.78rem;
	letter-spacing: 3px;
	text-transform: uppercase;
	color: #ff3b5c;
	margin: 0 0 1.25rem;
}

h1 {
	color: #ff3b5c;
	font-family: 'Orbitron', sans-serif;
	font-weight: 700;
	font-size: 1.3rem;
	margin: 0 0 1rem 0;
	border: none;
	text-shadow: 0 0 20px rgba(255,59,92,0.4);
}

p { margin: 0.5rem 0; color: #c8d8e8; }

code {
	font-family: 'Share Tech Mono', Consolas, Monaco, monospace;
	font-size: 12px;
	background: rgba(0,0,0,0.35);
	border: 1px solid rgba(255,59,92,0.25);
	color: #ff8fa3;
	display: block;
	margin: 1rem 0;
	padding: 0.75rem 1rem;
	border-radius: 3px;
	text-align: left;
	overflow-x: auto;
}

.btn-home {
	display: inline-block;
	margin-top: 1.5rem;
	padding: 0.6rem 1.6rem;
	border: 1px solid #00d4ff;
	color: #00d4ff;
	background: rgba(0,212,255,0.08);
	border-radius: 3px;
	text-decoration: none;
	font-weight: 700;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-size: 0.85rem;
	transition: all 0.2s ease;
}
.btn-home:hover { background: #00d4ff; color: #050b14; }
</style>
</head>
<body>
	<div id="container">
		<div class="error-tag">&#9888; SYSTEM ALERT &mdash; TTIS KAB. MUARA ENIM</div>
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
		<a class="btn-home" href="/">Kembali ke Beranda</a>
	</div>
</body>
</html>
