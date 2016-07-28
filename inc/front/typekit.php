<?php

function stormbringer_typekit() {

	$typekit_id = get_theme_mod('typekit_id');

    $script = '';
	if ( $typekit_id ) :
        $script .= "\n" . '<!-- Typekit -->' . "\n";
        $script .= '<script type="text/javascript" src="//use.typekit.net/'.$typekit_id.'.js"></script>' . "\n";
        $script .= '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>' . "\n";
	endif;

    // Aynshronous method. See http://blog.typekit.com/2011/05/25/loading-typekit-fonts-asynchronously/
    $script = '';
    if ( $typekit_id ) :
    $script = <<<EOS
    <script type="text/javascript">(function (d) {
			var tkTimeout = 3000;
			if (window.sessionStorage) {
				if (sessionStorage.getItem('useTypekit') === 'false') {
					tkTimeout = 0;
				}
			}
			var config = {
						kitId: '{$typekit_id}',
						scriptTimeout: tkTimeout
					},
					h = d.documentElement, t = setTimeout(function () {
						h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
						if (window.sessionStorage) {
							sessionStorage.setItem("useTypekit", "false")
						}
					}, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a;
			h.className += " wf-loading";
			tk.src = '//use.typekit.net/' + config.kitId + '.js';
			tk.async = true;
			tk.onload = tk.onreadystatechange = function () {
				a = this.readyState;
				if (f || a && a != "complete" && a != "loaded")return;
				f = true;
				clearTimeout(t);
				try {
					Typekit.load(config)
				} catch (e) {
				}
			};
			s.parentNode.insertBefore(tk, s)
		})(document);</script>
EOS;
    endif;

    echo $script;
}

add_action( 'wp_head', 'stormbringer_typekit', 30 );