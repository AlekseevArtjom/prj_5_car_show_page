function load_module(src)
{
var script_to_load = document.createElement('script');
script_to_load.src = src;
script_to_load.type="module";
script_to_load.async = false ;
document.body.append(script_to_load);
}


window.addEventListener('load', function ()
{
console.log("start loading js");
load_module("/frontend/js/jquery-3.6.0.js");
load_module("/frontend/js/sortTableByField.js");

});
