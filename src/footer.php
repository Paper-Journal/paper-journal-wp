</main>
<footer class="footer">
<?php if ( is_active_sidebar( 'footer-bar' ) ) : ?>
    <div class="footer_sidebar">
 	   <?php dynamic_sidebar( 'footer-bar' ); ?>
    </div>
<?php endif; ?>
<small>Copyright © Paper Journal Publishing 2013-<?php echo date("Y"); ?>. All Rights Reserved | Australian Business Number 14292709642 | <a href="/privacy-policy">Privacy Policy</a> | <a href="/terms-conditions">Terms &amp; Conditions</a></small>
</footer>
<?php wp_footer(); ?>
<script>
	function openNav() {
	  	document.getElementById("myNav").style.display = "block";
		document.getElementsByTagName("body")[0].style.overflow = "hidden";
	}
	function closeNav() {
	  	document.getElementById("myNav").style.display = "none";
		document.getElementsByTagName("body")[0].style.overflow = "unset";
	}
</script>
</body>
</html>