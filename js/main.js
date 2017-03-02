function addClass( classname, element ) {

    var cn = element.className;
    //test for existance
    if( cn.indexOf( classname ) != -1 ) {
        return;
    }
    //add a space if the element already has class
    if( cn != '' ) {
        classname = ' '+classname;
    }
    element.className = cn+classname;

}

function removeClass( classname, element ) {

    var cn = element.className;
    var rxp = new RegExp( "\\s?\\b"+classname+"\\b", "g" );
    cn = cn.replace( rxp, '' );
    element.className = cn;

}

;window.onload = function() {

    var dropZone = document.getElementById('dragdrop'),
        maxFileSize = 1000000;

    if (typeof(window.FileReader) == 'undefined') {
        dropZone.text('Не поддерживается браузером!');
        dropZone.addClass('error');
    }

    dropZone.ondragover = function(){

        addClass('hover', dropZone);
        //dropZone.className += ' hover';
        return false;

    };

    dropZone.ondragleave = function() {
        removeClass('hover', dropZone);
        //dropZone.removeClass('hover');
        return false;
    };

    dropZone.ondrop = function(event) {
        event.preventDefault();

        removeClass('hover', dropZone);
        addClass('drop', dropZone);

        var files = event.dataTransfer.files;

        if (files && files[0]) {

            reader = new FileReader();
            result = 0;

            reader.onload = function (e) {

                result = reader.result;

            };

            reader.readAsDataURL(files[0]);

        }

    };

};
