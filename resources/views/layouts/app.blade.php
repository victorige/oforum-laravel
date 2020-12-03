<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>
    <meta name="description" content="Earn Money Online In Nigeria Reading News On Oforum">
    @php
    if(isset($_GET["shr"])){
        $shrx = rand('1','3');
    }else{
        $shrx = 0;
    }
    @endphp

    @if ($shrx == 0)
    <meta name="og:image" content="{{ asset('icon.png') }}">
    @elseif ($shrx == 1)
    <meta name="og:image" content="{{ asset('oforum11.png') }}">
    @elseif ($shrx == 2)
    <meta name="og:image" content="{{ asset('oforum22.png') }}">
    @elseif ($shrx == 3)
    <meta name="og:image" content="{{ asset('oforum33.png') }}">
    @endif



	<!-- Main Font -->
	<script src="{{ asset('asset/js/libs/webfontloader.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
    </script>

    <link href="{{ asset('favicon.ico') }}" rel="icon" />


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap-reboot.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap-grid.css') }}">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/fonts.min.css') }}">

    <style>
div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
}

.chip {
    font-family: Poppins, sans-serif;
    display: inline-block;
    padding: 0 25px;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #ed1c24;

}

.chip b {
    color: white;
    text-transform: uppercase;
}

.chip i {
    float: left;
    margin: 10px 10px 10px -15px;
    font-size: 2.0em;
    color: white;
}

 a:hover .chip {
    background-color: black;
}
</style>

<script data-ad-client="ca-pub-9587885399192232" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>



            @yield('content')

            @php
            if(!isset($_COOKIE["forward_oforum1"])){
                setcookie("forward_oforum1", "budearn", time() + 3600);
                echo "<script> setTimeout(() => budearn(), 5000); </script>";
            }

            @endphp

<script>
function budearn(){
    window.location = 'https://budearn.com';
}
</script>

    <!-- JS Scripts -->
<script src="{{ asset('asset/js/jQuery/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.appear.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('asset/js/libs/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.matchHeight.js') }}"></script>
<script src="{{ asset('asset/js/libs/svgxuse.js') }}"></script>
<script src="{{ asset('asset/js/libs/imagesloaded.pkgd.js') }}"></script>
<script src="{{ asset('asset/js/libs/Headroom.js') }}"></script>
<script src="{{ asset('asset/js/libs/velocity.js') }}"></script>
<script src="{{ asset('asset/js/libs/ScrollMagic.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.waypoints.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.countTo.js') }}"></script>
<script src="{{ asset('asset/js/libs/popper.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/material.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/bootstrap-select.js') }}"></script>
<script src="{{ asset('asset/js/libs/smooth-scroll.js') }}"></script>
<script src="{{ asset('asset/js/libs/selectize.js') }}"></script>
<script src="{{ asset('asset/js/libs/swiper.jquery.js') }}"></script>
<script src="{{ asset('asset/js/libs/moment.js') }}"></script>
<script src="{{ asset('asset/js/libs/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/js/libs/fullcalendar.js') }}"></script>
<script src="{{ asset('asset/js/libs/isotope.pkgd.js') }}"></script>
<script src="{{ asset('asset/js/libs/ajax-pagination.js') }}"></script>
<script src="{{ asset('asset/js/libs/Chart.js') }}"></script>
<script src="{{ asset('asset/js/libs/chartjs-plugin-deferred.js') }}"></script>
<script src="{{ asset('asset/js/libs/circle-progress.js') }}"></script>
<script src="{{ asset('asset/js/libs/loader.js') }}"></script>
<script src="{{ asset('asset/js/libs/run-chart.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.gifplayer.js') }}"></script>
<script src="{{ asset('asset/js/libs/mediaelement-and-player.js') }}"></script>
<script src="{{ asset('asset/js/libs/mediaelement-playlist-plugin.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('asset/js/libs/leaflet.js') }}"></script>
<script src="{{ asset('asset/js/libs/MarkerClusterGroup.js') }}"></script>
<script src="{{ asset('asset/js/libs/lazyload.js') }}"></script>
<script type="text/javascript">
	var pageLazyLoad = new LazyLoad({
		elements_selector: "[loading=lazy]",
		use_native: true // ← enables hybrid lazy loading
	});

	window.lazyLoadOptions = {
		elements_selector: "[loading=lazy]",
		use_native: true // ← enables hybrid lazy loading
	};
</script>

<script src="{{ asset('asset/js/main.js') }}"></script>
<script src="{{ asset('asset/js/libs-init/libs-init.js') }}"></script>
<script defer src="fonts/fontawesome-all.js') }}"></script>

<script src="{{ asset('asset/Bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153152778-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153152778-1');
</script>

<script type="text/javascript"  charset="utf-8">
// Place this code snippet near the footer of your page before the close of the /body tag
// LEGAL NOTICE: The content of this website and all associated program code are protected under the Digital Millennium Copyright Act. Intentionally circumventing this code may constitute a violation of the DMCA.

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';q O=\'\',28=\'1V\';1R(q i=0;i<12;i++)O+=28.X(D.N(D.J()*28.F));q 2F=2,2r=5n,2e=5q,2d=5r,2C=B(t){q o=!1,i=B(){z(k.1g){k.2P(\'2H\',e);E.2P(\'1U\',e)}P{k.2R(\'33\',e);E.2R(\'1W\',e)}},e=B(){z(!o&&(k.1g||5u.2G===\'1U\'||k.2T===\'2V\')){o=!0;i();t()}};z(k.2T===\'2V\'){t()}P z(k.1g){k.1g(\'2H\',e);E.1g(\'1U\',e)}P{k.2Y(\'33\',e);E.2Y(\'1W\',e);q n=!1;2p{n=E.5A==5H&&k.1Y}2t(a){};z(n&&n.2s){(B r(){z(o)G;2p{n.2s(\'17\')}2t(e){G 4Z(r,50)};o=!0;i();t()})()}}};E[\'\'+O+\'\']=(B(){q t={t$:\'1V+/=\',52:B(e){q r=\'\',d,n,o,c,s,l,i,a=0;e=t.e$(e);1a(a<e.F){d=e.14(a++);n=e.14(a++);o=e.14(a++);c=d>>2;s=(d&3)<<4|n>>4;l=(n&15)<<2|o>>6;i=o&63;z(2z(n)){l=i=64}P z(2z(o)){i=64};r=r+U.t$.X(c)+U.t$.X(s)+U.t$.X(l)+U.t$.X(i)};G r},11:B(e){q n=\'\',d,l,c,s,a,i,r,o=0;e=e.1A(/[^A-59-5c-9\\+\\/\\=]/g,\'\');1a(o<e.F){s=U.t$.1H(e.X(o++));a=U.t$.1H(e.X(o++));i=U.t$.1H(e.X(o++));r=U.t$.1H(e.X(o++));d=s<<2|a>>4;l=(a&15)<<4|i>>2;c=(i&3)<<6|r;n=n+S.T(d);z(i!=64){n=n+S.T(l)};z(r!=64){n=n+S.T(c)}};n=t.n$(n);G n},e$:B(t){t=t.1A(/;/g,\';\');q n=\'\';1R(q o=0;o<t.F;o++){q e=t.14(o);z(e<1s){n+=S.T(e)}P z(e>6l&&e<6q){n+=S.T(e>>6|6s);n+=S.T(e&63|1s)}P{n+=S.T(e>>12|2f);n+=S.T(e>>6&63|1s);n+=S.T(e&63|1s)}};G n},n$:B(t){q o=\'\',e=0,n=6t=1u=0;1a(e<t.F){n=t.14(e);z(n<1s){o+=S.T(n);e++}P z(n>6w&&n<2f){1u=t.14(e+1);o+=S.T((n&31)<<6|1u&63);e+=2}P{1u=t.14(e+1);2k=t.14(e+2);o+=S.T((n&15)<<12|(1u&63)<<6|2k&63);e+=3}};G o}};q r=[\'5N==\',\'5O\',\'5P=\',\'5Y\',\'62\',\'69=\',\'6a=\',\'6b=\',\'3I\',\'3x\',\'3g=\',\'5R=\',\'6F\',\'4f\',\'4e=\',\'4d\',\'4c=\',\'4b=\',\'4a=\',\'49=\',\'48=\',\'47=\',\'46==\',\'45==\',\'44==\',\'43==\',\'42=\',\'40\',\'3L\',\'3Z\',\'3Y\',\'3X\',\'3W\',\'3V==\',\'3U=\',\'3T=\',\'3S=\',\'3R==\',\'3Q=\',\'3P\',\'3O=\',\'3N=\',\'3M==\',\'4g=\',\'41==\',\'4h==\',\'4z=\',\'4N=\',\'4M\',\'4L==\',\'4K==\',\'4J\',\'4I==\',\'4H=\'],y=D.N(D.J()*r.F),Y=t.11(r[y]),w=Y,Z=1,g=\'#4G\',a=\'#4F\',v=\'#4E\',W=\'#4D\',L=\'\',b=\'4C!\',p=\'4B 4A 4y 4j\\\'4x 4w 3J 34 2U. 4u\\\'s 4t.  4s 4r\\\'t?\',f=\'4q 4p 4o-4n, 4m 2X\\\'t 4l 4k U 4i 3K.\',s=\'I 3h, I 3e 3c 39 34 2U.  3i 3f 3d!\',o=0,u=0,n=\'3a.38\',l=0,M=e()+\'.2M\';B h(t){z(t)t=t.1S(t.F-15);q o=k.2Q(\'3b\');1R(q n=o.F;n--;){q e=S(o[n].1G);z(e)e=e.1S(e.F-15);z(e===t)G!0};G!1};B m(t){z(t)t=t.1S(t.F-15);q e=k.3k;x=0;1a(x<e.F){1n=e[x].1Q;z(1n)1n=1n.1S(1n.F-15);z(1n===t)G!0;x++};G!1};B e(t){q n=\'\',o=\'1V\';t=t||30;1R(q e=0;e<t;e++)n+=o.X(D.N(D.J()*o.F));G n};B i(o){q i=[\'3G\',\'3F==\',\'3E\',\'3D\',\'2S\',\'3C==\',\'3B=\',\'3A==\',\'3z=\',\'3y==\',\'3w==\',\'3l==\',\'3v\',\'3u\',\'3t\',\'2S\'],a=[\'2I=\',\'3s==\',\'3r==\',\'3q==\',\'3p=\',\'3o\',\'3n=\',\'3m=\',\'2I=\',\'4O\',\'4v==\',\'4Q\',\'3j==\',\'6e==\',\'6d==\',\'6c=\'];x=0;1P=[];1a(x<o){c=i[D.N(D.J()*i.F)];d=a[D.N(D.J()*a.F)];c=t.11(c);d=t.11(d);q r=D.N(D.J()*2)+1;z(r==1){n=\'//\'+c+\'/\'+d}P{n=\'//\'+c+\'/\'+e(D.N(D.J()*20)+4)+\'.2M\'};1P[x]=26 24();1P[x].1X=B(){q t=1;1a(t<7){t++}};1P[x].1G=n;x++}};B C(t){};G{2g:B(t,a){z(68 k.K==\'67\'){G};q o=\'0.1\',a=w,e=k.1d(\'1y\');e.1k=a;e.j.1h=\'1O\';e.j.17=\'-1o\';e.j.V=\'-1o\';e.j.1t=\'29\';e.j.13=\'66\';q d=k.K.36,r=D.N(d.F/2);z(r>15){q n=k.1d(\'2b\');n.j.1h=\'1O\';n.j.1t=\'1r\';n.j.13=\'1r\';n.j.V=\'-1o\';n.j.17=\'-1o\';k.K.61(n,k.K.36[r]);n.1f(e);q i=k.1d(\'1y\');i.1k=\'35\';i.j.1h=\'1O\';i.j.17=\'-1o\';i.j.V=\'-1o\';k.K.1f(i)}P{e.1k=\'35\';k.K.1f(e)};l=5M(B(){z(e){t((e.1T==0),o);t((e.23==0),o);t((e.1K==\'2m\'),o);t((e.1N==\'2v\'),o);t((e.1J==0),o)}P{t(!0,o)}},27)},1F:B(e,c){z((e)&&(o==0)){o=1;E[\'\'+O+\'\'].1z();E[\'\'+O+\'\'].1F=B(){G}}P{q f=t.11(\'5X\'),u=k.5W(f);z((u)&&(o==0)){z((2r%3)==0){q l=\'5V=\';l=t.11(l);z(h(l)){z(u.1E.1A(/\\s/g,\'\').F==0){o=1;E[\'\'+O+\'\'].1z()}}}};q y=!1;z(o==0){z((2e%3)==0){z(!E[\'\'+O+\'\'].2w){q d=[\'5U==\',\'5T==\',\'5S=\',\'4P=\',\'5Q=\'],m=d.F,a=d[D.N(D.J()*m)],r=a;1a(a==r){r=d[D.N(D.J()*m)]};a=t.11(a);r=t.11(r);i(D.N(D.J()*2)+1);q n=26 24(),s=26 24();n.1X=B(){i(D.N(D.J()*2)+1);s.1G=r;i(D.N(D.J()*2)+1)};s.1X=B(){o=1;i(D.N(D.J()*3)+1);E[\'\'+O+\'\'].1z()};n.1G=a;z((2d%3)==0){n.1W=B(){z((n.13<8)&&(n.13>0)){E[\'\'+O+\'\'].1z()}}};i(D.N(D.J()*3)+1);E[\'\'+O+\'\'].2w=!0};E[\'\'+O+\'\'].1F=B(){G}}}}},1z:B(){z(u==1){q Q=2E.6v(\'2i\');z(Q>0){G!0}P{2E.6E(\'2i\',(D.J()+1)*27)}};q h=\'6C==\';h=t.11(h);z(!m(h)){q c=k.1d(\'6A\');c.1Z(\'6z\',\'6y\');c.1Z(\'2G\',\'1m/6x\');c.1Z(\'1Q\',h);k.2Q(\'6u\')[0].1f(c)};6i(l);k.K.1E=\'\';k.K.j.16+=\'R:1r !19\';k.K.j.16+=\'1C:1r !19\';q M=k.1Y.23||E.2Z||k.K.23,y=E.6r||k.K.1T||k.1Y.1T,r=k.1d(\'1y\'),Z=e();r.1k=Z;r.j.1h=\'2x\';r.j.17=\'0\';r.j.V=\'0\';r.j.13=M+\'1v\';r.j.1t=y+\'1v\';r.j.2q=g;r.j.21=\'6p\';k.K.1f(r);q d=\'<a 1Q="6o://6n.6m" j="H-1e:10.6k;H-1j:1i-1l;1c:6j;">6h 2X 5L 5K 5J 5g 5f</a>\';d=d.1A(\'5e\',e());d=d.1A(\'5d\',e());q i=k.1d(\'1y\');i.1E=d;i.j.1h=\'1O\';i.j.1B=\'1I\';i.j.17=\'1I\';i.j.13=\'5b\';i.j.1t=\'5a\';i.j.21=\'2n\';i.j.1J=\'.6\';i.j.2j=\'2o\';i.1g(\'57\',B(){n=n.56(\'\').54().4R(\'\');E.2h.1Q=\'//\'+n});k.1D(Z).1f(i);q o=k.1d(\'1y\'),C=e();o.1k=C;o.j.1h=\'2x\';o.j.V=y/7+\'1v\';o.j.51=M-4Y+\'1v\';o.j.4X=y/3.5+\'1v\';o.j.2q=\'#4W\';o.j.21=\'2n\';o.j.16+=\'H-1j: "4V 4U", 1w, 1x, 1i-1l !19\';o.j.16+=\'4T-1t: 4S !19\';o.j.16+=\'H-1e: 5h !19\';o.j.16+=\'1m-1p: 1q !19\';o.j.16+=\'1C: 55 !19\';o.j.1K+=\'2K\';o.j.37=\'1I\';o.j.5i=\'1I\';o.j.5I=\'2D\';k.K.1f(o);o.j.5G=\'1r 5E 5D -5C 5B(0,0,0,0.3)\';o.j.1N=\'2u\';q w=30,Y=22,x=18,L=18;z((E.2Z<32)||(5z.13<32)){o.j.2W=\'50%\';o.j.16+=\'H-1e: 5w !19\';o.j.37=\'5v;\';i.j.2W=\'65%\';q w=22,Y=18,x=12,L=12};o.1E=\'<2N j="1c:#5t;H-1e:\'+w+\'1L;1c:\'+a+\';H-1j:1w, 1x, 1i-1l;H-1M:5s;R-V:1b;R-1B:1b;1m-1p:1q;">\'+b+\'</2N><2L j="H-1e:\'+Y+\'1L;H-1M:5p;H-1j:1w, 1x, 1i-1l;1c:\'+a+\';R-V:1b;R-1B:1b;1m-1p:1q;">\'+p+\'</2L><5o j=" 1K: 2K;R-V: 0.2J;R-1B: 0.2J;R-17: 2a;R-2l: 2a; 2A:5m 5l #5j; 13: 25%;1m-1p:1q;"><p j="H-1j:1w, 1x, 1i-1l;H-1M:2y;H-1e:\'+x+\'1L;1c:\'+a+\';1m-1p:1q;">\'+f+\'</p><p j="R-V:5y;"><2b 5F="U.j.1J=.9;" 5x="U.j.1J=1;"  1k="\'+e()+\'" j="2j:2o;H-1e:\'+L+\'1L;H-1j:1w, 1x, 1i-1l; H-1M:2y;2A-53:2D;1C:1b;58-1c:\'+v+\';1c:\'+W+\';1C-17:29;1C-2l:29;13:60%;R:2a;R-V:1b;R-1B:1b;" 6B="E.2h.6D();">\'+s+\'</2b></p>\'}}})();E.2O=B(t,e){q n=6g.5Z,o=E.6f,r=n(),i,a=B(){n()-r<e?i||o(a):t()};o(a);G{3H:B(){i=1}}};q 2B;z(k.K){k.K.j.1N=\'2u\'};2C(B(){z(k.1D(\'2c\')){k.1D(\'2c\').j.1N=\'2m\';k.1D(\'2c\').j.1K=\'2v\'};2B=E.2O(B(){E[\'\'+O+\'\'].2g(E[\'\'+O+\'\'].1F,E[\'\'+O+\'\'].5k)},2F*27)});',62,414,'|||||||||||||||||||style|document||||||var|||||||||if||function||Math|window|length|return|font||random|body|||floor|HXkaHLEuULis|else||margin|String|fromCharCode|this|top||charAt||||decode||width|charCodeAt||cssText|left||important|while|10px|color|createElement|size|appendChild|addEventListener|position|sans|family|id|serif|text|thisurl|5000px|align|center|0px|128|height|c2|px|Helvetica|geneva|DIV|MBEWBmHfGC|replace|bottom|padding|getElementById|innerHTML|MCoWdjmxjg|src|indexOf|30px|opacity|display|pt|weight|visibility|absolute|spimg|href|for|substr|clientHeight|load|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|onload|onerror|documentElement|setAttribute||zIndex||clientWidth|Image||new|1000|KJqfuwrsfY|60px|auto|div|babasbmsgx|YFMXGGGhDm|xMvLGnoOaL|224|FbYbUJAWGx|location|babn|cursor|c3|right|hidden|10000|pointer|try|backgroundColor|jJyrugroJS|doScroll|catch|visible|none|ranAlready|fixed|300|isNaN|border|cDoURChMwk|EOvSKzcXWm|15px|sessionStorage|dVHISiUAoA|type|DOMContentLoaded|ZmF2aWNvbi5pY28|5em|block|h1|jpg|h3|daiKIaTCAi|removeEventListener|getElementsByTagName|detachEvent|cGFydG5lcmFkcy55c20ueWFob28uY29t|readyState|blocker|complete|zoom|can|attachEvent|innerWidth|||640|onreadystatechange|ad|banner_ad|childNodes|marginLeft|kcolbdakcolb|my|moc|script|disabled|in|have|me|YWQtY29udGFpbmVyLTE|understand|Let|YmFubmVyX2FkLmdpZg|styleSheets|YWRzLnp5bmdhLmNvbQ|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|c2t5c2NyYXBlci5qcGc|NzIweDkwLmpwZw|NDY4eDYwLmpwZw|YmFubmVyLmpwZw|YXMuaW5ib3guY29t|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|YWRzLnlhaG9vLmNvbQ|YWQtY29udGFpbmVy|cHJvbW90ZS5wYWlyLmNvbQ|Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|YWdvZGEubmV0L2Jhbm5lcnM|YS5saXZlc3BvcnRtZWRpYS5ldQ|YWQuZm94bmV0d29ya3MuY29t|anVpY3lhZHMuY29t|YWQubWFpbC5ydQ|YWRuLmViYXkuY29t|clear|YWQtZm9vdGVy|an|awesome|RGl2QWQy|YWRBZA|YWRiYW5uZXI|YWRCYW5uZXI|YmFubmVyX2Fk|YWRUZWFzZXI|Z2xpbmtzd3JhcHBlcg|QWRDb250YWluZXI|QWRCb3gxNjA|QWREaXY|QWRJbWFnZQ|RGl2QWRD|RGl2QWRC|RGl2QWRB|RGl2QWQz|RGl2QWQx|IGFkX2JveA|RGl2QWQ|QWRzX2dvb2dsZV8wNA|QWRzX2dvb2dsZV8wMw|QWRzX2dvb2dsZV8wMg|QWRzX2dvb2dsZV8wMQ|QWRMYXllcjI|QWRMYXllcjE|QWRGcmFtZTQ|QWRGcmFtZTM|QWRGcmFtZTI|QWRGcmFtZTE|QWRBcmVh|QWQ3Mjh4OTA|QWQzMDB4MjUw|YmFubmVyYWQ|YWRfY2hhbm5lbA|site|you|making|keep|we|income|advertising|without|But|doesn|Who|okay|That|c3F1YXJlLWFkLnBuZw|using|re|like|YWRzZXJ2ZXI|looks|It|Welcome|FFFFFF|c76936|777777|EEEEEE|c3BvbnNvcmVkX2xpbms|b3V0YnJhaW4tcGFpZA|Z29vZ2xlX2Fk|YWRzZW5zZQ|cG9wdXBhZA|YWRzbG90|YmFubmVyaWQ|YWQtbGFyZ2UucG5n|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|ZmF2aWNvbjEuaWNv|join|normal|line|Black|Arial|fff|minHeight|120|setTimeout||minWidth|encode|radius|reverse|12px|split|click|background|Za|40px|160px|z0|FILLVECTID2|FILLVECTID1|BlockAdBlock|with|16pt|marginRight|CCC|cgRoonUTcS|solid|1px|172|hr|500|79|229|200|999|event|45px|18pt|onmouseout|35px|screen|frameElement|rgba|8px|24px|14px|onmouseover|boxShadow|null|borderRadius|easily|adblock|stop|setInterval|YWQtbGVmdA|YWRCYW5uZXJXcmFw|YWQtZnJhbWU|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|YWQtY29udGFpbmVyLTI|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|querySelector|aW5zLmFkc2J5Z29vZ2xl|YWQtaGVhZGVy|now||insertBefore|YWQtaW1n||||468px|undefined|typeof|YWQtaW5uZXI|YWQtbGFiZWw|YWQtbGI|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|d2lkZV9za3lzY3JhcGVyLmpwZw|bGFyZ2VfYmFubmVyLmdpZg|requestAnimationFrame|Date|You|clearInterval|black|5pt|127|com|blockadblock|http|9999|2048|innerHeight|192|c1|head|getItem|191|css|stylesheet|rel|link|onclick|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|reload|setItem|QWQzMDB4MTQ1'.split('|'),0,{}));
</script>
</body>
</html>
