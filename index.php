<?php

function is_live() {
	$domain = $_SERVER['SERVER_NAME'];
	if ( strpos( $domain, '.dev' ) > 0 ) {
		return false;
	}
	return true;
}

if ( is_live() ) {
	if ( file_exists( 'cache/cached.html' ) && time() - 3600 < filemtime( 'cache/cached.html' ) ) {
	    include( 'cache/cached.html' );
	    exit;
	}
	ob_start();
}

?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title>BrandColors: a collection of major brand color codes</title>
	<meta title="description" content="A collection of major brand color codes curated by Galen Gidman.">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/png" href="img/favicon.png">
	<script src="js/prefixfree.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="//use.typekit.net/xfp6olo.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>

</head>
<body>

	<div class="page-header container" role="banner">
		<h1>BrandColors</h1>
		<h3>A collection of major brand color codes curated by <a href="http://twitter.com/galengidman">Galen Gidman</a>.</h3>
	</div>

	<div class="toolbar">
		<div class="container">
			<div class="sharing">
				<?php
					$new_counts = json_decode( file_get_contents( 'http://api.sharedcount.com/?url=' . rawurlencode( 'http://brandcolors.net' ) ) );
					$old_counts = json_decode( file_get_contents( 'http://api.sharedcount.com/?url=' . rawurlencode( 'http://galengidman.com/brandcolors/' ) ) );

					$tweets = $old_counts->Twitter + $new_counts->Twitter;
					$shares = $old_counts->Facebook->total_count + $new_counts->Facebook->total_count;
					$plusones = $old_counts->GooglePlusOne + $new_counts->GooglePlusOne;

					echo '<a class="button tweets" href="https://twitter.com/intent/tweet?url=http%3A%2F%2Fbrandcolors.net%2F&text=BrandColors%3A+a+collection+of+major+brand+color+codes.&via=galengidman" target="_blank"><span class="action">Tweet</span><span class="count">' . $tweets . '</span></a>';
					echo '<a class="button shares" href="http://www.facebook.com/sharer.php?u=http://brandcolors.net/&t=BrandColors: A collection of major brand color codes." target="_blank"><span class="action">Share</span><span class="count">' . $shares . '</span></a>';
					echo '<a class="button plusones" href="https://plus.google.com/share?url=http://brandcolors.net/" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"><span class="action">+1</span><span class="count">' . $plusones . '</span></a>';
				?>
			</div>
			<div class="search">
				<input type="search" id="search" placeholder="search">
			</div>
		</div>
	</div>

	<div class="main container" role="main">
		<?php foreach( json_decode( file_get_contents( 'data/brands.json' ) )->data as $brand ) : ?>
			<div class="color cf" data-brand="<?php echo $brand->name; ?>" data-hex="<?php echo $brand->hex; ?>" style="background-color: #<?php echo $brand->hex; ?>">
				<h2><?php echo $brand->name; ?></h2>
				<div class="hex">#<?php echo $brand->hex; ?></div>
			</div>
		<?php endforeach; ?>
	</div>

</body>
</html>

<?php

if ( is_live() ) {
	file_put_contents('cache/cached.html', ob_get_flush() );
}