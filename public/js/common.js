$(document).ready(function(){
    $('#navbar-select').change(function(){
        const url=$(this).val()
        if(url){
            window.location.assign(url)
        }
    })

})
function delete_alert(){
    return alert('Are u sure u want to delete?')
}

function toast(msg){
        document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('deleteToast');
        var toast = new bootstrap.Toast(toastEl,{delay:5000});
        $('.msg').text(msg)
        toast.show();
});
}
