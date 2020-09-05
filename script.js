/* Dynamiczna tapeta czy coś w tym stylu */
var d = new Date();
var n = d.getHours();
if (n > 4){
    console.log("wiecej niz 4")
    if (n < 9){
        console.log("mniej niz 9")
        // uruchamia się tylko jeśli jest 4:00 do 8:59
        document.body.style.backgroundImage = "url('img/morning.webp')";
    }
    else{
        document.body.style.backgroundImage = "url('img/day.webp')";
    }
}
else{
    document.body.style.backgroundImage = "url('img/day.webp')";
}