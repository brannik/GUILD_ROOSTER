var themeName,themePath,themeStyle;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/deff_theme.xml', true);

    xhr.timeout = 2000; // time in milliseconds

    xhr.onload = function () {
    // Request finished. Do processing here.
        var xmlDoc = this.responseXML; // <- Here's your XML file
        themePath = xmlDoc.getElementsByTagName("path")[0].childNodes[0].nodeValue;
        themeStyle = xmlDoc.getElementsByTagName("style")[0].childNodes[0].nodeValue;
        document.head.innerHTML = '<link rel="stylesheet" href="' + themePath + themeStyle +'">';
    };

    xhr.ontimeout = function (e) {
    // XMLHttpRequest timed out. Do something here.
    };

    xhr.send(null);