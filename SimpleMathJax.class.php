<?php
class SimpleMathJax {
	static function init() {
	    global $wgParser;
		$wgParser->setHook( 'math', 'SimpleMathJax::render' );
	}

	static function render($tex) {
		$tex = str_replace('\>', '\;', $tex);
		$tex = str_replace('<', '\lt', $tex);
		$tex = str_replace('>', '\gt', $tex);
		return array("<span class='mathjax-wrapper'>[math]${tex}[/math]</span>", 'markerType'=>'nowiki');
	}
	
	static function loadJS(&$out, &$skin ) {
                global $wgSimpleMathJaxLocConf;
		global $wgSimpleMathJaxSize;
                global $IP;
		$out->addScript( "<style>.MathJax_Display{display:inline !important;}
.mathjax-wrapper{font-size:${wgSimpleMathJaxSize}%;}</style>");
                if (!$wgSimpleMathJaxLocConf){
                    $out->addScript("<script type='text/x-mathjax-config'>MathJax.Hub.Config({displayAlign:'left',tex2jax:{displayMath:[['[math]','[/math]']]}})</script>");
                } else {
                    $out->addScript( "<script type='text/x-mathjax-config'>" . file_get_contents("$IP/extensions/SimpleMathJax/mwMathJaxConfig.js") . "</script>" );
                }
                #$out->addScript("<script src='//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full'></script>" );
                $out->addScript("<script src='//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG-full'></script>" );
		return true;
	}
}
