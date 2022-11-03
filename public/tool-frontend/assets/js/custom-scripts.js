(function () {


    // let elementsBtn = document.getElementById('elementsBtn');
    // elementsBtn.addEventListener('click', () => {
    //     document.getElementById('elementsContent').style.display = 'block';
    // })



    //console.log(colorPicker.getColor())


    // Add active class to the current button (highlight it)
    $(".main-tool-btn").click(function () {
        $(".main-tool-btn").removeClass("active");
        $(this).addClass("active");
    });


})();



