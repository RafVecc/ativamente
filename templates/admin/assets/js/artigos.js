$(document).ready(function () {
    $('#artigo1').on("click", function (event) {
        var url = $('#url').val();

        Swal.fire({
            html: `<embed src="http://localhost/ativamente/uploads/artigos/ARTIGO_1.pdf" type="application/pdf" width="100%" height="500px" />`
        });

    })
    $('#artigo2').on("click", function (event) {
        var url = $('#url').val();

        Swal.fire({
            html: `<embed src="http://localhost/ativamente/uploads/artigos/ARTIGO_2.pdf" type="application/pdf" width="100%" height="500px" />`
        });

    })
})