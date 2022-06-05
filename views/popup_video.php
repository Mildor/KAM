<body style='margin:0; padding:0; overflow: hidden; -ms-overflow-style: none; scrollbar-width: none;'><iframe id='iframe' style="width: 100vw; height:100vh;"></iframe></body>
<script>
    var iframe = document.getElementById('iframe');
    var url = window.location.href;
    var index = url.indexOf('#');
    var lien = url.substring(index+1);
    
    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + lien + '?autoplay=1');
    
</script>

