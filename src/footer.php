<footer class="footer">
<?php if ( is_active_sidebar( 'footer-bar' ) ) : ?>
    <div class="footer_sidebar">
 	   <?php dynamic_sidebar( 'footer-bar' ); ?>
    </div>
<?php endif; ?>
<small>Copyright © Paper Journal Publishing 2013-<?php echo date("Y"); ?>. All Rights Reserved | Australian Business Number 14292709642 | <a href="/privacy-policy">Privacy Policy</a> | <a href="/terms-conditions">Terms &amp; Conditions</a></small>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>