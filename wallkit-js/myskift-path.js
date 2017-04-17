var mySkiftPath = "https://my.skift.com/";
var host = document.location.host;

if (host.indexOf("localhost") > -1) {
    mySkiftPath = "http://localhost/myskift/";
}

if (host.indexOf(".wpengine.com") > -1) {
    mySkiftPath = "https://myskift.wpengine.com/";
}

if (host.indexOf("dev.") > -1) {
    mySkiftPath = "http://dev.my.skift.com/";
}

if (host.indexOf("myskift.wpengine.com") > -1 || host.indexOf("my.skift.com") > -1 || host.indexOf("dev.my.skift.com") > -1) {
    mySkiftPath = "/";
}

var mySkiftAjaxPath = mySkiftPath + "ajax/";