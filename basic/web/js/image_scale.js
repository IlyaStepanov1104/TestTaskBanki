$(".image_scale").on("click", function (){
    if (this.classList.contains('scale')) {
        $(".scale").remove();
        $("#back")[0].classList.remove('visible');
        return;
    }
    let $image = this.cloneNode();
    $image.classList.add('scale');
    console.log($image);
    document.body.append($image);
    $("#back")[0].classList.add('visible');
    $("#front")[0].classList.add('visible');
})

$("#front").on("click", function (){
    $("#back")[0].classList.remove('visible');
    $("#front")[0].classList.remove('visible');
    $(".scale").remove();
})